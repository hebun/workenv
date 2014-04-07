<?php
/*
AJAX Checkout for OsCommerce

Advance Software


Copyright (c) 2007 Advance Software

*/
class ajaxManagerTest extends ajaxManager {

	var $arrSessionVar = array();
	var $arrAllowedPaymentModules = array(
		'cod',
		'moneyorder',
		'paypal',
		'ajax_authorizenet'
		);

		function ajaxManagerTest($arrSessionVar) {

			parent::ajaxManager();
			$this->arrSessionVar = $arrSessionVar;

			$this->registerPageAction('showProducts','showProducts');
			$this->registerPageAction('showTotals','showTotals');
			$this->registerPageAction('showCreateAccount','showCreateAccount');
			$this->registerPageAction('showShipping','showShipping');
			$this->registerPageAction('showPayment','showPayment');
			$this->registerPageAction('showLogin','showLogin');

			$this->registerPageAction('showShippingInfo','showShippingInfo');

			$this->registerPageAction('PerformLogin','PerformLogin');
			$this->registerPageAction('PerformCreateAccount','PerformCreateAccount');
			$this->registerPageAction('PerformShippingSelection','PerformShippingSelection');
			$this->registerPageAction('PerformShippingAddress','PerformShippingAddress');
			$this->registerPageAction('PerformShippingAddressSelection','PerformShippingAddressSelection');

			$this->registerPageAction('PerformPaymentSelection','PerformPaymentSelection');
			$this->registerPageAction('PerformPaymentAddress','PerformPaymentAddress');
			$this->registerPageAction('PerformPaymentAddressSelection','PerformPaymentAddressSelection');

			$this->registerPageAction('showPlaceOrder','showPlaceOrder');
			$this->registerPageAction('createSession','createSession');
			$this->registerPageAction('showChangeAddress','showChangeAddress');
			$this->registerPageAction('showChangePaymentAddress','showChangePaymentAddress');
			$this->registerPageAction('PerformPlaceOrder','PerformPlaceOrder');

		}

		function PerformPlaceOrder($get)
		{
			$error = false;
			$buffer = $this->performAction2Buffer("_PerformPlaceOrder", $get ,$error);

			if ($error == false)
			{
				echo '<divresult name="ajaxManager">'.$buffer.'</divresult>';
			}
			else
			{
				echo '<divresult name="payment_area">'.$buffer.'</divresult><divresult name="placeorder_area"></divresult>';
			}

		}

		function _PerformPlaceOrder($get, &$error)
		{
			global $language, $order, $currencies, $order_total_modules, $cart, $languages_id, $customer_id, $customer_default_address_id,
			$sendto, $billto, $shipping, $payment, $get_vars_array;

			$get_vars_array = $get;
			$error = false;

			include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);

			// load selected payment module
			$payment_modules = new payment($payment);

			// load the selected shipping module
			$shipping_modules = new shipping($shipping);

			$order = new order;
			$this->getAndPrepare('comments', $get_vars_array, $order->info['comments']);

			// load the before_process function from the payment modules
			$_resp = $payment_modules->before_process();

			if ($_resp['error'] == false) {
				if ($cart->count_contents() < 1) {
					include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);
					$_resp = array('error'=>true, 'message'=> TEXT_CART_EMPTY);
				}

			}

			$error = $_resp['error'];

			if ($error == true) {
				echo '<div class="alert alert-error">'.$_resp['message'].'</div>';
				$this->showPayment($get);
			}
			else
			{

				$order_total_modules = new order_total;
				$order_totals = $order_total_modules->process();

				$sql_data_array = array('customers_id' => $customer_id,
				'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
				'customers_company' => $order->customer['company'],
				'customers_street_address' => $order->customer['street_address'],
				'customers_suburb' => $order->customer['suburb'],
				'customers_city' => $order->customer['city'],
				'customers_postcode' => $order->customer['postcode'], 
				'customers_state' => $order->customer['state'], 
				'customers_country' => $order->customer['country']['title'], 
				'customers_telephone' => $order->customer['telephone'], 
				'customers_email_address' => $order->customer['email_address'],
				'customers_address_format_id' => $order->customer['format_id'], 
				'delivery_name' => $order->delivery['firstname'] . ' ' . $order->delivery['lastname'], 
				'delivery_company' => $order->delivery['company'],
				'delivery_street_address' => $order->delivery['street_address'], 
				'delivery_suburb' => $order->delivery['suburb'], 
				'delivery_city' => $order->delivery['city'], 
				'delivery_postcode' => $order->delivery['postcode'], 
				'delivery_state' => $order->delivery['state'], 
				'delivery_country' => $order->delivery['country']['title'], 
				'delivery_address_format_id' => $order->delivery['format_id'], 
				'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'], 
				'billing_company' => $order->billing['company'],
				'billing_street_address' => $order->billing['street_address'], 
				'billing_suburb' => $order->billing['suburb'], 
				'billing_city' => $order->billing['city'], 
				'billing_postcode' => $order->billing['postcode'], 
				'billing_state' => $order->billing['state'], 
				'billing_country' => $order->billing['country']['title'], 
				'billing_address_format_id' => $order->billing['format_id'], 
				'payment_method' => $order->info['payment_method'], 
				'cc_type' => $order->info['cc_type'], 
				'cc_owner' => $order->info['cc_owner'], 
				'cc_number' => $order->info['cc_number'], 
				'cc_expires' => $order->info['cc_expires'], 
				'date_purchased' => 'now()', 
				'orders_status' => $order->info['order_status'], 
				'currency' => $order->info['currency'], 
				'currency_value' => $order->info['currency_value']);
				tep_db_perform(TABLE_ORDERS, $sql_data_array);
				$insert_id = tep_db_insert_id();
				for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
					$sql_data_array = array('orders_id' => $insert_id,
					'title' => $order_totals[$i]['title'],
					'text' => $order_totals[$i]['text'],
					'value' => $order_totals[$i]['value'], 
					'class' => $order_totals[$i]['code'], 
					'sort_order' => $order_totals[$i]['sort_order']);
					tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
				}

				$customer_notification = (SEND_EMAILS == 'true') ? '1' : '0';
		        $sql_data_array = array('orders_id' => $insert_id,
		                                'orders_status_id' => $order->info['order_status'],
		                                'date_added' => 'now()',
		                                'customer_notified' => $customer_notification,
		                                'comments' => $order->info['comments']);
		        tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

		      // initialized for the email confirmation
		        $products_ordered = '';
		        $subtotal = 0;
		        $total_tax = 0;

				for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {

					if (STOCK_LIMITED == 'true') {
						if (DOWNLOAD_ENABLED == 'true') {
							$stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename 
								FROM " . TABLE_PRODUCTS . " p
								LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa
								ON p.products_id=pa.products_id
								LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
								ON pa.products_attributes_id=pad.products_attributes_id
								WHERE p.products_id = '" . tep_get_prid($order->products[$i]['id']) . "'";
							// Will work with only one option for downloadable products
							// otherwise, we have to build the query dynamically with a loop
							$products_attributes = $order->products[$i]['attributes'];

							if (is_array($products_attributes)) {
								$stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
							}
							$stock_query = tep_db_query($stock_query_raw);
						} else {
							$stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
						}
						if (tep_db_num_rows($stock_query) > 0) {
							$stock_values = tep_db_fetch_array($stock_query);
							// do not decrement quantities if products_attributes_filename exists
							if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
								$stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
							} else {
								$stock_left = $stock_values['products_quantity'];
							}
							tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . $stock_left . "' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
							if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
								tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
							}
						}
					}

					// Update products_ordered (for bestsellers list)
					tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");

					$sql_data_array = array('orders_id' => $insert_id, 
					'products_id' => tep_get_prid($order->products[$i]['id']), 
					'products_model' => $order->products[$i]['model'], 
					'products_name' => $order->products[$i]['name'], 
					'products_price' => $order->products[$i]['price'], 
					'final_price' => $order->products[$i]['final_price'], 
					'products_tax' => $order->products[$i]['tax'], 
					'products_quantity' => $order->products[$i]['qty']);
					tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);
					$order_products_id = tep_db_insert_id();

					//------insert customer choosen option to order--------
					$attributes_exist = '0';
					$products_ordered_attributes = '';


					if (isset($order->products[$i]['attributes'])) {
						$attributes_exist = '1';
						for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
							if (DOWNLOAD_ENABLED == 'true') {
								$attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
									from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
									left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
									on pa.products_attributes_id=pad.products_attributes_id
									where pa.products_id = '" . $order->products[$i]['id'] . "' 
									and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
									and pa.options_id = popt.products_options_id 
									and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
									and pa.options_values_id = poval.products_options_values_id 
									and popt.language_id = '" . $languages_id . "' 
									and poval.language_id = '" . $languages_id . "'";
								$attributes = tep_db_query($attributes_query);
							} else {
								$attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
							}
							$attributes_values = tep_db_fetch_array($attributes);


							$sql_data_array = array('orders_id' => $insert_id, 
							'orders_products_id' => $order_products_id, 
							'products_options' => $attributes_values['products_options_name'],
							'products_options_values' => $attributes_values['products_options_values_name'], 
							'options_values_price' => $attributes_values['options_values_price'], 
							'price_prefix' => $attributes_values['price_prefix']);
							tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

							if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {
								$sql_data_array = array('orders_id' => $insert_id, 
								'orders_products_id' => $order_products_id, 
								'orders_products_filename' => $attributes_values['products_attributes_filename'], 
								'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
								'download_count' => $attributes_values['products_attributes_maxcount']);
								tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
							}
							$products_ordered_attributes .= "\n\t" . $attributes_values['products_options_name'] . ' ' . $attributes_values['products_options_values_name'];
						}
					}
					//------insert customer choosen option eof ----
					$total_weight += ($order->products[$i]['qty'] * $order->products[$i]['weight']);
					$total_tax += tep_calculate_tax($total_products_price, $products_tax) * $order->products[$i]['qty'];
					$total_cost += $total_products_price;

					$products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . ' (' . $order->products[$i]['model'] . ') = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "\n";
				}

				// lets start with the email confirmation
				$email_order = STORE_NAME . "\n" . 
					EMAIL_SEPARATOR . "\n" . 
					EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "\n" .
					EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "\n" .
					EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";
				if ($order->info['comments']) {
					$email_order .= tep_db_output($order->info['comments']) . "\n\n";
				}
				$email_order .= EMAIL_TEXT_PRODUCTS . "\n" . 
					EMAIL_SEPARATOR . "\n" . 
					$products_ordered . 
					EMAIL_SEPARATOR . "\n";

				for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
					$email_order .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "\n";
				}

				if ($order->content_type != 'virtual') {
					$email_order .= "\n" . EMAIL_TEXT_DELIVERY_ADDRESS . "\n" . 
						EMAIL_SEPARATOR . "\n" .
						tep_address_label($customer_id, $sendto, 0, '', "\n") . "\n";
				}

				$email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
					EMAIL_SEPARATOR . "\n" .
					tep_address_label($customer_id, $billto, 0, '', "\n") . "\n\n";
				$$payment = $GLOBALS[$payment];

			  if (is_object($$payment)) {
			    $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" .
			                    EMAIL_SEPARATOR . "\n";
			    $payment_class = $$payment;
			    $email_order .= $order->info['payment_method'] . "\n\n";
			    if (isset($payment_class->email_footer)) {
			      $email_order .= $payment_class->email_footer . "\n\n";
			    }
			  }
			  tep_mail($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT . ' - ' . $insert_id, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

				// send emails to other people
				if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
					tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT . ' - ' . $insert_id, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
				}

				// load the after_process function from the payment modules
				$payment_modules->after_process();
				$cart->reset(true);

				// unregister session variables used during checkout
				ajaxSessionUnregister('sendto');
				ajaxSessionUnregister('billto');
				ajaxSessionUnregister('shipping');
				ajaxSessionUnregister('payment');
				ajaxSessionUnregister('comments');

				//output a success page
				require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

				$global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
				$global = tep_db_fetch_array($global_query);

				if ($global['global_product_notifications'] != '1') {
					$orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
					$orders = tep_db_fetch_array($orders_query);

					$products_array = array();
					$products_query = tep_db_query("select products_id, products_name from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$orders['orders_id'] . "' order by products_name");
					while ($products = tep_db_fetch_array($products_query)) {
						$products_array[] = array('id' => $products['products_id'],
						'text' => $products['products_name']);
					}
				}

				?>

				<h1><?php echo HEADING_TITLE; ?></h1>

				<?php echo tep_draw_form('order', tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?>

				<div class="contentContainer">
					<div class="contentText">
						<?php echo TEXT_SUCCESS; ?>
					</div>

					<div class="contentText">

						<?php
					if ($global['global_product_notifications'] != '1') {
						echo TEXT_NOTIFY_PRODUCTS . '<br /><p class="productsNotifications">';

						$products_displayed = array();
						for ($i=0, $n=sizeof($products_array); $i<$n; $i++) {
							if (!in_array($products_array[$i]['id'], $products_displayed)) {
								echo tep_draw_checkbox_field('notify[]', $products_array[$i]['id']) . ' ' . $products_array[$i]['text'] . '<br />';
								$products_displayed[] = $products_array[$i]['id'];
							}
						}

						echo '</p>';
					}

					echo TEXT_SEE_ORDERS . '<br /><br />' . TEXT_CONTACT_STORE_OWNER;
					?>

				</div>

				<div class="contentText">
					<h3><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h3>
				</div>

				<?php
				if (DOWNLOAD_ENABLED == 'true') {
					include(DIR_WS_MODULES . 'downloads.php');
				}
				?>

				<div class="buttonSet">

					<span style=""><button type="submit" class="classname ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-primary" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text"><?php echo IMAGE_BUTTON_CONTINUE; ?></span></button></span>
				</div>
			</div>

		</form>

		<?
	}

}

function PerformPaymentSelection($get)
{

	$error = false;
	$buffer = $this->performAction2Buffer("_PerformPaymentSelection", $get ,$error);

	echo '<divresult name="payment_area">'.$buffer.'</divresult>';

	$totals_error = false;
	$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
	echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';

	$order_error = false;
	$order_buffer = $this->performAction2Buffer("showPlaceOrder", $get, $order_error);
	echo '<divresult name="placeorder_area">'.$order_buffer.'</divresult>';

}

function _PerformPaymentSelection($get, &$error)
{
	global $payment, $payment_error, $get_vars_array, $SID;

	$get_vars_array = $get;
	$error = false;
	$this->getAndPrepare('payment', $get, $payment);

	if (!ajaxSessionIsRegistered('payment')) ajaxSessionRegister('payment',$payment);

	$payment_modules = new payment($payment);
	$order = new order;

	$payment_modules->update_status();
	$payment_error = false;
	ajaxSessionRegister('payment_error',$payment_error);

	//get all fields of the payment method selected

	$payment_modules->pre_confirmation_check();
	if ($payment_error != false)
	{
		echo '<div class="alert alert-error">'.$payment_error.'</div>';
		$this->showPayment($payment);
		ajaxSessionUnregister("payment");
	}
	else
	{
		$this->showPaymentInfo($payment);
		$this->showAgreeInfo();

		$_tmp = $get_vars_array;
		unset($_tmp['payment']);
		unset($_tmp['ajaxAction']);
		unset($_tmp['target']);
		unset($_tmp[tep_session_name()]);

		ajaxSessionRegister($payment.'_vars', $_tmp);
	}

}

function showPaymentInfo($payment) {
	global $language,$payment;
	require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);

	$payment_modules = new payment($payment);
	//	$shipping_modules = new shipping;
	$order = new order;

	?>
	<div class="ui-widget infoBoxContainer">

		<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo '<strong>' . HEADING_BILLING_ADDRESS . '</strong> <a href="" onClick="javascript:ajaxShowChangePaymentAddress(); return false;"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></strong></div>

		<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="">

			<p style="margin: 0;"><?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>'); ?></p>

		</div>
	</div>



	<div class="ui-widget infoBoxContainer">

		<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo '<strong>' . HEADING_PAYMENT_METHOD . '</strong> <a href="" onClick="javascript:ajaxRefreshPayment();return false;"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></strong></div>

		<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="">

			<p style="margin: 0;"><?php echo $order->info['payment_method']; ?></p>

			<?php
			if (is_array($payment_modules->modules)) {
				if ($confirmation = $payment_modules->confirmation()) {
					?>

					<div>
						<h3><?php echo HEADING_PAYMENT_INFORMATION; ?></h3>

						<p><?php echo $confirmation['title']; ?></p>

						<?php
						for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
							?>

							<p><?php echo $confirmation['fields'][$i]['title']; ?></p>

							<p><?php echo $confirmation['fields'][$i]['field']; ?></p>

							<?php
						}
						?>

						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php

}

function showCommentInfo() {
	global $language;
	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);

	?>
	<div class="ui-widget infoBoxContainer">

		<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo '<strong>' . HEADING_ORDER_COMMENTS . '</strong>'; ?></strong></div>

		<div class="ui-widget-content infoBoxContents ui-corner-bottom" >
			<div class="contentText" style="">
				<?php echo tep_draw_textarea_field('comments', 'soft', '50', '4', null, 'id="comments"'); ?>
			</div>
		</div>
	</div>

	<div style="clear: both;"></div>

	<?php

}


////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function showAgreeInfo() {
	global $language;
	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHIPPING);


	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/MSIE/i',$u_agent))
	{ ?>
		<div class="ui-widget infoBoxContainer" id="agreeForm" style="float:right;"> <?php
	} else { ?>
		<div class="ui-widget infoBoxContainer" id="agreeForm" style="display:none;">
			<?php } ?>
			<div class="ui-state-highlight ui-corner-all" style="display: block; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
					<?php echo CONDITION_AGREEMENT; ?>
					<span><a href="#myModal" data-toggle="modal">
						<u style="main"><?php echo CONDITIONS; ?></u>
					</a></span>

					<?php

					echo tep_draw_checkbox_field('TermsAgree','true', false, 'id="TermsAgree"');
					?></p>
				</div>
			</div>


			<!-- Modal -->
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 style="font-size: 24.5px;" id="myModalLabel"><?php echo CONDITIONS; ?></h3>
				</div>
				<div class="modal-body">
					<p><?=TEXT_INFORMATION?></p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><?=TEXT_AGREE_CLOSE?></button>
					<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><?=TEXT_AGREE_PRESS?></button>
				</div>
			</div>

			<div style="clear: both;"></div>

			<?php

		}


		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		function PerformPaymentAddressSelection($get)
		{
			$error = false;
			$buffer = $this->performAction2Buffer("_PerformPaymentAddressSelection", $get ,$error);
			echo '<divresult name="payment_area">'.$buffer.'</divresult>';

			if ($error == false)
			{
				$totals_error = false;
				$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
				echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';
			}
		}

		function _PerformPaymentAddressSelection($get, &$error)
		{
			global $language,$cart,$customer_id,$billto;
			$this->getAndPrepare('address', $get, $address);

			if (isset($address) && $address > 0) {
				$reset_payment = false;
				if (ajaxSessionIsRegistered('billto')) {
					if ($billto != $address) {
						if (ajaxSessionIsRegistered('payment')) {
							$reset_payment = true;
						}
					}
				} else {
					ajaxSessionRegister('billto',$billto);
				}

				$billto = $address;

				$check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
				$check_address = tep_db_fetch_array($check_address_query);

				if ($check_address['total'] == '1') {
					if ($reset_payment == true) ajaxSessionUnregister('payment');
					$this->showPayment($get);
				} else {
					ajaxSessionUnregister('billto');
				}
			}
			else
			{
				$billto = $customer_default_address_id;
				if (!ajaxSessionIsRegistered('billto')) ajaxSessionRegister('billto',$billto);
				$error = false;
				$this->showPayment($get);
			}

		}

		function PerformPaymentAddress($get)
		{
			$error = false;
			$buffer = $this->performAction2Buffer("_PerformPaymentAddress", $get ,$error);
			echo '<divresult name="payment_area">'.$buffer.'</divresult>';

			if ($error == false)
			{
				$totals_error = false; 
				$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
				echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';
			}
		}

		function _PerformPaymentAddress($get, &$error)
		{
			global $language,$cart,$customer_id,$billto;

			require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
			$process = true;

			if (ACCOUNT_GENDER == 'true') {
				$this->getAndPrepare('gender', $get, $gender);
				if (!isset($gender)) {
					$gender = false;
				}
			}
			$this->getAndPrepare('firstname', $get, $firstname);
			$this->getAndPrepare('lastname', $get, $lastname);
			if (ACCOUNT_COMPANY == 'true') $this->getAndPrepare('company', $get, $company);
			$this->getAndPrepare('street_address', $get, $street_address);
			if (ACCOUNT_SUBURB == 'true') $this->getAndPrepare('suburb', $get, $suburb);
			$this->getAndPrepare('postcode', $get, $postcode);
			$this->getAndPrepare('city', $get, $city);
			if (ACCOUNT_STATE == 'true') {
				$this->getAndPrepare('state', $get, $state);
				$zone_id = false;
			}
			$this->getAndPrepare('country', $get, $country);

			$error = false;
			$error_message = '';

			if (ACCOUNT_GENDER == 'true') {
				if ( ($gender != 'm') && ($gender != 'f') ) {
					$error = true;

					$error_message.= ENTRY_GENDER_ERROR;
				}
			}

			if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_FIRST_NAME_ERROR;
			}

			if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_LAST_NAME_ERROR;
			}

			if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_STREET_ADDRESS_ERROR;
			}

			if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_POST_CODE_ERROR;
			}

			if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_CITY_ERROR;
			}

			if (is_numeric($country) == false) {
				$error = true;

				$error_message .= ENTRY_COUNTRY_ERROR;
			}

			if (ACCOUNT_STATE == 'true') {
				$zone_id = 0;
				$check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
				$check = tep_db_fetch_array($check_query);
				$entry_state_has_zones = ($check['total'] > 0);
				if ($entry_state_has_zones == true) {
					$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name like '" . tep_db_input($state) . "%' or zone_code like '%" . tep_db_input($state) . "%')");
					if (tep_db_num_rows($zone_query) == 1) {
						$zone = tep_db_fetch_array($zone_query);
						$zone_id = $zone['zone_id'];
					} else {
						$error = true;

						$error_message .= ENTRY_STATE_ERROR_SELECT;
					}
				} else {
					if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
						$error = true;

						$error_message .= ENTRY_STATE_ERROR;
					}
				}
			}

			if ($error == false) {

				$sql_data_array = array('customers_id' => $customer_id,
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
						$sql_data_array['entry_state'] = '';
					} else {
						$sql_data_array['entry_zone_id'] = '0';
						$sql_data_array['entry_state'] = $state;
					}
				}

				tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
				$billto = tep_db_insert_id();
				if (!ajaxSessionIsRegistered('billto')) ajaxSessionRegister('billto',$billto);
				if (ajaxSessionIsRegistered('payment')) ajaxSessionUnregister('payment');

			}

			if ($error == true) {
				echo '<div class="alert alert-error">'.$error_message.'</div>';
				$this->showChangePaymentAddress(true, $entry_state_has_zones, $country);
			} else
			{
				$this->showPayment($get);
			} 

		} 


		function showChangePaymentAddress($process = false, $entry_state_has_zones = false, $country = 0)
		{
			global $language;
			global $order, $currencies, $order_total_modules, $cart, $language, $customer_id, $customer_default_address_id, $billto;

			require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT_ADDRESS);
			$addresses_count = tep_count_customer_address_book_entries();

			?>   
			<div class="ui-widget infoBoxContainer">

				<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_PAYMENT_ADDRESS; ?></strong></div>

				<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:left;">

					<p style="float: left; width: 100%;"><?php echo TEXT_SELECTED_PAYMENT_DESTINATION;?></p>



					<div style="width: 45%; float:left; text-align: center;"><?php echo '<strong>' . TITLE_PAYMENT_ADDRESS . '</strong>'; ?>
						<p><?php echo tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></p></div>


						<div style="width: auto; float:right; padding-right:10px;"><?php echo tep_address_label($customer_id, $billto, true, ' ', '<br>'); ?></div>

					</div>
				</div>

				<div style="clear: both;"></div>		




				<?php
				if ($addresses_count > 1) {
					?>
					<div class="ui-widget infoBoxContainer">

						<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></strong></div>

						<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">
							<p style="float: left; width: 70%;"><?php echo TEXT_SELECT_OTHER_PAYMENT_DESTINATION; ?></p>
							<p style="float: right; width: 29%;"><strong><?php echo TITLE_PLEASE_SELECT; ?></strong><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif', null, null, null, 'style="float:right;"'); ?></p>

							<div style="clear: both;"></div>
							<div class="selectChoices">


								<?php
							$radio_buttons = 0;

							$addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "'");
							while ($addresses = tep_db_fetch_array($addresses_query)) {
								$format_id = tep_get_address_format_id($addresses['country_id']);
								?>


								<?php
								if ($addresses['address_book_id'] == $billto) {
									echo '                  <div id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectPaymentAddress(this, ' . $radio_buttons . ')">' . "\n";
								} else {
									echo '                  <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectPaymentAddress(this, ' . $radio_buttons . ')">' . "\n";
								}
								?>
								<span><strong><?php echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?></strong></span>
								<span><?php echo tep_draw_radio_field('payment_address', $addresses['address_book_id'], ($addresses['address_book_id'] == $billto),'id="payment_address_'.$radio_buttons.'"'); ?></span>

							</div>
							<p><?php echo tep_address_format($format_id, $addresses, true, ' ', ', '); ?><p>


							<?php
							$radio_buttons++;
						}
						?>
					</div>
				</div>

				<div style="clear: both;"></div>


				<?php
			}
			if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
				?>
				<div class="ui-widget infoBoxContainer">

					<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_PAYMENT_ADDRESS; ?></strong></div>

					<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">

						<p style="float:right;"><?php echo TEXT_CREATE_NEW_PAYMENT_ADDRESS; ?></p>
						<div><?php require('ajax/includes/' . 'checkout_new_address.php'); ?></div>

						<?php
					}

					?>

				</div>
				<div style="clear: both;"> 
					<div style="float: right; margin-top: 10px;">
						<?php echo draw_button(IMAGE_BUTTON_CONTINUE, 'primary', 'value="Continue" onClick="ajaxPerformPaymentAddress();" id="buttonSelectPaymentAddress"', 'ui-icon-refresh'); ?>
					</div>
				</div>
			</div>
			<?   

		}
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////



		function PerformShippingAddressSelection($get)
		{
			$error = false;
			$buffer = $this->performAction2Buffer("_PerformShippingAddressSelection", $get ,$error);
			echo '<divresult name="shipping_area">'.$buffer.'</divresult>';

			if ($error == false)
			{
				$totals_error = false;
				$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
				echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';
			}
		}

		function _PerformShippingAddressSelection($get, &$error)
		{
			global $language,$cart,$customer_id,$sendto;
			$this->getAndPrepare('address', $get, $address);

			if (isset($address) && $address > 0) {
				$reset_shipping = false;
				if (ajaxSessionIsRegistered('sendto')) {
					if ($sendto != $address) {
						if (ajaxSessionIsRegistered('shipping')) {
							$reset_shipping = true;
						}
					}
				} else {
					ajaxSessionRegister('sendto',$sendto);
				}

				$sendto = $address;

				$check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");
				$check_address = tep_db_fetch_array($check_address_query);

				if ($check_address['total'] == '1') {
					if ($reset_shipping == true) ajaxSessionUnregister('shipping');
					$this->showShipping($get);
				} else {
					ajaxSessionUnregister('sendto');
				}
			}
			else
			{
				$sendto = $customer_default_address_id;
				if (!ajaxSessionIsRegistered('sendto')) ajaxSessionRegister('sendto',$sendto);
				$error = false;
				$this->showShipping($get);
			}

		}

		function PerformShippingAddress($get)
		{
			$error = false;
			$buffer = $this->performAction2Buffer("_PerformShippingAddress", $get ,$error);
			echo '<divresult name="shipping_area">'.$buffer.'</divresult>';

			if ($error == false)
			{
				$totals_error = false;
				$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
				echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';
			}
		}

		function _PerformShippingAddress($get, &$error)
		{
			global $language,$cart,$customer_id,$sendto;

			require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
			$process = true;

			if (ACCOUNT_GENDER == 'true') {
				$this->getAndPrepare('gender', $get, $gender);
				if (!isset($gender)) {
					$gender = false;
				}
			}
			$this->getAndPrepare('firstname', $get, $firstname);
			$this->getAndPrepare('lastname', $get, $lastname);
			if (ACCOUNT_COMPANY == 'true') $this->getAndPrepare('company', $get, $company);
			$this->getAndPrepare('street_address', $get, $street_address);
			if (ACCOUNT_SUBURB == 'true') $this->getAndPrepare('suburb', $get, $suburb);
			$this->getAndPrepare('postcode', $get, $postcode);
			$this->getAndPrepare('city', $get, $city);
			if (ACCOUNT_STATE == 'true') {
				$this->getAndPrepare('state', $get, $state);
				$zone_id = false;
			}

			$this->getAndPrepare('country', $get, $country);

			$error = false;
			$error_message = '';

			if (ACCOUNT_GENDER == 'true') {
				if ( ($gender != 'm') && ($gender != 'f') ) {
					$error = true;

					$error_message.= ENTRY_GENDER_ERROR;
				}
			}

			if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_FIRST_NAME_ERROR;
			}

			if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_LAST_NAME_ERROR;
			}

			if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_STREET_ADDRESS_ERROR;
			}

			if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_POST_CODE_ERROR;
			}

			if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_CITY_ERROR;
			}

			if (is_numeric($country) == false) {
				$error = true;

				$error_message .= ENTRY_COUNTRY_ERROR;
			}

			if (ACCOUNT_STATE == 'true') {
				$zone_id = 0;
				$check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
				$check = tep_db_fetch_array($check_query);
				$entry_state_has_zones = ($check['total'] > 0);
				if ($entry_state_has_zones == true) {
					$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name like '" . tep_db_input($state) . "%' or zone_code like '%" . tep_db_input($state) . "%')");
					if (tep_db_num_rows($zone_query) == 1) {
						$zone = tep_db_fetch_array($zone_query);
						$zone_id = $zone['zone_id'];
					} else {
						$error = true;

						$error_message .= ENTRY_STATE_ERROR_SELECT;
					}
				} else {
					if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
						$error = true;

						$error_message .= ENTRY_STATE_ERROR;
					}
				}
			}

			if ($error == false) {

				$sql_data_array = array('customers_id' => $customer_id,
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
						$sql_data_array['entry_state'] = '';
					} else {
						$sql_data_array['entry_zone_id'] = '0';
						$sql_data_array['entry_state'] = $state;
					}
				}

				tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
				$sendto = tep_db_insert_id();
				if (!ajaxSessionIsRegistered('sendto')) ajaxSessionRegister('sendto',$sendto);
				if (ajaxSessionIsRegistered('shipping')) ajaxSessionUnregister('shipping');

			}

			if ($error == true) {
				echo '<div class="alert alert-error">'.$error_message.'</div>';
				$this->showChangeAddress(true, $entry_state_has_zones, $country);
			} else
			{
				$this->showShipping($get);
			}

		}


		function showChangeAddress($process = false, $entry_state_has_zones = false, $country = 0)
		{
			global $language;
			global $order, $currencies, $order_total_modules, $cart, $language, $customer_id, $customer_default_address_id, $sendto;

			require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING_ADDRESS);

			$addresses_count = tep_count_customer_address_book_entries();

			?>
			<div class="ui-widget infoBoxContainer">

				<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?></strong></div>

				<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:left;">

					<p style="float: left; width: 100%;"><?php echo TEXT_SELECTED_SHIPPING_DESTINATION;?></p>



					<div style="width: 45%; float:left; text-align: center;"><?php echo '<strong>' . TITLE_SHIPPING_ADDRESS . '</strong>'; ?>
						<p><?php echo tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></p></div>


						<div style="width: auto; float:right; padding-right:10px;"><?php echo tep_address_label($customer_id, $sendto, true, ' ', '<br>'); ?></div>

					</div>
				</div>

				<div style="clear: both;"></div>



				<?php
				if ($addresses_count > 1) {
					?>
					<div class="ui-widget infoBoxContainer">

						<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></strong></div>

						<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">
							<p style="float: left; width: 70%;"><?php echo TEXT_SELECT_OTHER_SHIPPING_DESTINATION; ?></p>
							<p style="float: right; width: 29%;"><strong><?php echo TITLE_PLEASE_SELECT; ?></strong><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif', null, null, null, 'style="float:right;"'); ?></p>

							<div style="clear: both;"></div>
							<div class="selectChoices">


								<?php
							$radio_buttons = 0;

							$addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "'");
							while ($addresses = tep_db_fetch_array($addresses_query)) {
								$format_id = tep_get_address_format_id($addresses['country_id']);
								?>


								<?php
								if ($addresses['address_book_id'] == $sendto) {
									echo '                  <div id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
								} else {
									echo '                  <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
								}
								?>
								<span><strong><?php echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?></strong></span>
								<span><?php echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $sendto),'id="address_'.$radio_buttons.'"'); ?></span>

							</div>
							<p><?php echo tep_address_format($format_id, $addresses, true, ' ', ', '); ?><p>


							<?php
							$radio_buttons++;
						}
						?>
					</div>
				</div>

				<div style="clear: both;"></div>


				<?php
			}
			if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
				?>
				<div class="ui-widget infoBoxContainer">

					<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_NEW_SHIPPING_ADDRESS; ?></strong></div>

					<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">

						<p style="float:right;"><?php echo TEXT_CREATE_NEW_SHIPPING_ADDRESS; ?></p>
						<div><?php require('ajax/includes/' . 'checkout_new_address.php'); ?></div>

						<?php
					}

					?>

				</div>
				<div style="clear: both;"> 
					<div style="float: right; margin-top: 10px;">
						<?php echo draw_button(IMAGE_BUTTON_CONTINUE, 'primary', 'id="buttonSelectShippingAddress" onClick="ajaxPerformShippingAddress();"', 'ui-icon-refresh') ?>
					</div>
				</div>
			</div>

			<?

		}

		function showPlaceOrder($get)
		{

			if (ajaxSessionIsRegistered("customer_id"))
			{
				global $language, $order, $currencies, $order_total_modules, $cart, $language, $customer_id, $customer_default_address_id, $sendto, $billto, $shipping, $payment;

				$payment_modules = new payment($payment);

				$order = new order;
				if (isset($payment_modules->selected_module))
					$payment_modules->update_status();
								
				if (isset($payment))
					$payment_class = $GLOBALS[$payment];

				// Stock Check
				$any_out_of_stock = false;
				if (STOCK_CHECK == 'true') {
					for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
						if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
							$any_out_of_stock = true;
						}
					}
				}
				if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) $any_out_of_stock = true;
				else $any_out_of_stock = false;

				if (
				ajaxSessionIsRegistered('sendto') &&
					ajaxSessionIsRegistered('billto') &&
					ajaxSessionIsRegistered('shipping') &&
					ajaxSessionIsRegistered('payment') &&
					ajaxSessionIsRegistered('customer_id') &&
					is_object($payment_class) &&
					is_array($shipping) && $any_out_of_stock == false
					)

				{

					if (isset($payment_class->form_action_url)) {

						$form_action_url = $payment_class->form_action_url;
						echo tep_draw_form('checkout_confirmation', $form_action_url, 'post');
						echo $payment_class->process_button();
						echo '<input type="submit" value="Place Order"></form>';

					} else {

						?>

<!--msg box Spinning confirmation -->
<div id="order_submitted" class="modal2">
	<div class="modal3 ui-corner-all"><p><strong><?php echo ORDER_LOADING; ?></strong></p> <p><?php echo tep_image('images/loading2.gif'); ?></p></div>
</div>

<div class="ui-widget infoBoxContainer">
	<span class="ui-widget-content ui-corner-all" id="TheSubmitButton">
		<?php echo draw_button(IMAGE_BUTTON_CONFIRM_ORDER, 'primary', 'onClick="check_agree();" id="buttonPlaceOrder"', 'ui-icon-refresh'); ?></span>

	
	<span class="ui-widget-content ui-corner-all" id="TheDisabledButton">
		<?php echo draw_button(IMAGE_BUTTON_CONFIRM_ORDER, 'secondary', 'onClick="check_agree(\''.CONDITIONS.'\', \''.htmlspecialchars(CONDITION_AGREEMENT_ERROR).'\');"', 'ui-icon-refresh'); ?></span>
	
</div>

<div style="clear: both;"></div>

<?php
}
} else {

}
}

}

//----------------------------------------------- page actions
function performAction2Buffer($function_name,$param,&$error)
{

	ob_start();

	$this->$function_name($param, $error);

	$result = ob_get_contents();
	ob_end_clean();

	return $result;
}

function showProducts($get)
{
	global $currencies, $language, $order, $cart, $shipping;

	$order = new order;

	// Add a hidden field with the order total and free shipping value to prevent
	// a bug that occurs when customer chooses free shipping and then removing products from Cart.
	if (isset($order->info['total']))
		echo tep_draw_hidden_field('orderTotalNewValue', $order->info['total'], 'id="orderTotalNewValue"');
	if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) 
		echo tep_draw_hidden_field('freeShippingOver', MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER, 'id="freeShippingOver"');

	// Add a hidden field with the selected shipping method so that the Shipping Cost
	// will update when shopping cart is updated
	if (isset($shipping['id']))
		echo tep_draw_hidden_field('shippingselected', $shipping['id'], 'id="shippingselected"');

	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);
	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);

	echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_AJAX_CHECKOUT, 'action=update_product'));
	?>

	<div class="contentContainer" id="content-body">

		<h3><?php echo TABLE_HEADING_PRODUCTS; ?></h3>


		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<?php	
		echo tep_draw_hidden_field('products_in_cart', ((sizeof($order->products) > 0) ? sizeof($order->products) : '0'));	

		$any_out_of_stock = 0;
		$info_box_contents = array();
		for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
			if (($i/2) == floor($i/2)) {
				$info_box_contents[] = array('params' => 'class="productListing-even"');
			} else {
				$info_box_contents[] = array('params' => 'class="productListing-odd"');
			}

			$cur_row = sizeof($info_box_contents) - 1;


			$info_box_contents[$cur_row][] = array('align' => 'center',
			'params' => 'class="productListing-data" valign="middle"',
			'text' => tep_draw_checkbox_field('cart_delete[]', $order->products[$i]['id'], false, 'style="display:none;"') .
				'<span class="cart-remove" style="visibility:visible;" onClick="cartremove(\''.$order->products[$i]['id'].'\');" rel="' . $order->products[$i]['id'] . '">'
				. tep_image(DIR_WS_ICONS . 'cancel.png', TEXT_REMOVE) . '</span>' .
			'<span style="display:none;" id="pn-' . $order->products[$i]['id'] . '">' .
				'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $order->products[$i]['id']) . '">' . $order->products[$i]['name'] . '</a></span>')  ;


			$products_name = '<table border="0" cellspacing="2" cellpadding="2">' .
				'  <tr>' .
				'    <td align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $order->products[$i]['id']) . '"></a></td>' .
			'    <td valign="top"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $order->products[$i]['id']) . '"><strong>' . $order->products[$i]['name'] . '</strong></a>';


			if (STOCK_CHECK == 'true') {
				$stock_check = tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
				if (tep_not_null($stock_check)) {
					$any_out_of_stock = 1;

					$products_name .= $stock_check;
				}
			}




			if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
				for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {

					echo tep_draw_hidden_field('id[' . $order->products[$i]['id'] . '][' . $order->products[$i]['attributes'][$j]['option_id'] . ']', $order->products[$i]['attributes'][$j]['value_id']);

					$products_name .= '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
				}
			}

			$products_name .= '    </td>' .
			'  </tr>' .
			'</table>';

			$info_box_contents[$cur_row][] = array('params' => 'class="productListing-data"',
			'text' => $products_name);

			$info_box_contents[$cur_row][] = array('params' => 'class="cart-qty" ',
			'text' =>
				'<span onClick="updateqty(\'moins\', \''.$order->products[$i]['id'].'\');" class="" style="visibility:visible;" rel="' . $order->products[$i]['id'] . '">' . tep_image(DIR_WS_ICONS . 'moins.png') . '</span>' .
			tep_draw_input_field('cart_quantity[]', $order->products[$i]['qty'], 'size="4" id="pl' . $order->products[$i]['id'] . '"' ) . tep_draw_hidden_field('products_id[]', $order->products[$i]['id']) .
				'<span onClick="updateqty(\'plus\', \''.$order->products[$i]['id'].'\');" class="" style="visibility:visible;" rel="' . $order->products[$i]['id'] . '">' . tep_image(DIR_WS_ICONS . 'plus.png')  . '</span>'
		);


		$info_box_contents[$cur_row][] = array('align' => 'right',
		'params' => 'class="productListing-data" valign="middle"',
		'text' => '<strong>' . $currencies->display_price($order->products[$i]['final_price'], (isset($order->products[$i]['tax_class_id']) ? tep_get_tax_rate($order->products[$i]['tax_class_id']) : ''), $order->products[$i]['qty']) . '</strong>');

		if (sizeof($order->info['tax_groups']) > 1) {
			$info_box_contents[$cur_row][] = array('align' => 'right',
			'params' => 'class="productListing-data" valign="middle"',
			'text' => '' . tep_display_tax_value($order->products[$i]['tax']) . '%');
		}				

		$info_box_contents[$cur_row][] = array('align' => 'right',
		'params' => 'class="productListing-data" valign="middle"',
		'text' => '<strong>' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '</strong>');

	}

	new productListingBox($info_box_contents);

	?>
</table>
<p align="right"><strong><?php echo SUB_TITLE_SUB_TOTAL; ?> <?php echo $currencies->format($cart->show_total()); ?></strong></p>

</div>
</form>
<?php

}

function showTotals($get)
{
	global $order, $currencies, $order_total_modules;	
	
	$order = new order;
	$shipping = new shipping;
	$order_total_modules = new order_total;

	// Add a hidden field with the order total and free shipping value to prevent
	// a bug that occurs when customer chooses free shipping and then removing products from Cart.
	if (isset($order->info['total']))
		echo tep_draw_hidden_field('orderTotalOldValue', $order->info['total'], 'id="orderTotalOldValue"');


	?>
	<table border="0" cellspacing="0" cellpadding="2" style="float: right; margin-top: 0; padding-top: 0;">
		<?php
	if (MODULE_ORDER_TOTAL_INSTALLED) {
		$order_total_modules->process();
		echo $order_total_modules->output();
	}

	?>
</table>

<div style="clear: both;"></div>
<?

global $language, $order, $currencies, $order_total_modules, $cart, $language, $customer_id, $customer_default_address_id, $sendto, $billto, $shipping, $payment;

$order = new order;	

// Stock Check
$any_out_of_stock = false;
if (STOCK_CHECK == 'true') {
	for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
		if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
			$any_out_of_stock = true;
		}
	}
}
if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) $any_out_of_stock == true;
else $any_out_of_stock == false;

if ($any_out_of_stock == true) {

	require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);

	if (STOCK_ALLOW_CHECKOUT == 'true') {
		?>

		<div class="ui-widget infoBoxContainer"> 
			<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>

					<p class="stockWarning"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></p>
				</div>
			</div>

			<div style="clear: both;"></div>

			<?php
		} else {
			?>
			<div class="ui-widget infoBoxContainer"> 
				<div class="ui-widget-content infoBoxContents ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
					<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>

						<p class="stockWarning"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></p>
					</div>
				</div>

				<div style="clear: both;"></div>
				<?php
			}
		}

	}

	function showLogin($get) {
		global $customer_id,$language;

		require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

		?>
		<div class="ui-widget infoBoxContainer">

			<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo HEADER_TITLE_LOGIN; ?></strong></div>

			<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="">

				<div class="contentText">
					<p style="width: 100%;"><?php echo TEXT_RETURNING_CUSTOMER;?></p>

					<table border="0" cellspacing="2" cellpadding="2" width="100%">
						<tr>
							<td class="fieldKey"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
							<td class="fieldValue"><?php echo tep_draw_input_field('login_email_address','','id="login_email_address"'); ?></td>
						</tr>
						<tr>
							<td class="fieldKey"><?php echo ENTRY_PASSWORD; ?></td>
							<td class="fieldValue"><?php echo tep_draw_password_field('login_password','','id="login_password"'); ?></td>
						</tr>
					</table>
				</div>

				<div style="clear: both;"></div>

				<p><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></p>

			</div>
			<div style="clear: both;"> 
				<div style="float: right; margin-top: 10px;">
					<?php echo draw_button(IMAGE_BUTTON_LOGIN, 'primary', 'value="Sign In" onClick="ajaxPerformLogin();"', 'ui-icon-key'); ?>
				</div>
			</div>
		</div>

		<div style="clear: both;"></div>
		<?
	}

	function showCreateAccount($process = false, $entry_state_has_zones = false, $country = 0) {
		global $customer_id,$language;
		require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
		require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONDITIONS);

		echo tep_draw_form('create_account', '', 'post', null, true);	
		?>		

		<div class="ui-widget infoBoxContainer" style="float:left; width: 100%;">

			<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo CATEGORY_PERSONAL; ?></strong></div>

			<div class="ui-widget-content infoBoxContents ui-corner-bottom">

				<span class="inputRequirement" style="float: right;"><?php echo FORM_REQUIRED_INFORMATION; ?></span>
				<div style="clear: both;"></div>


				<div class="contentText">
					<table border="0" cellspacing="2" cellpadding="2" width="100%">

						<?php
					if (ACCOUNT_GENDER == 'true') {
						?>

						<tr>
							<td class="main"><?php echo ENTRY_GENDER; ?></td>
							<td class="main"><?php echo tep_draw_radio_field('gender', 'm', $male,'id="gender"') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female,'id="gender"') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
						</tr>

						<?php
					}
					?>

					<tr>
						<td class="fieldKey"><?php echo ENTRY_FIRST_NAME; ?></td>
						<td class="fieldValue"><?php echo tep_draw_input_field('firstname','','id="firstname" onchange="validateString(\'firstname\')"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
					</tr>
					<tr> 
						<td class="fieldKey"><?php echo ENTRY_LAST_NAME; ?></td>
						<td class="fieldValue"><?php echo tep_draw_input_field('lastname','','id="lastname" onchange="validateString(\'lastname\')"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
					</tr>

					<?php
					if (ACCOUNT_DOB == 'true') {
						?>

						<tr>
							<td class="fieldKey"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
							<td class="fieldValue"><?php echo tep_draw_input_field('dob', '', 'id="dob"') . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?></td>
						</tr>

						<?php
					}
					?>

					<tr>
						<td class="fieldKey"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
						<td class="fieldValue"><?php echo tep_draw_input_field('email_address', '', 'id="email_address"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
					</tr>
				</table>
			</div>

			<?php
			if (ACCOUNT_COMPANY == 'true') {
				?>
			</div>
			<!-- <h3><?php echo CATEGORY_COMPANY; ?></h3> -->

			<div style="clear: both;"></div>

			<div class="ui-widget infoBoxContainer" style="float:left; width: 100%;">

				<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo CATEGORY_COMPANY; ?></strong></div>

				<div class="ui-widget-content infoBoxContents ui-corner-bottom">

					<div class="contentText">
						<table border="0" cellspacing="2" cellpadding="2" width="100%">
							<tr>
								<td class="fieldKey"><?php echo ENTRY_COMPANY; ?></td>
								<td class="fieldValue"><?php echo tep_draw_input_field('company', '', 'id="company" onchange="validateString(\'company\')"') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
							</tr>
						</table>
					</div>
				</div>

				<div style="clear: both;"></div>
				<?php
			}
			?>
		</div>
	</div>

	<div style="clear: both;"></div>

	<div class="ui-widget infoBoxContainer" style="float:left; width: 100%;">

		<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo CATEGORY_ADDRESS; ?></strong></div>

		<div class="ui-widget-content infoBoxContents ui-corner-bottom">

			<div class="contentText">
				<table border="0" cellspacing="2" cellpadding="2" width="100%">
					<tr>
						<td class="fieldKey"><?php echo ENTRY_STREET_ADDRESS; ?></td>
						<td class="fieldValue"><?php echo tep_draw_input_field('street_address', '','id="street_address" onchange="validateString(\'street_address\')"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
					</tr>

					<?php
					if (ACCOUNT_SUBURB == 'true') {
						?>

						<tr>
							<td class="fieldKey"><?php echo ENTRY_SUBURB; ?></td>
							<td class="fieldValue"><?php echo tep_draw_input_field('suburb', '','id="suburb" onchange="validateString(\'suburb\')"') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
						</tr>

						<?php
					}
					?>

					<tr>
						<td class="fieldKey"><?php echo ENTRY_POST_CODE; ?></td>
						<td class="fieldValue"><?php echo tep_draw_input_field('postcode', '','id="postcode"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
					</tr>
					<tr>
						<td class="fieldKey"><?php echo ENTRY_CITY; ?></td>
						<td class="fieldValue"><?php echo tep_draw_input_field('city', '','id="city" onchange="validateString(\'city\')"') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
					</tr>

					<?php
					if (ACCOUNT_STATE == 'true') {
						?>

						<tr>
							<td class="fieldKey"><?php echo ENTRY_STATE; ?></td>
							<td class="fieldValue">
								<?php
							if ($process == true) {
								if ($entry_state_has_zones == true) {
									$zones_array = array();
									$zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
									while ($zones_values = tep_db_fetch_array($zones_query)) {
										$zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
									}
									echo tep_draw_pull_down_menu('state', $zones_array);
								} else {
									echo tep_draw_input_field('state','','id="state" onchange="validateString(\'state\')"');
								}
							} else {
								echo tep_draw_input_field('state','','id="state" onchange="validateString(\'state\')"');
							}

							if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT . '</span>';
							?>
						</td>
					</tr>

					<?php
				}
				?>

				<tr>
					<td class="fieldKey"><?php echo ENTRY_COUNTRY; ?></td>
					<td class="fieldValue"><?php echo tep_get_country_list('country', '','id="country"') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div style="clear: both;"></div>

<div class="ui-widget infoBoxContainer" style="float:left; width: 100%;">

	<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo CATEGORY_CONTACT; ?></strong></div>

	<div class="ui-widget-content infoBoxContents ui-corner-bottom">

		<div class="contentText">
			<table border="0" cellspacing="2" cellpadding="2" width="100%">
				<tr>
					<td class="fieldKey"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
					<td class="fieldValue"><?php echo tep_draw_input_field('telephone', '','id="telephone"') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?></td>
				</tr>
				<tr>
					<td class="fieldKey"><?php echo ENTRY_FAX_NUMBER; ?></td>
					<td class="fieldValue"><?php echo tep_draw_input_field('fax', '','id="fax"') . '&nbsp;' . (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?></td>
				</tr>
				<tr>
					<td class="fieldKey"><?php echo ENTRY_NEWSLETTER; ?></td>
					<td class="fieldValue"><?php echo tep_draw_checkbox_field('newsletter', '1','','id="newsletter"') . '&nbsp;' . (tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div style="clear: both;"></div>

<div class="ui-widget infoBoxContainer" style="float:left; width: 100%;">

	<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo CATEGORY_PASSWORD; ?></strong></div>

	<div class="ui-widget-content infoBoxContents ui-corner-bottom">
		<div class="contentText">
			<table border="0" cellspacing="2" cellpadding="2" width="100%">
				<tr>
					<td class="fieldKey"><?php echo ENTRY_PASSWORD; ?></td>
					<td class="fieldValue"><?php echo tep_draw_password_field('password','','id="password"') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?></td>
				</tr>
				<tr>
					<td class="fieldKey"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
					<td class="fieldValue"><?php echo tep_draw_password_field('confirmation','','id="confirmation"') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?></td>
				</tr>
			</table>
		</div>
	</div>

</div>

<div style="clear: both;"></div>

<div class="ui-widget infoBoxContainer" style="float:right;">
	<div class="ui-state-highlight ui-corner-all" style="display: block; padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
			<?php echo CONDITION_AGREEMENT; ?>
			<span><a href="#myModal" data-toggle="modal">
				<u style="main"><?php echo CONDITIONS; ?></u>
			</a></span>

			<?php

			echo tep_draw_checkbox_field('TermsAgreeCreateAcc','true', false, 'id="TermsAgreeCreateAcc"');
			?></p>
		</div>
	</div>

	<div style="clear: both;"></div>

	<!-- Modal -->
	<div id="myModal" style="display:none;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 style="font-size: 24.5px;" id="myModalLabel"><?php echo CONDITIONS; ?></h3>
		</div>
		<div class="modal-body">
			<p><?=TEXT_INFORMATION?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true"><?=TEXT_AGREE_CLOSE?></button>
			<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><?=TEXT_AGREE_PRESS?></button>
		</div>
	</div>

	<span class="buttonAction" id="TheSubmitButtonCreateAcc" style="display: none; float: right; margin-top: 10px;"><?php echo draw_button(IMAGE_BUTTON_CONTINUE, 'primary', 'value="Sign-Up and Continue" onClick="ajaxPerformCreateAccount();"', 'ui-icon-person'); ?></span>
	
	<span class="buttonAction" id="TheDisabledButtonCreateAcc" onClick="check_agree_create('<?php echo CONDITIONS_CREATE_ACCOUNT; ?>', '<?php echo htmlspecialchars(CONDITION_AGREEMENT_ERROR_CREATE_ACCOUNT); ?>');" style="float: right; margin-top: 10px;"><?php echo draw_button(IMAGE_BUTTON_CONTINUE, 'secondary', '', 'ui-icon-person'); ?></span>

</form>

<div style="clear: both;"></div>
<?php
}

function showShipping($get) {

	$error = false;
	$buffer = $this->performAction2Buffer("_showShipping", $get ,$error);
	echo '<divresult name="shipping_area">'.$buffer.'</divresult>';

	$order_error = false;
	$order_buffer = $this->performAction2Buffer("showPlaceOrder", $get, $order_error);
	echo '<divresult name="placeorder_area">'.$order_buffer.'</divresult>';

}

function _showShipping($get) {

	if (!ajaxSessionIsRegistered('customer_id')) $this->showCreateAccount('');
	else
	{
		global $order, $currencies, $order_total_modules, $cart, $language, $customer_id, $customer_default_address_id, $sendto,
		$total_count, $total_weight, $shipping, $shipping_num_boxes;

		ajaxSessionUnregister("shipping");

		// if no shipping destination address was selected, use the customers own address as default
		if (!ajaxSessionIsRegistered('sendto')) {
			$sendto = $customer_default_address_id;
			ajaxSessionRegister('sendto',$sendto);
		} else {
			// verify the selected shipping address
			$check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");
			$check_address = tep_db_fetch_array($check_address_query);
			if ($check_address['total'] != '1') {
				$sendto = $customer_default_address_id;
				if (ajaxSessionIsRegistered('shipping')) ajaxSessionUnregister('shipping');
			}
		}

		$order = new order;

		$cartID = $cart->cartID;
		if (!ajaxSessionIsRegistered('cartID')) ajaxSessionRegister('cartID',$cartID);

		$total_weight = $cart->show_weight();
		$total_count = $cart->count_contents();

		// load all enabled shipping modules
		$shipping_modules = new shipping;

		if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
			$pass = false;

			switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
				case 'national':
				if ($order->delivery['country_id'] == STORE_COUNTRY) {
					$pass = true;
				}
				break;
				case 'international':
				if ($order->delivery['country_id'] != STORE_COUNTRY) {
					$pass = true;
				}
				break;
				case 'both':
				$pass = true;
				break;
			}

			$free_shipping = false;
			if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
				$free_shipping = true;

				include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
			}
		} else {
			$free_shipping = false;
		}

		// get all available shipping quotes
		$quotes = $shipping_modules->quote();

		if ($order->content_type == 'virtual') {
			$free_shipping = true;
		}

		if ( !ajaxSessionIsRegistered('shipping') || ( ajaxSessionIsRegistered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) )
		{
			$shipping = $shipping_modules->cheapest();
		}
		require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING);
		require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING_ADDRESS);

		?>
		<div class="ui-widget infoBoxContainer">

			<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?></strong></div>

			<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">

				<p style="float: left; width: 100%;"><?php echo TEXT_CHOOSE_SHIPPING_DESTINATION;?></p>
				<div style="width: 45%; float:left; text-align: center;">



					<?php echo '<strong>' . TITLE_SHIPPING_ADDRESS . '</strong>'; ?>
					<p style=""><?php echo tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></p>
					<?php echo draw_button(IMAGE_BUTTON_CHANGE_ADDRESS, null, 'id="buttonChangeShippingAddress" onClick="ajaxShowChangeAddress();"', 'ui-icon-refresh'); ?>
				</div>

				<div style="width: auto; float:right; padding-right:10px;">

					<p style="margin-top:0px;"><?php echo tep_address_label($customer_id, $sendto, true, ' ', '<br>'); ?></p>
				</div>
			</div>
		</div>


		<div style="clear: both;"></div>



		<?php
		if (tep_count_shipping_modules() > 0) {
			?>
			<div class="ui-widget infoBoxContainer">

				<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></strong></div>

				<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">
					<div class="selectChoices">
					<?php
				if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
					?>
					<p style="float: left; width: 70%;"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></p>
					<p style="float: right; width: 29%;"><strong><?php echo TITLE_PLEASE_SELECT; ?></strong><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif', null, null, null, 'style="float:right;"'); ?></p> 



					<?php
				} elseif ($free_shipping == false) {
					?>
					<div style="float: left; width: 100%;"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></div>

					<?php
				}

				if ($free_shipping == true) {
					?>
					<p style="float: left; width: 100%;"><strong><?php echo FREE_SHIPPING_TITLE; ?></strong>&nbsp;<?php echo $quotes[$i]['icon']; ?></p>


					<div id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, 0)">


						<p style="float: left; width: 100%;"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free','id="shipping"'); ?></p>
					</div>

					<?php
				} else {
					$radio_buttons = 0;
					for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
						?>
						<p><strong><?php echo $quotes[$i]['module']; ?></strong>&nbsp;<?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) {  echo $quotes[$i]['icon']; } ?></p>

						<?php
						if (isset($quotes[$i]['error'])) {
							?>
							<p><?php echo $quotes[$i]['error']; ?></p>

							<?php
						} else {
							for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
								// set the radio button to be checked if it is the method chosen
								$checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);

								if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
									echo '                  <div id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
								} else {
									echo '                  <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
								}
								?>
								<span><?php echo $quotes[$i]['methods'][$j]['title']; ?></span>
								<?php
								if ( ($n > 1) || ($n2 > 1) ) {
									?>
									<span><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></span>
									<span><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="shipping_'.$radio_buttons.'"');?></span>
									<?php
								} else {
									?>
									<span style="float: right;"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], 'id="shipping"'); ?></span>
									<?php
								}
								?>
							</div>
							<?php
							$radio_buttons++;
						}
					}
					?>

					<?php
				}
			}
			?>
		</div>
	</div>


	<div style="clear: both;"></div>
	<div style="float: right; margin-top: 10px;">
		<?php echo draw_button(IMAGE_BUTTON_UPDATE, 'primary', 'id="buttonSelectShipping" onClick="ajaxPerformShippingSelection();"', 'ui-icon-refresh') ?>
	</div>
</div>

<div style="clear: both;"></div>

<?php
}
?>

<?
}

}

function showShippingInfo($shipping) {
	global $language;
	require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);
	require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT_ADDRESS);


	// load the selected shipping module
	$GLOBALS['shipping'] = $shipping;

	$order = new order;

	if ($order->info['shipping_method']) {
		?>
		<div class="ui-widget infoBoxContainer">

			<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo '<strong>' . HEADING_DELIVERY_ADDRESS . '</strong> <a href="" onClick="javascript:ajaxShowChangeAddress(); return false;"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></strong></div>

			<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="">

				<p style="margin: 0;"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>'); ?></p>

			</div>
		</div>

		<div style="clear: both;"></div>


		<div class="ui-widget infoBoxContainer">

			<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo '<strong>' . HEADING_SHIPPING_METHOD . '</strong> <a href="" onClick="javascript:ajaxRefreshShipping();ajaxRefreshShipping();return false;"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></strong></div>

			<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="">

				<p style="margin: 0;"><?php echo $order->info['shipping_method']; ?></p>


			</div>
		</div>

		<div style="clear: both;"></div>

		<?php 	} ?>

		<?php


	}

	function PerformShippingSelection($get)
	{

		$error = false;
		$buffer = $this->performAction2Buffer("_PerformShippingSelection", $get ,$error);

		echo '<divresult name="shipping_area">'.$buffer.'</divresult>';

		$totals_error = false;
		$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
		echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';

		$order_error = false;
		$order_buffer = $this->performAction2Buffer("showPlaceOrder", $get, $order_error);
		echo '<divresult name="placeorder_area">'.$order_buffer.'</divresult>';

	}

	function _PerformShippingSelection($get, &$error)
	{
		global $total_count, $total_weight, $shipping_weight, $shipping_quoted, $shipping_num_boxes, $shipping,
$order, $currencies, $order_total_modules, $cart, $language, $customer_id, $customer_default_address_id, $sendto;

		if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') )
			require_once(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');


		$error = false;

		$this->getAndPrepare('shipping', $get, $shipping);
		$free_shipping = false;

		$shipping_modules = new shipping($shipping);

		$order = new order();
		
		$total_weight = $cart->show_weight();
		$total_count = $cart->count_contents();

		if (!ajaxSessionIsRegistered('shipping')) ajaxSessionRegister('shipping',$shipping);

		if ( (tep_count_shipping_modules() > 0) || ($free_shipping == true) ) {

			list($module, $method) = explode('_', $shipping);

			if (is_object($GLOBALS[$module]) || ($shipping == 'free_free') ) {
				if ($shipping == 'free_free') {
					$quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
					$quote[0]['methods'][0]['cost'] = '0';
				} else {
					$quote = $shipping_modules->quote($method, $module);
				}
				if (isset($quote[0]['error']) || isset($quote['error'])) {
					ajaxSessionUnregister('shipping');
					$error = true;
				} else {
					if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
						$shipping = array('id' => $shipping,
						'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
						'cost' => $quote[0]['methods'][0]['cost']);
					}
				}
			} else {
				ajaxSessionUnregister('shipping');
				$error = true;
			}
		} else {
			$shipping = false;
			$error = true;
		}

		$this->showShippingInfo($shipping);
		$this->showCommentInfo();

	}

	function showPayment($get) {

		$error = false;
		$buffer = $this->performAction2Buffer("_showPayment", $get ,$error);
		echo '<divresult name="payment_area">'.$buffer.'</divresult>';

		$order_error = false;
		$order_buffer = $this->performAction2Buffer("showPlaceOrder", $get, $order_error);
		echo '<divresult name="placeorder_area">'.$order_buffer.'</divresult>';

	}

	function _showPayment($get) {

		if (!tep_session_is_registered('customer_id')) $this->showLogin('');
		else
		{
			global $order, $currencies, $order_total_modules, $cart, $language, $customer_id, $customer_default_address_id,$billto;

			ajaxSessionUnregister("payment");

			// if no billing destination address was selected, use the customers own address as default
			if (!ajaxSessionIsRegistered('billto')) {
				$billto = $customer_default_address_id;
				ajaxSessionRegister('billto',$billto);
			} else {
				// verify the selected billing address
				$check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
				$check_address = tep_db_fetch_array($check_address_query);

				if ($check_address['total'] != '1') {
					$billto = $customer_default_address_id;
					if (ajaxSessionIsRegistered('payment')) ajaxSessionUnregister('payment');
				}
			}

			$order = new order;

			$total_weight = $cart->show_weight();
			$total_count = $cart->count_contents();

			// load all enabled payment modules
			$payment_modules = new payment;

			require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);

			echo $payment_modules->javascript_validation();

			echo tep_draw_form('checkout_payment', '', 'post');
			?>
			<div class="ui-widget infoBoxContainer">

				<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_BILLING_ADDRESS; ?></strong></div>

				<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">

					<p style="float: left; width: 100%;"><?php echo TEXT_SELECTED_BILLING_DESTINATION;?></p>
					<div style="width: 45%; float:left; text-align: center;">



						<?php echo '<strong>' . TITLE_BILLING_ADDRESS . '</strong>'; ?>
						<p style=""><?php echo tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></p>
						<?php echo draw_button(IMAGE_BUTTON_CHANGE_ADDRESS, null, 'onClick="ajaxShowChangePaymentAddress();" id="buttonChangePaymentAddress"', 'ui-icon-refresh'); ?>
					</div>

					<div style="width: auto; float:right; padding-right:10px;">

						<p style="margin-top:0px;"><?php echo tep_address_label($customer_id, $billto, true, ' ', '<br>'); ?></p>
					</div>
				</div>
			</div>


			<div style="clear: both;"></div>


			<div class="ui-widget infoBoxContainer">

				<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></strong></div>

				<div class="ui-widget-content infoBoxContents ui-corner-bottom" style="float:right;">

					<?php
				$selection = $payment_modules->selection();

				if (sizeof($selection) > 1) {
					?>
					<p style="float: left; width: 70%;"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></p>
					<p style="float: right; width: 29%;"><strong><?php echo TITLE_PLEASE_SELECT; ?></strong><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif', null, null, null, 'style="float:right;"'); ?></p>

					<div style="clear: both;"></div>
					<div class="selectChoices">
						<?php
				} else {
					?>
					<div style="float: right; width: 100%;"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></div>

					<?php
				}

				$radio_buttons = 0;
				for ($i=0, $n=sizeof($selection); $i<$n; $i++) {

					if (in_array($selection[$i]['id'],$this->arrAllowedPaymentModules))
					{
						?>

						<?php
						if ( ($selection[$i]['id'] == (isset($payment) ? $payment : '')) || ($n == 1) ) {
							echo '                  <div id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectPayment(this, ' . $radio_buttons . ')">' . "\n";
						} else {
							echo '                  <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectPayment(this, ' . $radio_buttons . ')">' . "\n";
						}
						?>
						<span><strong><?php echo $selection[$i]['module']; ?></strong></span>
						<span>
							<?php
						if (sizeof($selection) > 1) {
							echo tep_draw_radio_field('payment', $selection[$i]['id'], false, 'align="right" id="payment_'.$radio_buttons.'"');
						} else {
							echo tep_draw_hidden_field('payment', $selection[$i]['id'],'id="payment_'.$radio_buttons.'"');
						}
						?></span>
					</div>


					<?php
					if (isset($selection[$i]['error'])) {
						?>

						<p class="contentText"><?php echo $selection[$i]['error']; ?></p>

						<?php
					} elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
						?>

						<?php
						for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
							?>
							<p class="contentText"><?php echo $selection[$i]['fields'][$j]['title']; ?></p>
							<p class="contentText"><?php echo $selection[$i]['fields'][$j]['field']; ?></p>

							<?php
						}
						?>

						<?php
					}
					?>

					<?php
					$radio_buttons++;
				}
			}
			?>
		</div>
	</div>


	<div style="float: right; margin-top: 10px;">
		<?php echo draw_button(IMAGE_BUTTON_UPDATE, 'primary', 'id="buttonSelectPayment" onClick="ajaxPerformPaymentSelection();"', 'ui-icon-refresh'); ?>
	</div>
</div>

<div style="clear: both;"></div>

</form>
<?
}
}

function PerformLogin($get)
{

	$error = false;
	$buffer = $this->performAction2Buffer("_PerformLogin", $get ,$error);
	echo '<divresult name="payment_area">'.$buffer.'</divresult>';
	if ($error == false)
	{
		$products_error = false; 
		$products_buffer = $this->performAction2Buffer("showProducts", $get, $products_error);
		echo '<divresult name="products_area">'.$products_buffer.'</divresult>';

		$totals_error = false; 
		$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
		echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';

		$shipping_error = false; 
		$shipping_buffer = $this->performAction2Buffer("showShipping", $get, $shipping_error);
		echo '<divresult name="shipping_area">'.$shipping_buffer.'</divresult>';

	}

}

function _PerformLogin($get, &$error) {
	global $language,$cart,$order;
	global $HTTP_SESSION_VARS;

	require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

	$this->getAndPrepare('email_address', $get, $email_address);
	$this->getAndPrepare('password', $get, $password);

	// Check if email exists
	$check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
	if (!tep_db_num_rows($check_customer_query)) {
		$error = true;
	} else {
		$check_customer = tep_db_fetch_array($check_customer_query);
		// Check that password is good
		if (!tep_validate_password($password, $check_customer['customers_password'])) {
			$error = true;
		} else {
			if (SESSION_RECREATE == 'True') {
				tep_session_recreate();
			}
			
// migrate old hashed password to new phpass password
        	if (tep_password_type($check_customer['customers_password']) != 'phpass') {
          		tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_encrypt_password($password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");
        	}

			$check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
			$check_country = tep_db_fetch_array($check_country_query);

			$customer_id = $check_customer['customers_id'];
			$customer_default_address_id = $check_customer['customers_default_address_id'];
			$customer_first_name = $check_customer['customers_firstname'];
			$customer_country_id = $check_country['entry_country_id'];
			$customer_zone_id = $check_country['entry_zone_id'];

			ajaxSessionRegister('customer_id',$customer_id);
			ajaxSessionRegister('customer_default_address_id',$customer_default_address_id);
			ajaxSessionRegister('customer_first_name',$customer_first_name);
			ajaxSessionRegister('customer_country_id',$customer_country_id);
			ajaxSessionRegister('customer_zone_id',$customer_zone_id);

			tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1, password_reset_key = null, password_reset_date = null where customers_info_id = '" . (int)$customer_id . "'");

			// restore cart contents
			$cart->restore_contents();

		}
	}


	if ($error == true) {

		echo '<div class="alert alert-error">'.TEXT_LOGIN_ERROR.'</div>';
		$this->showLogin('');

	} else {
		//$order = new order;
		$this->showPayment('');
	}

}

function PerformCreateAccount($get)
{
	$error = false;
	$buffer = $this->performAction2Buffer("_PerformCreateAccount", $get ,$error);
	echo '<divresult name="shipping_area">'.$buffer.'</divresult>';

	if ($error == false)
	{
		$products_error = false; 
		$products_buffer = $this->performAction2Buffer("showProducts", $get, $products_error);
		echo '<divresult name="products_area">'.$products_buffer.'</divresult>';

		$totals_error = false; 
		$totals_buffer = $this->performAction2Buffer("showTotals", $get, $totals_error);
		echo '<divresult name="totals_area">'.$totals_buffer.'</divresult>';

		$payment_error = false; 
		$payment_buffer = $this->performAction2Buffer("showPayment", $get, $payment_error);
		echo '<divresult name="payment_area">'.$payment_buffer.'</divresult>';
	}
}

function _PerformCreateAccount($get, &$error)
{
	global $language, $cart;

	require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
	$process = true;

	if (ACCOUNT_GENDER == 'true') {
		$this->getAndPrepare('gender', $get, $gender);
		if (!isset($gender)) {
			$gender = false;
		}
	}
	$this->getAndPrepare('firstname', $get, $firstname);
	$this->getAndPrepare('lastname', $get, $lastname);
	if (ACCOUNT_DOB == 'true') $this->getAndPrepare('dob', $get, $dob);
	$this->getAndPrepare('email_address', $get, $email_address);
	if (ACCOUNT_COMPANY == 'true') $this->getAndPrepare('company', $get, $company);
	$this->getAndPrepare('street_address', $get, $street_address);
	if (ACCOUNT_SUBURB == 'true') $this->getAndPrepare('suburb', $get, $suburb);
	$this->getAndPrepare('postcode', $get, $postcode);
	$this->getAndPrepare('city', $get, $city);
	if (ACCOUNT_STATE == 'true') {
		$this->getAndPrepare('state', $get, $state);
		$zone_id = false;
	}
	$this->getAndPrepare('country', $get, $country);
	$this->getAndPrepare('telephone', $get, $telephone);
	$this->getAndPrepare('fax', $get, $fax);
	$this->getAndPrepare('newsletter', $get, $newsletter);
	if (!isset($newsletter)) {
		$newsletter = false;
	}
	$this->getAndPrepare('password', $get, $password);
	$this->getAndPrepare('confirmation', $get, $confirmation);

	$error = false;
	$error_message = '';

	if (ACCOUNT_GENDER == 'true') {
		if ( ($gender != 'm') && ($gender != 'f') ) {
			$error = true;

			$error_message.= ENTRY_GENDER_ERROR;
		}
	}

	if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_FIRST_NAME_ERROR;
	}

	if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_LAST_NAME_ERROR;
	}

	if (ACCOUNT_DOB == 'true') {
		if ((is_numeric(tep_date_raw($dob)) == false) || (@checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4)) == false)) {
			$error = true;

			$error_message .= ENTRY_DATE_OF_BIRTH_ERROR;
		}
	}

	if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_EMAIL_ADDRESS_ERROR;
	} elseif (tep_validate_email($email_address) == false) {
		$error = true;

		$error_message .= ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
	} else {
		$check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
		$check_email = tep_db_fetch_array($check_email_query);
		if ($check_email['total'] > 0) {
			$error = true;

			$error_message .= ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
		}
	}

	if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_STREET_ADDRESS_ERROR;
	}

	if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_POST_CODE_ERROR;
	}

	if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_CITY_ERROR;
	}

	if (is_numeric($country) == false) {
		$error = true;

		$error_message .= ENTRY_COUNTRY_ERROR;
	}

	if (ACCOUNT_STATE == 'true') {
		$zone_id = 0;
		$check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
		$check = tep_db_fetch_array($check_query);
		$entry_state_has_zones = ($check['total'] > 0);
		if ($entry_state_has_zones == true) {
			$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name like '" . tep_db_input($state) . "%' or zone_code like '%" . tep_db_input($state) . "%')");
			if (tep_db_num_rows($zone_query) == 1) {
				$zone = tep_db_fetch_array($zone_query);
				$zone_id = $zone['zone_id'];
			} else {
				$error = true;

				$error_message .= ENTRY_STATE_ERROR_SELECT;
			}
		} else {
			if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
				$error = true;

				$error_message .= ENTRY_STATE_ERROR;
			}
		}
	}

	if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_TELEPHONE_NUMBER_ERROR;
	}


	if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
		$error = true;

		$error_message .= ENTRY_PASSWORD_ERROR;
	} elseif ($password != $confirmation) {
		$error = true;

		$error_message .= ENTRY_PASSWORD_ERROR_NOT_MATCHING;
	}

	if ($error == false) {
		$sql_data_array = array('customers_firstname' => $firstname,
								'customers_lastname' => $lastname,
								'customers_email_address' => $email_address,
								'customers_telephone' => $telephone,
								'customers_fax' => $fax,
								'customers_newsletter' => $newsletter,
								'customers_password' => tep_encrypt_password($password));

		if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
		if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

		tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

		$customer_id = tep_db_insert_id();

		$sql_data_array = array('customers_id' => $customer_id,
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
				$sql_data_array['entry_state'] = '';
			} else {
				$sql_data_array['entry_zone_id'] = '0';
				$sql_data_array['entry_state'] = $state;
			}
		}

		tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

		$address_id = tep_db_insert_id();

		tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

		tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

		if (SESSION_RECREATE == 'True') {
			tep_session_recreate();
		}

		$customer_first_name = $firstname;
		$customer_default_address_id = $address_id;
		$customer_country_id = $country;
		$customer_zone_id = $zone_id;
		ajaxSessionRegister('customer_id',$customer_id);
		ajaxSessionRegister('customer_first_name',$customer_first_name);
		ajaxSessionRegister('customer_default_address_id',$customer_default_address_id);
		ajaxSessionRegister('customer_country_id',$customer_country_id);
		ajaxSessionRegister('customer_zone_id',$customer_zone_id);

		// restore cart contents
		$cart->restore_contents();

		// build the message content
		$name = $firstname . ' ' . $lastname;

		if (ACCOUNT_GENDER == 'true') {
			if ($gender == 'm') {
				$email_text = sprintf(EMAIL_GREET_MR, $lastname);
			} else {
				$email_text = sprintf(EMAIL_GREET_MS, $lastname);
			}
		} else {
			$email_text = sprintf(EMAIL_GREET_NONE, $firstname);
		}

		$email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
		tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

		//load shipping options now
	}

	if ($error == true) {
		echo '<div class="alert alert-error">'.$error_message.'</div>';
		$this->showCreateAccount(true, $entry_state_has_zones, $country);
	} else
	{
		$this->showShipping('');
	} 

}

}
?>