<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  Simple Checkout for 2.3.1 v 3.0
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce
  Copyright (c) 2012 osCbyJetta
  Released under the GNU General Public License
*/
require('includes/application_top.php');
require('includes/classes/http_client.php');
require(DIR_WS_LANGUAGES . $language.'/'.FILENAME_CHECKOUT);
if ($session_started == false)
	{
	if ($jscript == 'true') $cookie = 'true';
	else tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
	}
if ($cart->count_contents() < 1)
	{
	if ($jscript == 'true') $redirect = 'true';
	else tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
	}
if (STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT != 'true')
	{
	$products = $cart->get_products();
	for ($i=0, $n=sizeof($products); $i<$n; $i++)
		if (tep_check_stock($products[$i]['id'], $products[$i]['quantity']))
			{
			if ($jscript == 'true') $redirect = 'true';
			else tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
			}
	}
$cartID = $cart->cartID;
$processAccount = false;
$processAddress = false;
if (isset($_POST['action']) && $_POST['action'] == 'jscript')
	{
	tep_session_register('jscript');
	$jscript = 'true';
	exit;
	}
if (isset($_GET['form']) && $_GET['form'] == 'address') $processAddress = true;
if (isset($_POST['aID']) && tep_not_null($_POST['aID'])) $_GET['aID'] = $_POST['aID'];
if (isset($_GET['addresses']) && $_GET['addresses'] == 'open') $addressopen = true;
else $addressopen = false;
$default_country = STORE_COUNTRY;
if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'sendto' || $HTTP_POST_VARS['action'] == 'billto') && isset($HTTP_POST_VARS['formid']) && ($HTTP_POST_VARS['formid'] == $sessiontoken)) {
	$error = false;
	if (tep_not_null($HTTP_POST_VARS['firstname']) && tep_not_null($HTTP_POST_VARS['lastname']) && tep_not_null($HTTP_POST_VARS['street_address'])) {
		if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($HTTP_POST_VARS['gender']);
		if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($HTTP_POST_VARS['company']);
		$firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
		$lastname = tep_db_prepare_input($HTTP_POST_VARS['lastname']);
		$street_address = tep_db_prepare_input($HTTP_POST_VARS['street_address']);
		if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($HTTP_POST_VARS['suburb']);
		$postcode = tep_db_prepare_input($HTTP_POST_VARS['postcode']);
		$city = tep_db_prepare_input($HTTP_POST_VARS['city']);
		$country = tep_db_prepare_input($HTTP_POST_VARS['country']);
		if (ACCOUNT_STATE == 'true') {
			if (isset($HTTP_POST_VARS['zone_id'])) $zone_id = tep_db_prepare_input($HTTP_POST_VARS['zone_id']);
			else $zone_id = false;
			$state = tep_db_prepare_input($HTTP_POST_VARS['state']);}
		if (ACCOUNT_GENDER == 'true') {
		if ( ($gender != 'm') && ($gender != 'f') ) {
			$error = true;
			$messageStack->add('address', ENTRY_GENDER_ERROR);}}
		if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
			$error = true;
			$messageStack->add('address', ENTRY_FIRST_NAME_ERROR);}
		if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
			$error = true;
			$messageStack->add('address', ENTRY_LAST_NAME_ERROR);}
		if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
			$error = true;
			$messageStack->add('address', ENTRY_STREET_ADDRESS_ERROR);}
		if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
			$error = true;
			$messageStack->add('address', ENTRY_POST_CODE_ERROR);}
		if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
			$error = true;
			$messageStack->add('address', ENTRY_CITY_ERROR);}
		if (ACCOUNT_STATE == 'true') {
			$zone_id = 0;
			$check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
			$check = tep_db_fetch_array($check_query);
			$entry_state_has_zones = ($check['total'] > 0);
			if ($entry_state_has_zones == true) {
				$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
				if (tep_db_num_rows($zone_query) == 1) {
					$zone = tep_db_fetch_array($zone_query);
					$zone_id = $zone['zone_id'];}
				else {
					$error = true;
					unset($_POST['state']);
					$messageStack->add('address', ENTRY_STATE_ERROR_INVALID);}}
			elseif (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
				$error = true;
				$messageStack->add('address', ENTRY_STATE_ERROR);}}
		if ( (is_numeric($country) == false) || ($country < 1) ) {
			$error = true;
			$messageStack->add('address', ENTRY_COUNTRY_ERROR);}
		if ($error == false) {
			$sql_data_array = array(
				'customers_id' => $customer_id,
			        'entry_firstname' => $firstname,
			        'entry_lastname' => $lastname,
			        'entry_street_address' => $street_address,
			        'entry_postcode' => $postcode,
			        'entry_city' => $city,
			        'entry_country_id' => $country);
			if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
			if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
			if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
			if (ACCOUNT_STATE == 'true') {
				if ($zone_id > 0) {
					$sql_data_array['entry_zone_id'] = $zone_id;
					$sql_data_array['entry_state'] = '';}
				else {
					$sql_data_array['entry_zone_id'] = '0';
					$sql_data_array['entry_state'] = $state;}}
			if($_POST['action'] == 'sendto' && !tep_session_is_registered('sendto')) tep_session_register('sendto');
			if($_POST['action'] == 'billto' && !tep_session_is_registered('billto')) tep_session_register('billto');
			if (isset($_POST['aID']) && tep_not_null($_POST['aID']))
				{
				tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "address_book_id = '" . (int)$_POST['aID'] . "'");
				if($_POST['action'] == 'sendto') $sendto = $_POST['aID'];
				if($_POST['action'] == 'billto') $billto = $_POST['aID'];
				}
			else
				{
				tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
				if($_POST['action'] == 'sendto') $sendto = tep_db_insert_id();
				if($_POST['action'] == 'billto') $billto = tep_db_insert_id();
				}
			if($_POST['action'] == 'sendto' && tep_session_is_registered('shipping')) tep_session_unregister('shipping');
			if($_POST['action'] == 'billto' && tep_session_is_registered('payment')) tep_session_unregister('payment');
			if ($jscript == 'true') $refresh_checkout = true;
			else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
			}
		else $processAddress = true;
		}
	elseif (isset($HTTP_POST_VARS['address'])) {
		$reset_shipping = false;
		$reset_payment = false;
		if($_POST['action'] == 'sendto'){ 
			if (tep_session_is_registered('sendto') && $sendto != $HTTP_POST_VARS['address'] && tep_session_is_registered('shipping')) $reset_shipping = true;
			else tep_session_register('sendto');
			}
		if($_POST['action'] == 'billto'){ 
			if (tep_session_is_registered('billto') && $billto != $HTTP_POST_VARS['address'] && tep_session_is_registered('payment')) $reset_payment = true;
			else tep_session_register('billto');
			}
		if($_POST['action'] == 'sendto') {
			$sendto = $HTTP_POST_VARS['address'];
			$check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");}
		if($_POST['action'] == 'billto') {
			$billto = $HTTP_POST_VARS['address'];
			$check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");}
		$check_address = tep_db_fetch_array($check_address_query);
		if ($check_address['total'] == '1') {
			if ($reset_shipping == true) tep_session_unregister('shipping');
			if ($reset_payment == true) tep_session_unregister('payment');
			if ($jscript == 'true') $refresh_checkout = true;
			else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
			}
		else
			{
			if($_POST['action'] == 'sendto') tep_session_unregister('sendto');
			if($_POST['action'] == 'billto') tep_session_unregister('billto');
			if ($jscript == 'true') $refresh_checkout = true;
			else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
			}
		}
	else	{
		if($_POST['action'] == 'sendto') {
			if(!tep_session_is_registered('sendto')) tep_session_register('sendto');
			$sendto = $customer_default_address_id;}
		if($_POST['action'] == 'billto') {
			if(!tep_session_is_registered('billto')) tep_session_register('billto');
			$billto = $customer_default_address_id;}
		if ($jscript == 'true') $refresh_checkout = true;
		else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
		}
	}
if(isset($_GET['delete']) && is_numeric($_GET['delete']))
	{
	if ($_GET['delete'] == $customer_default_address_id)
		$messageStack->add_session('address', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');
	else
		{
		tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['delete'] . "'");
		if (tep_session_is_registered('sendto') && (empty($sendto) || is_numeric($sendto)) && $sendto != false){
			if (!tep_db_fetch_array(tep_db_query("select customers_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "' limit 1"))){
				$sendto = $customer_default_address_id;
				if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');}}
		if (tep_session_is_registered('billto') && (empty($billto) || is_numeric($billto))){
			if (!tep_db_fetch_array(tep_db_query("select customers_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "' limit 1"))){
				$billto = $customer_default_address_id;
			        if (tep_session_is_registered('payment')) tep_session_unregister('payment');}}
		}
	}
if ($order->content_type == 'virtual') {
	$shipping = false;
	$sendto = false;}
elseif ($shipping == false || $sendto == false) {
	if ($shipping == false) $shipping = true;
	if ($sendto == false) $sendto = 'true';}
if (!tep_session_is_registered('sendto')) {
	tep_session_register('sendto');
	if ($sendto != false) $sendto = $customer_default_address_id;}
elseif ($sendto == 'true') $sendto = $customer_default_address_id;
if (tep_session_is_registered('sendto') && (empty($sendto) || is_numeric($sendto)) && $sendto != false){
	if (!tep_db_fetch_array(tep_db_query("select customers_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "' limit 1")))
		{$sendto = $customer_default_address_id;
		if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');}}
if (!tep_session_is_registered('billto')){
	tep_session_register('billto');
	$billto = $customer_default_address_id;}
if (tep_session_is_registered('billto') && (empty($billto) || is_numeric($billto))){
	if (!tep_db_fetch_array(tep_db_query("select customers_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "' limit 1"))){
		$billto = $customer_default_address_id;
	        if (tep_session_is_registered('payment')) tep_session_unregister('payment');}}
require(DIR_WS_CLASSES . 'order.php');
$order = new order;
if ($shipping != false) {
	$free_shipping = false;
	if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
		$pass = false;
		switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
			case 'national': if ($order->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;
			case 'international': if ($order->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;
			case 'both': $pass = true; break;}
		if ($pass == true && $order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) {
			$free_shipping = true;
			include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');}}}
$total_weight = $cart->show_weight();
$total_count = $cart->count_contents();
if ($shipping != false) {
	require(DIR_WS_CLASSES . 'shipping.php');
	$shipping_modules = new shipping;
	if (tep_count_shipping_modules() < 1 && $free_shipping == false)
		$shipping = false;}
$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
if (isset($_POST['action']) && $_POST['action'] == 'login' && isset($_POST['formid']) && $_POST['formid'] == $sessiontoken)
	{
	$error = false;
	$email_address = tep_db_prepare_input($_POST['email_address']);
	$password = tep_db_prepare_input($_POST['password']);
	$check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
	if (!tep_db_num_rows($check_customer_query)) $error = true;
	else {
		$check_customer = tep_db_fetch_array($check_customer_query);
		if (!tep_validate_password($password, $check_customer['customers_password'])) $error = true;
		else {
			if (SESSION_RECREATE == 'True') tep_session_recreate();
			if (tep_password_type($check_customer['customers_password']) != 'phpass')
				tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_encrypt_password($password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");
			$check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
			$check_country = tep_db_fetch_array($check_country_query);
			$customer_id = $check_customer['customers_id'];
			$customer_default_address_id = $check_customer['customers_default_address_id'];
			$customer_first_name = $check_customer['customers_firstname'];
			$customer_country_id = $check_country['entry_country_id'];
			$customer_zone_id = $check_country['entry_zone_id'];
			$sendto = $customer_default_address_id;
			$billto = $customer_default_address_id;
			tep_session_register('customer_id');
			tep_session_register('customer_default_address_id');
			tep_session_register('customer_first_name');
			tep_session_register('customer_country_id');
			tep_session_register('customer_zone_id');
			tep_session_register('sendto');
			tep_session_register('billto');
			tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");
			$sessiontoken = md5(tep_rand() . tep_rand() . tep_rand() . tep_rand());
			$cart->restore_contents();
			if ($jscript == 'true') $refresh_checkout = true;
			else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
			}
		}
	if ($error == true) $messageStack->add('login', TEXT_LOGIN_ERROR);
	}
if (isset($_POST['action']) && $_POST['action'] == 'forgot' && isset($_POST['formid']) && $_POST['formid'] == $sessiontoken)
	{
	$email_address = tep_db_prepare_input($_POST['email_address']);
	$check_customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
	if (tep_db_num_rows($check_customer_query)){
		$check_customer = tep_db_fetch_array($check_customer_query);
		$new_password = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
		$crypted_password = tep_encrypt_password($new_password);
		tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_db_input($crypted_password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");
		tep_mail($check_customer['customers_firstname'] . ' ' . $check_customer['customers_lastname'], $email_address, EMAIL_PASSWORD_REMINDER_SUBJECT, sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		$messageStack->add_session('login', SUCCESS_PASSWORD_SENT, 'success');
			if ($jscript == 'true') $refresh_checkout = true;
			else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
		}
	else $messageStack->add('login', TEXT_NO_EMAIL_ADDRESS_FOUND);
	}
if (isset($_POST['action']) && ($_POST['action'] == 'account' || $_POST['action'] == 'guest') && isset($_POST['formid']) && $_POST['formid'] == $sessiontoken)
	{
	if($_POST['action'] == 'account') $processAccount = true;
	elseif($_POST['action'] == 'guest'){
		$processGuest = true;
		$return_guest = false;}
	if (ACCOUNT_GENDER == 'true'){
		if (isset($_POST['gender'])) $gender = tep_db_prepare_input($_POST['gender']);
		else $gender = false;}
	$firstname = tep_db_prepare_input($_POST['firstname']);
	$lastname = tep_db_prepare_input($_POST['lastname']);
	if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($_POST['dob']);
	$email_address = tep_db_prepare_input($_POST['email_address']);
	if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['company']);
	$street_address = tep_db_prepare_input($_POST['street_address']);
	if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['suburb']);
	$postcode = tep_db_prepare_input($_POST['postcode']);
	$city = tep_db_prepare_input($_POST['city']);
	if (ACCOUNT_STATE == 'true'){
		$state = tep_db_prepare_input($_POST['state']);
		if (isset($_POST['zone_id'])) $zone_id = tep_db_prepare_input($_POST['zone_id']);
		else $zone_id = false;}
	$country = tep_db_prepare_input($_POST['country']);
	$telephone = tep_db_prepare_input($_POST['telephone']);
	$fax = tep_db_prepare_input($_POST['fax']);
	if (isset($_POST['newsletter'])) $newsletter = tep_db_prepare_input($_POST['newsletter']);
	else $newsletter = false;
	$password = tep_db_prepare_input($_POST['password']);
	$confirmation = tep_db_prepare_input($_POST['confirmation']);
	$error = false;
	if (ACCOUNT_GENDER == 'true') {
		if ( ($gender != 'm') && ($gender != 'f') ) {
			$error = true;
			$messageStack->add('account', ENTRY_GENDER_ERROR);}}
	if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
		$error = true;
		$messageStack->add('account', ENTRY_FIRST_NAME_ERROR);}
	if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
		$error = true;
		$messageStack->add('account', ENTRY_LAST_NAME_ERROR);}
	if (ACCOUNT_DOB == 'true'){
		if ((is_numeric(tep_date_raw($dob)) == false) || (@checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4)) == false)){
			$error = true;
			$messageStack->add('account', ENTRY_DATE_OF_BIRTH_ERROR);}}
	if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH){
		$error = true;
		$messageStack->add('account', ENTRY_EMAIL_ADDRESS_ERROR);}
	elseif (tep_validate_email($email_address) == false){
		$error = true;
		$messageStack->add('account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);}
	else{
		$check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
		$check_email = tep_db_fetch_array($check_email_query);
		if ($check_email['total'] > 0){
				$error = true;
				$messageStack->add('account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
			}
		}
	if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH){
		$error = true;
		$messageStack->add('account', ENTRY_STREET_ADDRESS_ERROR);
		}
	if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH){
		$error = true;
		$messageStack->add('account', ENTRY_POST_CODE_ERROR);
		}
	if (strlen($city) < ENTRY_CITY_MIN_LENGTH){
		$error = true;
		$messageStack->add('account', ENTRY_CITY_ERROR);
		}
	if (is_numeric($country) == false){
		$error = true;
		$messageStack->add('account', ENTRY_COUNTRY_ERROR);
		}
	if (ACCOUNT_STATE == 'true'){
		$zone_id = 0;
		$check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
		$check = tep_db_fetch_array($check_query);
		$entry_state_has_zones = ($check['total'] > 0);
		if ($entry_state_has_zones == true){
			$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
			if (tep_db_num_rows($zone_query) == 1){
				$zone = tep_db_fetch_array($zone_query);
				$zone_id = $zone['zone_id'];}
			else{
				$error = true;
				$messageStack->add('account', ENTRY_STATE_ERROR_INVALID);}}
		elseif (strlen($state) < ENTRY_STATE_MIN_LENGTH){
				$error = true;
				$messageStack->add('account', ENTRY_STATE_ERROR);}}
	if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH){
		$error = true;
		$messageStack->add('account', ENTRY_TELEPHONE_NUMBER_ERROR);}
	if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH){
		$error = true;
		$messageStack->add('account', ENTRY_PASSWORD_ERROR);}
	elseif ($password != $confirmation){
		$error = true;
		$messageStack->add('account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);}
	if ($error == false){
		$sql_data_array = array(
			'customers_firstname' => $firstname,
			'customers_lastname' => $lastname,
						'customers_email_address' => $email_address,
						'customers_telephone' => $telephone,
						'customers_fax' => $fax,
						'customers_newsletter' => $newsletter,
						'customers_password' => tep_encrypt_password($password));
		tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
		$customer_id = tep_db_insert_id();
		$sql_data_array = array(
			'customers_id' => $customer_id,
			'entry_firstname' => $firstname,
			'entry_lastname' => $lastname,
			'entry_street_address' => $street_address,
			'entry_postcode' => $postcode,
			'entry_city' => $city,
			'entry_country_id' => $country);
			if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
			if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
		if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
		if (ACCOUNT_STATE == 'true'){
			if ($zone_id > 0){
				$sql_data_array['entry_zone_id'] = $zone_id;
				$sql_data_array['entry_state'] = '';}
			else{
				$sql_data_array['entry_zone_id'] = '0';
				$sql_data_array['entry_state'] = $state;}}
		tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
		$address_id = tep_db_insert_id();
		tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");
		tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");
		if (SESSION_RECREATE == 'True') tep_session_recreate();
		$customer_first_name = $firstname;
		$customer_default_address_id = $address_id;
		$customer_country_id = $country;
		$customer_zone_id = $zone_id;
		tep_session_register('customer_id');
		tep_session_register('customer_first_name');
		tep_session_register('customer_default_address_id');
		tep_session_register('customer_country_id');
		tep_session_register('customer_zone_id');
		$sessiontoken = md5(tep_rand() . tep_rand() . tep_rand() . tep_rand());
			$cart->restore_contents();
			$name = $firstname . ' ' . $lastname;
			if (ACCOUNT_GENDER == 'true'){
				if ($gender == 'm') $email_text = sprintf(EMAIL_GREET_MR, $lastname);
				else $email_text = sprintf(EMAIL_GREET_MS, $lastname);}
			else $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
			$email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
			tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		if ($jscript == 'true') $refresh_checkout = true;
		else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
		}
	}
if (!isset($_POST['payment'])){
	require(DIR_WS_CLASSES . 'payment.php');
	$payment_modules = new payment;}
if (isset($_POST['shipping']) && tep_not_null($_POST['shipping']) && strpos($_POST['shipping'], '_')){
	if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
	$shipping = $_POST['shipping'];
	list($module, $method) = explode('_', $shipping);
	if ( is_object($$module) || ($shipping == 'free_free') ){
		if ($shipping == 'free_free'){
			$quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
			$quote[0]['methods'][0]['cost'] = '0';}
		else $quote = $shipping_modules->quote($method, $module);
		if (isset($quote['error'])) tep_session_unregister('shipping');
		if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ){
			$shipping = array(
				'id' => $shipping,
				'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
				'cost' => $quote[0]['methods'][0]['cost']);}}
	else tep_session_unregister('shipping');}
if (isset($_POST['payment'])){
	if (!tep_session_is_registered('payment')) tep_session_register('payment');
	$payment = $_POST['payment'];}
if (isset($_POST['comments']) && tep_not_null($_POST['comments'])){
	$comments = tep_db_prepare_input($_POST['comments']);
	if (!tep_session_is_registered('comments')) tep_session_register('comments');}
if (isset($_POST['action']) && $_POST['action'] == 'process' && isset($_POST['formid']) && $_POST['formid'] == $sessiontoken)
	{
	if ((!isset($_POST['shipping']) || !tep_not_null($_POST['shipping'])) && $shipping != false) {
		tep_session_unregister('shipping');
		$messageStack->add('checkout', TEXT_CHOOSE_SHIPPING_METHOD);
		if ($jscript == 'true') $refresh_checkout = true;
		else tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
		}
	require(DIR_WS_CLASSES . 'payment.php');
	$payment_modules = new payment($payment);
	$order = new order;
	$payment_modules->update_status();
	if ( ($payment_modules->selected_module != $payment) || ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) )
		{
		if ($jscript == 'true') {$refresh_checkout_error = true; $re_error = tep_href_link(FILENAME_CHECKOUT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL');}
		else tep_redirect(tep_href_link(FILENAME_CHECKOUT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
		}
  	$payment_modules->pre_confirmation_check();
	unset($_POST['payment']);
	unset($_POST['shipping']);
	unset($_POST['comments']);
	if (isset($$payment->form_action_url))
		$url = $$payment->form_action_url;
	else
		$url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
	$post = '';
	if ($string = $payment_modules->process_button())
	$post .= $string;
	else
		foreach($_POST as $key => $val)
			$post .= tep_draw_hidden_field($key, $val);
	require(DIR_WS_INCLUDES . 'template_top.php');
	echo tep_draw_form('processCheckout', $url, 'post').$post;
	echo '<noscript><div style="text-align:center;padding-top:50px;">'.tep_draw_button(IMAGE_BUTTON_CONFIRM_ORDER, 'check', null, 'primary').'</div></noscript></form>';
	?>
	<script type="text/javascript">document.processCheckout.submit();</script>
	
	<?php
	require(DIR_WS_INCLUDES . 'template_bottom.php');
	require(DIR_WS_INCLUDES . 'application_bottom.php');
	}
$quotes = $shipping_modules->quote();
if (!tep_session_is_registered('shipping')){
	tep_session_register('shipping');
	$shipping = $shipping_modules->cheapest();
	$order = new order;
	}
require(DIR_WS_INCLUDES . 'template_top.php');
?>
<script type="text/javascript">
var selectedShipping;
var selectedPayment;
var selectedAddress;
function selectRowShipping(object, buttonSelect) {
	if (!selectedShipping) {
		if (document.getElementById) selectedShipping = document.getElementById('defaultShipping');
		else selectedShipping = document.all['defaultShipping'];}
	if (selectedShipping) selectedShipping.className = 'moduleRow';
	object.className = 'moduleRowSelected';
	selectedShipping = object;
	if (document.checkout.shipping[0]) document.checkout.shipping[buttonSelect].checked=true;
	else document.checkout.shipping.checked=true;
	}
function selectRowPayment(object, buttonSelect) {
	if (!selectedPayment) {
		if (document.getElementById) selectedPayment = document.getElementById('defaultPayment');
		else selectedPayment = document.all['defaultPayment'];}
	if (selectedPayment) selectedPayment.className = 'moduleRow';
	object.className = 'moduleRowSelected';
	selectedPayment = object;
	if (document.checkout.payment[0]) document.checkout.payment[buttonSelect].checked=true;
	else document.checkout.payment.checked=true;
	}
function selectRowAddress(object, buttonSelect) {
	if (!selectedAddress) {
		if (document.getElementById) selectedAddress = document.getElementById('defaultAddress');
		else selectedAddress = document.all['defaultAddress'];}
	if (selectedAddress) selectedAddress.className = 'moduleRow';
	object.className = 'moduleRowSelected';
	selectedAddress = object;
	if (document.addressbook.address[0]) document.addressbook.address[buttonSelect].checked=true;
	else document.addressbook.address.checked=true;
	}
function rowOverEffect(object) {
	if (object.className == 'moduleRow') object.className = 'moduleRowOver';
	}
function rowOutEffect(object) {
	if (object.className == 'moduleRowOver') object.className = 'moduleRow';
	}
function check_form_optional(form_name) {
	var form = form_name;
	var firstname = form.elements['firstname'].value;
	var lastname = form.elements['lastname'].value;
	var street_address = form.elements['street_address'].value;
	if (firstname == '' && lastname == '' && street_address == '') return true;
	else return check_form(form_name);
	}
$(document).ajaxStart(function(){$('body').addClass('progress');});
$(document).ajaxStop(function(){$('body').removeClass('progress');});
$(function(){
	if ('<?php echo tep_session_is_registered('jscript');?>' != true) $.post('checkout.php', 'action=jscript', function(){window.location.href = unescape(window.location.pathname);});
	if ('<?php echo $redirect;?>' == 'true') window.location='<?php echo tep_href_link(FILENAME_SHOPPING_CART);?>';
	if ('<?php echo $cookie;?>' == 'true') window.location='<?php echo tep_href_link(FILENAME_COOKIE_USAGE);?>';
	if ('<?php echo $refresh_checkout;?>' == 'true') window.location='<?php echo tep_href_link(FILENAME_CHECKOUT, '', 'SSL');?>';
	if ('<?php echo $refresh_checkout_error;?>' == 'true') window.location='<?php echo $re_error;?>';
	if ('<?php echo tep_session_is_registered('customer_id');?>' != true)
		{
		$('#Account').dialog({
			draggable: false,resizable: false,closeOnEscape: false,width: 600,position: ['center', 150],autoOpen:false,
			open:function(){
				$('.ui-dialog-titlebar', $(this).parent()).hide();
				if($('#loginForm').is(':visible'))
					{
					$('#openCreate').each(function(){$(this).qtip({show:{event:'mouseenter'},hide:{event: 'mouseleave'},content:$('#createHelp').attr('rel'),style:{classes:'ui-tooltip-tipped ui-tooltip-rounded'},position:{viewport: $(window), my:'leftBottom',at:'rightTop',target:$('#openCreate')}});});
					$('#openGuest').each(function(){$(this).qtip({show:{event:'mouseenter'},hide:{event: 'mouseleave'},content:$('#guestHelp').attr('rel'),style:{classes:'ui-tooltip-tipped ui-tooltip-rounded'},position:{viewport: $(window), my:'leftTop',at:'rightBottom',target:$('#openGuest')}});});
					$('#createHelp').each(function(){$(this).qtip({events:{hide: function() {$('#createHelp').qtip('option', {'show.event':'click','show.delay':false,'hide.event':'unfocus'});}},show:{ready:true},hide:{event: false,inactive:4000},content:$(this).attr('rel'),style:{classes:'ui-tooltip-tipped ui-tooltip-rounded'},position:{viewport: $(window), my:'leftBottom',at:'rightTop',target:$('#openCreate')}});});
					$('#guestHelp').each(function(){$(this).qtip({events:{hide: function() {$('#guestHelp').qtip('option', {'show.event':'click','show.delay':false,'hide.event':'unfocus'});}},show:{ready:true,delay:4000},hide:{event: false,inactive:5000},content:$(this).attr('rel'),style:{classes:'ui-tooltip-tipped ui-tooltip-rounded'},position:{viewport: $(window), my:'leftTop',at:'rightBottom',target:$('#openGuest')}}).qtip('hide', function(){$(this).qtip('option', {'show.event':'click','show.delay':false,'hide.event':'unfocus'});});});
					}
				$(this)	.find('.fields').fields('set').find('input, select').trigger('blur').end().end()
					.find('select').css({'width':'154px'}).end()
					.find('input[type=text], input[type=password]').css({'width':'150px'}).end()
					.on('focus', 'input[name=passclone]', function(){$(this).parent().hide().next().find('input[name=password]').parent().show().end().focus();})
					.on('blur', 'input[name=password]', function(){if($(this).val() == '') $(this).parent().hide().prev().find('input[name=passclone]').parent().show().end().blur();})
					.on('click', '#forgotLink', function(){$('#login').hide().prev().show();return false;})
					.on('click', '#cancelForgot', function(){$('#forgot').hide().next().show();return false;})
					}
				}).dialog('open');
		$('#NewAccount').dialog(
			{
			draggable: false,resizable: false,closeOnEscape: false,width: 400,position: ['center', 100],autoOpen:true,
			open:function()
				{
				$('#createHelp, #guestHelp').qtip('destroy');
				$('#Account').dialog('close');
				$('#dobf').datepicker({dateFormat: '<?php echo JQUERY_DATEPICKER_FORMAT; ?>',changeMonth: true,changeYear: true,yearRange: '-100:+0'});
				if ('<?php echo tep_not_null(ENTRY_GENDER_TEXT);?>') $(this).find('input[name=gender]').addClass('required');
				$(this).css({'width':'50%','margin':'auto'})
					.on('focus', 'input[name=passclone]', function(){$(this).parent().hide().next().find('input[name=password]').parent().show().end().focus();})
					.on('focus', 'input[name=confclone]', function(){$(this).parent().hide().next().find('input[name=confirmation]').parent().show().end().focus();})
					.on('blur', 'input[name=confirmation]', function(){if($(this).val() == '') $(this).parent().hide().prev().find('input[name=confclone]').parent().show().end().blur();})
					.on('blur', 'input[name=password]', function(){if($(this).val() == '') $(this).parent().hide().prev().find('input[name=passclone]').parent().show().end().blur();})
					.on('click', '#accountSubmit', function(){$('#NewAccount').find('input, select, textarea').each(function(){if ($(this).val() == $(this).attr('title')){$(this).fields('Focus');$(this).on('mouseenter', function(){$(this).fields('Blur')});}});});
				},
			close: function(){$('#Account').dialog('open');}
			});
		}
	$('#checkout')
		.find('.confirmation').hide().end()
		.find('#paymentTable .moduleRowSelected').siblings('.confirmation').show().end().end()
		.find('.fields').fields('set').end()
		.on('change', 'input[name=shipping]', function(){$.post('checkout.php', 'shipping='+$(this).val()+'&comments='+$('textarea[name=comments]').val(), function(){window.location.href = unescape(window.location.pathname);});})
		.on('change', 'input[name=payment]', function(){$.post('checkout.php', 'payment='+$(this).val()+'&comments='+$('textarea[name=comments]').val(), function(){window.location.href = unescape(window.location.pathname);});})
		.on('click', '#processCheckout', function(){if ($('input[name=payment]').size() > 0 & $('input[name=payment]').val() == '') {alert('<?php echo ERROR_NO_PAYMENT_MODULE_SELECTED;?>');return false;}else if ($('#shipping').is(':visible') & $('input[name=shipping]').size() > 0 & $('input[name=shipping]').val() == '') {alert('<?php echo TEXT_CHOOSE_SHIPPING_METHOD;?>');return false;}$('.confirmation:hidden').remove();})
		.on('click', '#changeShippingAddress', function(){window.location = unescape(window.location.pathname+'?addresses=open&type=sendto');return false;})
		.on('click', '#changePaymentAddress', function(){window.location = unescape(window.location.pathname+'?addresses=open&type=billto');return false;});
	$('#Addresses').dialog(
		{
		shadow: false,modal: true,width: 400,position: ['center', 100],autoOpen:('<?php echo $processAddress;?>' == true || '<?php echo $addressopen;?>' == true ? true : false),
		open: function()
			{
			$('#AddressBook').dialog(
				{
				shadow: false,modal: true,width: 400,position: ['center', 100],autoOpen:true,
				open: function()
					{
					$('#Addresses').dialog('close');
					$(this)
						.find('.addressicons').css({'float':'left','padding':'5px','margin':'5px'}).end()
						.find('.addressblock').css({'float':'left','padding':'5px','margin':'5px'}).end()
						.find('.addressprimary').css({'float':'right','padding':'5px','margin':'5px','font-style':'italic'}).end()
						.find('.addressradio').css({'float':'right','padding-right':'15px'}).end()
						.siblings().find('a.ui-dialog-titlebar-close').on('click', function(){window.location = unescape(window.location.pathname);});
					}
				});
			$('#AddressForm').dialog(
				{
				shadow: false,modal: true,width: 400,position: ['center', 100],autoOpen:true,
				open: function()
					{
					$(this)
						.css({'width':'60%','margin':'auto'})
						.find('select').css({'width':'154px'}).end()
						.find('input[type=text]').css({'width':'150px'}).end()
						.find('.fields').fields('set').find('input, select').trigger('blur').end().end()
						.siblings().find('a.ui-dialog-titlebar-close').on('click', function(){window.location = unescape(window.location.pathname+'?addresses=open&type=<?php echo $_GET['type']; ?>');}).end().end()
						.on('click', '#addressFormSubmit', function()
							{
							$('#AddressForm').find('input, select, textarea').each(function()
								{
								if ($(this).val() == $(this).attr('title'))
									{
									$(this).fields('Focus');
									$(this).on('mouseenter', function()
										{
										$(this).fields('Blur');
										});
									}
								});
							});
					$('#Addresses').dialog('close');
					},
				});
			},
		});
	});
(function($){
	var required = '<span class="icon required_icon" style="color:#FF0000; display:inline-block;">*</span>',
		success = '<span class="icon success_icon ui-icon ui-icon-check" style="display:inline-block;">&nbsp;</span>',
		error = '<span class="icon error_icon ui-icon ui-icon-alert" style="display:inline-block;cursor:help;">&nbsp;</span>',
		none = '',
		focusField = {'border':'solid 2px #73A6FF','background':'#EFF5FF','color':'#000'},
		idleField = {'border':'solid 2px #DFDFDF','background':'#F8F8F8','color':'#6F6F6F'};
	var methods = {
		set: function(){return this.find('input, select, textarea').each(function(){$(this).blur().fields('Css').on('focus', function(){$(this).fields('Focus');}).on('blur change', function(){$(this).fields('Blur');}).on('keyup', function(){$(this).fields('Keyup');}).on('keyup', function(e){if (e.keyCode == 13 || e.which == 13) e.preventDefault;return false;});}).end();},
		Css: function(){this.css(idleField);if(this.hasClass('required')) this.fields('addIcon', required);if(this.val() == '') this.val(this.attr('title'));return this;},
		Focus: function(){this.css(focusField);if(this.val() == this.attr('title')) this.val('');return this;},
		Blur: function(){this.css(idleField);if(this.val() == '' || this.val() == this.attr('title') || (this.attr('type') == 'radio' & $('input[type=radio][name='+this.attr('name')+']:checked').size() == 0)){if(this.attr('type') != 'radio') this.val(this.attr('title'));if(this.hasClass('required')) this.fields('addIcon', required);else this.fields('addIcon', none);}else if ((this.is('select') || (this.attr('type') == 'radio' & $('input[type=radio][name='+this.attr('name')+']:checked').size() != 0)) & this.hasClass('required')) this.fields('addIcon', success);else if (this.hasClass('required') & this.val().length >= this.attr('data-len')) this.fields('addIcon', success);else if (this.val().length < this.attr('data-len')) this.fields('addIcon', error, this.attr('data-msg'));if (this.attr('name') == 'conf' & this.val() != this.parent().siblings().find('input[name=password]').val()) this.fields('addIcon', error, this.attr('data-mtch'));return this;},
		Keyup: function(){if (this.val().length == 0){if(this.hasClass('required')) this.fields('addIcon', required);else this.fields('addIcon', none);}else if (this.hasClass('required') & this.val().length >= this.attr('data-len')) this.fields('addIcon', success);return this;},
		addIcon: function (icon, msg){return this.siblings('.icon').remove().end().parent().append(icon).find('.icon').attr('title', msg);}};
	$.fn.fields = function(method) {return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));};
	})( jQuery );
</script>
<?php echo $payment_modules->javascript_validation(); ?>
<h1><?php echo HEADING_TITLE; ?></h1>
<div class="contentContainer" id="checkoutPage">
	<?php if (tep_session_is_registered('customer_id')) { ?>
	<div id="checkout">
	<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>
		<div id="error" class="contentText">
			<?php if (isset($_GET['payment_error']) && is_object(${$_GET['payment_error']}) && ($error = ${$HTTP_GET_VARS['payment_error']}->get_error())) { ?>
				<div class="contentText"><?php echo '<strong>'.tep_output_string_protected($error['title']).'</strong>'; ?><p class="messageStackError"><?php echo tep_output_string_protected($error['error']); ?></p></div>
			<?php } ?>
		</div>
		<?php if ($jscript == 'true') { ?> 
		<div id="cart" class="contentText">
			<div class="ui-widget-header">
				<div class="cartRow1" style="width:<?php echo SMALL_IMAGE_WIDTH; ?>px;">&nbsp;</div>
				<div class="cartRow2"><?php echo TABLE_HEADING_PRODUCTS;?></div>
				<div class="cartRow3"><?php echo TABLE_HEADING_PRICE;?></div>
				<div class="cartRow4"><?php echo TABLE_HEADING_QUANTITY;?></div>
				<div class="cartRow5"><?php echo TABLE_HEADING_TOTAL;?></div>
				<div class="cartRow6"><?php echo TABLE_HEADING_REMOVE;?></div>
				<div class="clear"></div>
			</div>
			<div class="ui-widget-content">
				<?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_CHECKOUT, 'action=update_product')); ?>
				<div id="cartContent" class="contentText">
					<?php
					$any_out_of_stock = 0;
					$products = $cart->get_products();
					for ($i=0, $n=sizeof($products); $i<$n; $i++)
						{
						$productAttributes = '';
						if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes']))
							while (list($option, $value) = each($products[$i]['attributes']))
								{
								echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
								$attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . (int)$products[$i]['id'] . "' and pa.options_id = '" . (int)$option . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . (int)$value . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . (int)$languages_id . "' and poval.language_id = '" . (int)$languages_id . "'");
								$attributes_values = tep_db_fetch_array($attributes);
								$productAttributes .= '<br /><small><i> - '.$attributes_values['products_options_name'].' '.$attributes_values['products_options_values_name'].'</i></small>';
								}
						$stock_check = '';
						if (STOCK_CHECK == 'true')
							{
							$stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
							if (tep_not_null($stock_check))
								$any_out_of_stock = 1;
							}
						echo '<div class="contentText cartRow">';
						echo '
								<div class="cartRow1" style="width:'.SMALL_IMAGE_WIDTH.'px;"><a href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id='.$products[$i]['id']).'">'.tep_image(DIR_WS_IMAGES . $products[$i]['image'], $products[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT).'</a></div>
								<div class="cartRow2"><a href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id='.$products[$i]['id']).'"><strong>'.$products[$i]['name'].'</strong>'.$stock_check . $productAttributes.'</a></div>
								<div class="cartRow3">'.$currencies->display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id'])).'</div>
								<div class="cartRow4 fields cartQty">'.tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'], 'size="4"').tep_draw_hidden_field('products_id[]', $products[$i]['id']) .'</div>
								<div class="cartRow5">'.$currencies->display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']).'</div>
								<div class="cartRow6 cartDelete" data-pid="'.$products[$i]['id'].'"><a href="'.tep_href_link(FILENAME_CHECKOUT, 'products_id=' . $products[$i]['id'] . '&action=remove_product').'"><span class="ui-icon ui-icon-trash">&nbsp;</span></a></div>
								<div class="clear"></div>
							</div>';
						}
					?>
				</div>
				<div id="cartRefresh" class="contentText">
					<div class="right"><?php echo tep_draw_button(IMAGE_BUTTON_UPDATE); ?></div>
					<div class="clear"></div>
				</div>
				</form>
				<div id="stockWarning" class="contentText">
					<?php
					if ($any_out_of_stock == 1){
						if (STOCK_ALLOW_CHECKOUT == 'true')
							echo '<p class="stockWarning" align="center">'.OUT_OF_STOCK_CAN_CHECKOUT.'</p>';
						else
							echo ' <p class="stockWarning" align="center">'.OUT_OF_STOCK_CANT_CHECKOUT.'</p>';}
					?>
				</div>
				<div id="totals" class="contentText">
					<div id="totalsContent">
						<?php
						require(DIR_WS_CLASSES.'order_total.php');
						$order_total_modules = new order_total;
						$order_total_modules->process();
						echo MODULE_ORDER_TOTAL_INSTALLED ? '<table summary="" cellpadding="2" cellspacing="0" border="0">'.$order_total_modules->output().'</table>' : '';
						?>
					</div>
					<div  id="discountContent">
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<?php } ?> 
		<?php echo tep_draw_form('checkout', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'post', 'onsubmit="return check_form(checkout);"', true) . tep_draw_hidden_field('action', 'process'); ?>
		<?php if ($shipping != 'false' || $sendto != 'false'){?>
		<div id="shipping" class="contentText">
			<div class="ui-widget-header">
				<?php if ($sendto != 'false'){?>
				<div class="left"><b><?php echo TITLE_SHIPPING_ADDRESS; ?></b></div>
				<?php } if ($shipping != 'false') { ?>
				<div class="right"><b><?php echo TABLE_HEADING_SHIPPING_METHOD;?></b></div>
				<?php } ?>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="ui-widget-content">
			<?php if ($sendto != 'false'){?>
				<div class="contentLeft">
					<div id="shippingAddress" class="contentText">
					        <?php echo tep_address_label($customer_id, $sendto, true, ' ', '<br />'); ?>
					</div>
					<div id="changeShippingAddress" class="contentText">
						<?php echo tep_draw_button(IMAGE_BUTTON_CHANGE_ADDRESS, 'home', tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL')); ?>
 					</div>
				</div>
				<?php } if ($shipping != 'false') { ?>
				<div id="shippingRows" class="contentRight">
<?php
					if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1)
						echo '	<div class="contentText">'.TEXT_CHOOSE_SHIPPING_METHOD.'</div>
							<div class="right"><strong>'.TITLE_PLEASE_SELECT.'</strong></div>
							<div class="clear"></div>';
					elseif ($free_shipping == false)
						echo '	<div class="contentText">'.TEXT_ENTER_SHIPPING_INFORMATION.'</div>';
					echo '		<div class="contentText">
						<table summary="" width="100%">';
					if ($free_shipping == true)
						echo'	<tr>
								<td colspan="3"><strong>'.FREE_SHIPPING_TITLE.'&nbsp;'.$quotes[$i]['icon'].'</strong></td>
							</tr>
							<tr id="defaultShipping" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowShipping(this, 0)">
								<td colspan="2">'.sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free').'</td>
							</tr>';
					elseif(sizeof($quotes) > 0){
						$radio_buttons = 0;
						for ($i=0, $n=sizeof($quotes); $i<$n; $i++){
							echo	'<tr>
									<td colspan="3"><strong>'.$quotes[$i]['module'].'&nbsp;'.(isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon']) ? $quotes[$i]['icon'] : '').'</strong></td>
								</tr>';
							if (isset($quotes[$i]['error']))
								echo	'<tr>
									<td colspan="3"><strong>'.$quotes[$i]['error'].'</strong></td>
								</tr>';
							else {
								for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++){
									$checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);
									if ( ($checked == true) || ($n == 1 && $n2 == 1) )
										echo '      <tr id="defaultShipping" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowShipping(this, ' . $radio_buttons . ')">' . "\n";
									else
										echo '      <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowShipping(this, ' . $radio_buttons . ')">' . "\n";
									echo '<td>'.$quotes[$i]['methods'][$j]['title'].'</td>';
									if ( ($n > 1) || ($n2 > 1) )
										echo	'		<td>'.$currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))).'</td>
													<td align="right">'.tep_draw_radio_field('shipping', $quotes[$i]['id'].'_'.$quotes[$i]['methods'][$j]['id'], $checked).'</td>';
									else
										echo	'		<td align="right" colspan="2">'.$currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']).'</td>';
									echo	'	</tr>';
									$radio_buttons++;}}}}
				echo	'	</table>
					</div>
				</div>';
				}
?>
				<div class="clear">&nbsp;</div>
			</div>
		</div>
		<?php } ?>
		<div id="payment" class="contentText">
			<div class="ui-widget-header">
				<div class="left"><?php echo TITLE_BILLING_ADDRESS; ?></div>
				<div class="right"><?php echo TABLE_HEADING_PAYMENT_METHOD;?></div>
				<div class="clear"></div>
			</div>
			<div class="ui-widget-content">
				<div class="contentLeft">
					<div id="paymentAddress" class="contentText">
						<?php echo tep_address_label($customer_id, $billto, true, ' ', '<br />'); ?>
					</div>
					<div id="changePaymentAddress" class="contentText">
						<?php echo tep_draw_button(IMAGE_BUTTON_CHANGE_ADDRESS, 'home', tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL')); ?>
					</div>
				</div>
				<div id="paymentRows" class="contentRight">
					<?php
					$selection = $payment_modules->selection();
					if (sizeof($selection) > 1)
						echo	'<div class="contentText">'. TEXT_SELECT_PAYMENT_METHOD.'</div>
									<div class="right"><strong>'.TITLE_PLEASE_SELECT.'</strong></div>
									<div class="clear"></div>';
					else echo 	'<div class="contentText">'.TEXT_ENTER_PAYMENT_INFORMATION.'</div>';
						echo	'<div class="contentText">';
					$radio_buttons = 0;
					for ($i=0, $n=sizeof($selection); $i<$n; $i++){
						echo	'<table border="0" width="100%" cellspacing="0" cellpadding="2" id="paymentTable">';		
						if ( ($selection[$i]['id'] == $payment) || ($n == 1) )
							echo '	<tr id="defaultPayment" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowPayment(this, ' . $radio_buttons . ');">' . "\n";
						else
							echo '	<tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowPayment(this, ' . $radio_buttons . ');">' . "\n";
						echo'			<td><strong>'.$selection[$i]['module'].'</strong></td>
									<td align="right">';
						if (sizeof($selection) > 1)
							echo tep_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $payment));
						else
							echo tep_draw_hidden_field('payment', $selection[$i]['id']);
						echo'        		</td>
						      		</tr>';
						if (isset($selection[$i]['error']))
							echo'	<tr>
									<td colspan="2">'.$selection[$i]['error'].'</td>
								</tr>';
						elseif ($confirmation = $$selection[$i]['id']->confirmation())
							for ($j=0, $n2=sizeof($confirmation['fields']); $j<$n2; $j++)
								echo '	<tr class="confirmation"><td colspan="2">
										<div class="conf1">'.$confirmation['fields'][$j]['title'].'</div>
										<div class="conf2">'.$confirmation['fields'][$j]['field'].'</div>
									</td></tr>';
						echo '	</table>';
						if ($jscript != 'true') echo '<hr>';
						$radio_buttons++;
						}
					?>
					</div>
				</div>
				<div class="clear">&nbsp;</div>
			</div>
		</div>
		<div id="comments" class="contentText">
			<div class="ui-widget-header"><?php echo TABLE_HEADING_COMMENTS; ?></div>
			<div class="ui-widget-content">
				<?php echo tep_draw_textarea_field('comments', 'soft', '60', '5', $comments); ?>
			</div>
		</div>
		<div id="processCheckout" class="contentText">
			<?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', null, 'primary'); ?>
		</div>
		</form>
	</div>
	<?php if ($jscript == 'true') { ?> 
	<div id="Addresses" title="<?php echo TABLE_HEADING_MANAGE_ADDRESSES;?>">
		<?php $addresses_count = tep_count_customer_address_book_entries();?>
		<?php require(DIR_WS_INCLUDES . 'form_check.js.php'); ?>
		<div class="contentContainer">
			<?php if ($processAddress == false) { ?>
			<div id="AddressBook">
				<?php if ($messageStack->size('address') > 0) echo $messageStack->output('address');
				echo tep_draw_form('addressbook', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'post', '', true) . tep_draw_hidden_field('action', $_GET['type']);
				echo '<h3>'.TABLE_HEADING_ADDRESS_BOOK_ENTRIES.'</h3>';
				$radio_buttons = 0;
				$addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "'");
				while ($addresses = tep_db_fetch_array($addresses_query)){
					$format_id = tep_get_address_format_id($addresses['country_id']);
					if ($addresses['address_book_id'] == $sendto)
						echo '	<div id="defaultAddress" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowAddress(this, ' . $radio_buttons . ')">';
					else
						echo '	<div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowAddress(this, ' . $radio_buttons . ')">';
					echo '      		<div class="addressblock">'.tep_address_format($format_id, $addresses, true, ' ', '<br />').'</div>
								<div class="addressicons">
									<a href="'.tep_href_link(FILENAME_CHECKOUT, 'form=address&aID='.$addresses['address_book_id'].'&type='.$_GET['type'], 'SSL').'"><span class="ui-icon ui-icon-pencil" title="'.IMAGE_BUTTON_EDIT_ADDRESS.'" style="display:inline-block;">&nbsp;</span></a>
									<a href="'.tep_href_link(FILENAME_CHECKOUT, 'addresses=open&delete='.$addresses['address_book_id'].'&type='.$_GET['type'], 'SSL').'"><span class="ui-icon ui-icon-trash" title="'.IMAGE_BUTTON_DELETE.'" style="display:inline-block;">&nbsp;</span></a>
								</div>
								<div class="addressradio">'.tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == ($_GET['type'] == 'sendto' ? $sendto : $billto))).'</div>';
					if ($addresses['address_book_id'] == $customer_default_address_id) {
					echo '      		<div class="addressprimary">'.PRIMARY_ADDRESS.'</div>';
					}
					echo '      		<div class="clear"></div>
							</div>';
					$radio_buttons++;}
				?>
				<div class="contentText">
					<div style="float: right;"><?php echo tep_draw_button(IMAGE_BUTTON_UPDATE, 'triangle-1-e', null, 'primary'); ?></div>
				<?php if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
					echo '<div style="float: right;">'.tep_draw_button(IMAGE_BUTTON_ADD_ADDRESS, 'plusthick', tep_href_link(FILENAME_CHECKOUT, 'form=address&type='.$_GET['type'], 'SSL'), 'primary').'</div>';
				} ?>
				</form>
				</div>
			</div>
			<?php } elseif ($processAddress == true) { ?>
			<div id="AddressForm">
				<?php if ($messageStack->size('address') > 0) echo $messageStack->output('address'); ?>
				<?php echo tep_draw_form('addressform', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'post', 'onsubmit="return check_form_optional(addressform);"', true) . tep_draw_hidden_field('action', $_GET['type']); ?>
				<?php
				if (!isset($processAddress)) $processAddress = false;
				$entry_country = $default_country;
				$entry_state = '';
				if (isset($_GET['aID']) && tep_not_null($_GET['aID'])){
					$address_query = tep_db_query("select address_book_id, entry_gender, entry_firstname, entry_lastname, entry_company, entry_street_address, entry_suburb, entry_city, entry_postcode, entry_state, entry_zone_id, entry_country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$_GET['aID'] . "'");
					$address = tep_db_fetch_array($address_query);
					$entry_country = $address['entry_country_id'];
					$entry_state = (tep_not_null($address['entry_state']) ? $address['entry_state'] : (tep_not_null($address['entry_zone_id']) ? tep_get_zone_name($address['entry_country_id'], $address['entry_zone_id'], '') : ''));
					echo tep_draw_hidden_field('aID', $_GET['aID']);}
				if (isset($_POST['country']) && tep_not_null($_POST['country'])) $entry_country = $_POST['country'];
				?>
				<h3><?php echo (isset($_GET['aID']) && tep_not_null($_GET['aID']) ? TABLE_HEADING_EDIT_ADDRESS : TABLE_HEADING_NEW_ADDRESS); ?></h3>
				<?php if (ACCOUNT_GENDER == 'true') { ?>
				<p class="fields"><?php echo tep_draw_radio_field('gender', 'm', ($address['entry_gender'] == 'm' ? true : false)).'&nbsp;&nbsp;'.MALE.'&nbsp;&nbsp;'.tep_draw_radio_field('gender', 'f', ($address['entry_gender'] == 'f' ? true : false)).'&nbsp;&nbsp;'.FEMALE.'&nbsp;'; ?></p>
				<?php } ?>
				<p class="fields"><?php echo tep_draw_input_field('firstname', $address['entry_firstname'], (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_FIRST_NAME.'" data-len="'.ENTRY_FIRST_NAME_MIN_LENGTH.'" data-msg="'.ENTRY_FIRST_NAME_ERROR.'"'); ?></p>
				<p class="fields"><?php echo tep_draw_input_field('lastname', $address['entry_lastname'], (tep_not_null(ENTRY_LAST_NAME_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_LAST_NAME.'" data-len="'.ENTRY_LAST_NAME_MIN_LENGTH.'" data-msg="'.ENTRY_LAST_NAME_ERROR.'"'); ?></p>
				<?php if (ACCOUNT_COMPANY == 'true') { ?>
				<p class="fields"><?php echo tep_draw_input_field('company', $address['entry_company'], (tep_not_null(ENTRY_COMPANY_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_COMPANY.'" data-len="'.ENTRY_COMPANY_MIN_LENGTH.'" data-msg="'.ENTRY_COMPANY_ERROR.'"'); ?></p>
				<?php } ?>
				<p class="fields"><?php echo tep_draw_input_field('street_address', $address['entry_street_address'], (tep_not_null(ENTRY_STREET_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_STREET_ADDRESS.'" data-len="'.ENTRY_STREET_ADDRESS_MIN_LENGTH.'" data-msg="'.ENTRY_STREET_ADDRESS_ERROR.'"'); ?></p>
				<?php if (ACCOUNT_SUBURB == 'true') { ?>
				<p class="fields"><?php echo tep_draw_input_field('suburb', $address['entry_suburb'], (tep_not_null(ENTRY_SUBURB_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_SUBURB.'"'); ?></p>
				<?php } ?>
				<p class="fields"><?php echo tep_draw_input_field('city', $address['entry_city'], (tep_not_null(ENTRY_CITY_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_CITY.'" data-len="'.ENTRY_CITY_MIN_LENGTH.'" data-msg="'.ENTRY_CITY_ERROR.'"'); ?></p>
				<?php if (ACCOUNT_STATE == 'true') { ?>
				<p class="fields"><?php echo tep_draw_input_field('state', $entry_state, (tep_not_null(ENTRY_STATE_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_STATE.'" data-len="'.ENTRY_STATE_MIN_LENGTH.'" data-msg="'.ENTRY_STATE_ERROR.'"');?></p>
				<?php } ?>
				<p class="fields"><?php echo tep_draw_input_field('postcode', $address['entry_postcode'], (tep_not_null(ENTRY_POST_CODE_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_POST_CODE.'" data-len="'.ENTRY_POSTCODE_MIN_LENGTH.'" data-msg="'.ENTRY_POST_CODE_ERROR.'"'); ?></p>
				<p class="fields"><?php echo tep_get_country_list('country', $entry_country, (tep_not_null(ENTRY_COUNTRY_TEXT) ? 'class="required" ' : '')); ?></p>
				<div class="contentText">
					<div style="float: right;" id="addressFormSubmit"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', null, 'primary'); ?></div>
				</div>
				</form>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?> 
	<?php } else { ?>
	<div id="Account">
		<?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>
		<?php if ((isset($_POST['action']) && ($_POST['action'] == 'forgot' || $_POST['action'] == 'login')) || (isset($_GET['form']) && $_GET['form'] == 'forgot') || (!isset($_GET['form']) && !isset($_POST['action'])))
			{
			if ((isset($_POST['action']) && $_POST['action'] == 'forgot') || (isset($_GET['form']) && $_GET['form'] == 'forgot'))
				$forgotform = 'true';
			}
			elseif ((isset($_POST['action']) && $_POST['action'] == 'account') || (isset($_GET['form']) && $_GET['form'] == 'account')) {$showaccount = true;}?>
		<div id="loginForm"<?php echo ($showaccount == 'true' && $jscript != 'true' ? ' class="hidden"' : '') ?>>
			<div class="contentContainer" style="width:45%; float:left; position:relative;">
				<h1><?php echo HEADING_RETURNING_CUSTOMER; ?></h1>
				<div id="forgot" style="padding:5px;<?php echo ($forgotform == 'true' ? '' : 'display:none;'); ?>">
					<?php echo tep_draw_form('password_forgotten', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'post', '', true) . tep_draw_hidden_field('action', 'forgot'); ?>
					<p style="width:75%;margin:auto;"><?php echo TEXT_PASSWORD_REMINDER;?></p>
					<p class="fields" style="padding-left:50px;"><noscript><?php echo ENTRY_EMAIL_ADDRESS;?><br></noscript><?php echo tep_draw_input_field('email_address', '', 'title="'.ENTRY_EMAIL_ADDRESS.'"');?></p>
					<div style="text-align:center;padding-bottom:25px;">
						<span class="buttonAction"><?php echo tep_draw_button(IMAGE_BUTTON_RESET_PASSWORD, 'triangle-1-e', null, 'primary'); ?></span>
						<span id="cancelForgot"><?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'triangle-1-w', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'primary'); ?></span>
					</div>
					</form>
				</div>
				<div id="login" style="padding:5px;<?php echo ($forgotform == 'true' ? 'display:none;' : ''); ?>">
					<?php echo tep_draw_form('login', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'post', '', true) . tep_draw_hidden_field('action', 'login'); ?>
						<p class="fields" style="padding-left:50px;"><noscript><?php echo ENTRY_EMAIL_ADDRESS;?><br></noscript><?php echo tep_draw_input_field('email_address', '', 'title="'.ENTRY_EMAIL_ADDRESS.'"');?></p>
						<p class="fields" style="padding-left:50px;<?php echo ($jscript != 'true' ? 'display:none;':''); ?>"><?php echo tep_draw_input_field('passclone', '', 'title="'.ENTRY_PASSWORD.'"');?></p>
						<p class="fields" style="padding-left:50px;<?php echo ($jscript == 'true' ? 'display:none;':''); ?>"><noscript><?php echo ENTRY_PASSWORD;?><br></noscript><?php echo tep_draw_password_field('password');?></p>
					<div style="text-align:center;padding-bottom:25px;"><?php echo tep_draw_button(IMAGE_BUTTON_LOGIN, 'key', null, 'primary'); ?></div>
					<div style="text-decoration:underline;position:absolute;bottom:10px;;right:15px;cursor:pointer;"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT, 'form=forgot', 'SSL') . '" id="forgotLink">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
					</form>
				</div>
				<div class="clear"></div>
			</div>
			<div class="contentContainer" style="width: 45%; float: left; border-left: 1px dashed #ccc; padding-left: 3%; margin-left: 3%;">
				<h1><?php echo HEADING_NEW_CUSTOMER; ?></h1>
				<div class="contentText" style="text-align:center;padding-top:15px;">
					<noscript><b></noscript><span id="openCreate"><?php echo tep_draw_button(IMAGE_BUTTON_CREATE, 'triangle-1-e', tep_href_link(FILENAME_CHECKOUT, 'form=account', 'SSL')); ?></span><noscript></b></noscript>
					<?php if ($jscript == 'true') { ?><span id="createHelp" class="ui-icon ui-icon-help" style="display:inline-block;cursor:help;" rel="<?php echo TEXT_NEW_CUSTOMER_INTRODUCTION;?>">&nbsp;</span><?php } ?>
					<noscript><p id="createHelp"><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION;?></p></noscript>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php if ($showaccount == 'true') { ?>
		<div id="NewAccount" title="<?php echo TABLE_HEADING_NEW_CUSTOMER;?>"<?php echo ($jscript == 'true' ? ' class="hidden"':''); ?>>
			<?php require('includes/form_check.js.php'); ?>
			<?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?>
			<?php echo tep_draw_form('create_account', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'post', 'onsubmit="return check_form(create_account);"', true) . tep_draw_hidden_field('action', 'account'); ?>
			<?php
			$entry_country = $default_country;
			$entry_state = '';
			if (isset($_POST['country']) && tep_not_null($_POST['country'])) $entry_country = $_POST['country'];
			?>
			<h3><?php echo ($_POST['accountType'] == 'guest' ? TABLE_HEADING_NEW_GUEST : TABLE_HEADING_NEW_CUSTOMER); ?></h3>
			<p class="fields"><noscript><?php echo ENTRY_EMAIL_ADDRESS;?><br></noscript><?php echo tep_draw_input_field('email_address', '', (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_EMAIL_ADDRESS.'" data-len="'.ENTRY_EMAIL_ADDRESS_MIN_LENGTH.'" data-msg="'.ENTRY_EMAIL_ADDRESS_ERROR.'"');?></p>
			<p class="fields<?php echo ($jscript != 'true' ? ' hidden':''); ?>"><?php echo tep_draw_input_field('passclone', '', (tep_not_null(ENTRY_PASSWORD_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_PASSWORD.'"');?></p>
			<p class="fields"<?php echo ($jscript != 'true' ? '':' style="display:none;"'); ?>><noscript><?php echo ENTRY_PASSWORD;?><br></noscript><?php echo tep_draw_password_field('password', '', (tep_not_null(ENTRY_PASSWORD_TEXT) ? 'class="required"' : '') .  'data-len="'.ENTRY_PASSWORD_MIN_LENGTH.'" data-msg="'.ENTRY_PASSWORD_ERROR.'"');?></p>
			<p class="fields<?php echo ($jscript != 'true' ? ' hidden':''); ?>"><?php echo tep_draw_input_field('confclone', '', (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_PASSWORD_CONFIRMATION.'"');?></p>
			<p class="fields"<?php echo ($jscript != 'true' ? '':' style="display:none;"'); ?>><noscript><?php echo ENTRY_PASSWORD_CONFIRMATION;?><br></noscript><?php echo tep_draw_password_field('confirmation', '', (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? 'class="required"' : '').' data-len="'.ENTRY_PASSWORD_MIN_LENGTH.'" data-msg="'.ENTRY_PASSWORD_ERROR.'" data-mtch="'.ENTRY_PASSWORD_ERROR_NOT_MATCHING.'"');?></p>
			<?php if (ACCOUNT_GENDER == 'true') { ?>
			<p class="fields"><?php echo tep_draw_radio_field('gender', 'm').'&nbsp;&nbsp;'.MALE.'&nbsp;&nbsp;'.tep_draw_radio_field('gender', 'f').'&nbsp;&nbsp;'.FEMALE.'&nbsp;'; ?></p>
			<?php } ?>
			<p class="fields"><noscript><?php echo ENTRY_FIRST_NAME;?><br></noscript><?php echo tep_draw_input_field('firstname', '', (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_FIRST_NAME.'" data-len="'.ENTRY_FIRST_NAME_MIN_LENGTH.'" data-msg="'.ENTRY_FIRST_NAME_ERROR.'"'); ?></p>
			<p class="fields"><noscript><?php echo ENTRY_LAST_NAME;?><br></noscript><?php echo tep_draw_input_field('lastname', '', (tep_not_null(ENTRY_LAST_NAME_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_LAST_NAME.'" data-len="'.ENTRY_LAST_NAME_MIN_LENGTH.'" data-msg="'.ENTRY_LAST_NAME_ERROR.'"'); ?></p>
			<?php if (ACCOUNT_DOB == 'true') { ?>
			<p class="fields"><noscript><?php echo ENTRY_DATE_OF_BIRTH;?><br></noscript><?php echo tep_draw_input_field('dob', '', 'id="dobf" '.(tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_DATE_OF_BIRTH.'" data-len="'.ENTRY_DOB_MIN_LENGTH.'" data-msg="'.ENTRY_DATE_OF_BIRTH_ERROR.'"');?></p>
			<?php } ?>
			<?php if (ACCOUNT_COMPANY == 'true') { ?>
			<p class="fields"><noscript><?php echo ENTRY_COMPANY;?><br></noscript><?php echo tep_draw_input_field('company', '', (tep_not_null(ENTRY_COMPANY_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_COMPANY.'" data-len="'.ENTRY_COMPANY_MIN_LENGTH.'" data-msg="'.ENTRY_COMPANY_ERROR.'"'); ?></p>
			<?php } ?>
			<p class="fields"><noscript><?php echo ENTRY_STREET_ADDRESS;?><br></noscript><?php echo tep_draw_input_field('street_address', '', (tep_not_null(ENTRY_STREET_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_STREET_ADDRESS.'" data-len="'.ENTRY_STREET_ADDRESS_MIN_LENGTH.'" data-msg="'.ENTRY_STREET_ADDRESS_ERROR.'"'); ?></p>
					<?php if (ACCOUNT_SUBURB == 'true') { ?>
			<p class="fields"><noscript><?php echo ENTRY_SUBURB;?><br></noscript><?php echo tep_draw_input_field('suburb', '', (tep_not_null(ENTRY_SUBURB_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_SUBURB.'"'); ?></p>
			<?php } ?>
			<p class="fields"><noscript><?php echo ENTRY_CITY;?><br></noscript><?php echo tep_draw_input_field('city', '', (tep_not_null(ENTRY_CITY_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_CITY.'" data-len="'.ENTRY_CITY_MIN_LENGTH.'" data-msg="'.ENTRY_CITY_ERROR.'"'); ?></p>
			<?php if (ACCOUNT_STATE == 'true') { ?>
			<div><noscript><?php echo ENTRY_STATE;?><br></noscript><p class="fields" id="NFState">
							<?php
							if ($processAccount == true)
								{
								if ($entry_state_has_zones == true)
									{
									$zones_array = array();
									$zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
									while ($zones_values = tep_db_fetch_array($zones_query))
										$zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
									echo tep_draw_pull_down_menu('state', $zones_array, '', (tep_not_null(ENTRY_STATE_TEXT) ? 'class="required" ' : ''));
									}
								else echo tep_draw_input_field('state', '', (tep_not_null(ENTRY_STATE_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_STATE.'" data-len="'.ENTRY_STATE_MIN_LENGTH.'" data-msg="'.ENTRY_STATE_ERROR.'"');
								}
							else echo tep_draw_input_field('state', '', (tep_not_null(ENTRY_STATE_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_STATE.'" data-len="'.ENTRY_STATE_MIN_LENGTH.'" data-msg="'.ENTRY_STATE_ERROR.'"');
							?>
			</p></div>
			<?php } ?>
			<p class="fields"><noscript><?php echo ENTRY_POST_CODE;?><br></noscript><?php echo tep_draw_input_field('postcode', '', (tep_not_null(ENTRY_POST_CODE_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_POST_CODE.'" data-len="'.ENTRY_POSTCODE_MIN_LENGTH.'" data-msg="'.ENTRY_POST_CODE_ERROR.'"'); ?></p>
			<p class="fields"><noscript><?php echo ENTRY_COUNTRY;?><br></noscript><?php echo tep_get_country_list('country', $entry_country, (tep_not_null(ENTRY_COUNTRY_TEXT) ? 'class="required" ' : '')); ?></p>
			<p class="fields"><noscript><?php echo ENTRY_TELEPHONE_NUMBER;?><br></noscript><?php echo tep_draw_input_field('telephone', '', (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_TELEPHONE_NUMBER.'" data-len="'.ENTRY_TELEPHONE_MIN_LENGTH.'" data-msg="'.ENTRY_TELEPHONE_NUMBER_ERROR.'"');?></p>
			<p class="fields"><noscript><?php echo ENTRY_FAX_NUMBER;?><br></noscript><?php echo tep_draw_input_field('fax', '', (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? 'class="required" ' : '').'title="'.ENTRY_FAX_NUMBER.'"');?></p>
			<p class="fields"><?php echo ENTRY_NEWSLETTER;?>&nbsp;<?php echo tep_draw_checkbox_field('newsletter', '1', false, (tep_not_null(ENTRY_NEWSLETTER_TEXT) ? 'class="required"' : '')); ?>&nbsp;</p>
			<div style="text-align:center;padding-bottom:15px;"><span id="accountSubmit" style="float:right;"><?php echo tep_draw_button(IMAGE_BUTTON_CREATE, 'person', null, 'primary'); ?></span><noscript><?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'triangle-1-w', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'primary'); ?></noscript></div>
		</form>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>
<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
