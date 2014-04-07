<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/

chdir('../');
require_once('includes/application_top.php');
require_once('includes/ajaxSessionFunctions.inc.php');
require_once('classes/ajaxManagerConfig.class.php');
require_once('includes/ajaxGeneralFunctions.inc.php');
require_once('classes/ajaxManager.class.php');
require_once('classes/ajaxManagerTest.class.php');

// security class
require_once('classes/stopDirectAccess.class.php');

  require_once(DIR_WS_CLASSES . 'order.php');
  require_once(DIR_WS_CLASSES . 'order_total.php');
  require_once(DIR_WS_CLASSES . 'shipping.php');
  require_once(DIR_WS_CLASSES . 'http_client.php');
  require_once(DIR_WS_CLASSES . 'payment.php');

// check that the file is allowed to be accessed
$stopDirectAccess = new stopDirectAccess();
$stopDirectAccess->checkAuthorisation(AM_SESSION_VALID_INCLUDE);

// stopDirectAccess::checkAuthorisation(AM_SESSION_VALID_INCLUDE);
// get an instance of one of the attribute manager classes
$ajaxManager = GetAjaxManagerInstance($_GET);

// do any actions that should be done
$globalVars = $ajaxManager->executePageAction($_GET);

// set any global variables from the page action execution
if(0 !== count($globalVars) && is_array($globalVars))
	foreach($globalVars as $varName => $varValue)
		$$varName = $varValue;
//output a response header
// header('Content-type: text/html; charset=UTF-8');

if(!isset($_GET['target'])) {
if(!isset($_GET['target']) || $_GET['target'] == 'products_area')
{
echo '<div id="products_area">';
$ajaxManager->showProducts('');
echo '</div>';
}

if(!isset($_GET['target']) || $_GET['target'] == 'totals_area')
{
echo '<div id="totals_area">';
$ajaxManager->showTotals('');
echo '</div>';
}

if(!isset($_GET['target']) || $_GET['target'] == 'shipping_area')
{
echo '<div id="shipping_area">';
$ajaxManager->showShipping('');
echo '</div>';
}

if(!isset($_GET['target']) || $_GET['target'] == 'payment_area')
{
echo '<div id="payment_area">';
$ajaxManager->showPayment('');
echo '</div>';
}

if(!isset($_GET['target']) || $_GET['target'] == 'placeorder_div')
{
echo '<div id="placeorder_area">';
$ajaxManager->showPlaceOrder('');
echo '</div>';
}
}
?>