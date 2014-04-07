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

define('NAVBAR_TITLE', 'Checkout');
define('HEADING_TITLE', 'Checkout');

// GENERAL
define('TITLE_PLEASE_SELECT', 'Please Select');

// CART
define('IMAGE_BUTTON_CONFIRM', 'Confirm');
define('TABLE_HEADING_PRODUCTS', 'Product(s)');
define('TABLE_HEADING_REMOVE', 'Remove');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE', 'Price');
define('OUT_OF_STOCK_CANT_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' dont exist in desired quantity in our stock.<br />Please alter the quantity of products marked with (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '), Thank you');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' dont exist in desired quantity in our stock.<br />You can buy them anyway and check the quantity we have in stock for immediate deliver in the checkout process.');

// SHIPPING
define('TABLE_HEADING_SHIPPING_ADDRESS', 'Shipping Address');
define('TEXT_CHOOSE_SHIPPING_DESTINATION', 'Please choose from your address book where you would like the items to be delivered to.');
define('TITLE_SHIPPING_ADDRESS', 'Shipping Address:');

define('TABLE_HEADING_SHIPPING_METHOD', 'Shipping Method');
define('TEXT_CHOOSE_SHIPPING_METHOD', 'Please select the preferred shipping method to use on this order.');
define('TEXT_ENTER_SHIPPING_INFORMATION', 'This is currently the only shipping method available to use on this order.');

// BILLING
define('TABLE_HEADING_BILLING_ADDRESS', 'Billing Address');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Please choose from your address book where you would like the invoice to be sent to.');
define('TITLE_BILLING_ADDRESS', 'Billing Address:');

define('TABLE_HEADING_PAYMENT_METHOD', 'Payment Method');
define('TEXT_SELECT_PAYMENT_METHOD', 'Please select the preferred payment method to use on this order.');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'This is currently the only payment method available to use on this order.');

// COMMENTS
define('TABLE_HEADING_COMMENTS', 'Add Comments About Your Order');

// CONFIRM
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Continue Checkout Procedure');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', 'to confirm this order.');

// LOGIN
define('NAVBAR_TITLE_LOGIN', 'Login');
define('HEADING_TITLE_LOGIN', 'Welcome, Please Sign In');

define('HEADING_NEW_CUSTOMER', 'New Customer');
define('TEXT_NEW_CUSTOMER', 'I am a new customer.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'By creating an account at ' . STORE_NAME . ' you will be able to shop faster, be up to date on an orders status, and keep track of the orders you have previously made.');

define('HEADING_RETURNING_CUSTOMER', 'Returning Customer');
define('TEXT_RETURNING_CUSTOMER', 'I am a returning customer.');

define('TEXT_PASSWORD_FORGOTTEN', 'Password forgotten? Click here.');

define('TEXT_LOGIN_ERROR', 'Error: No match for E-Mail Address and/or Password.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><strong>Note:</strong></font> Your &quot;Visitors Cart&quot; contents will be merged with your &quot;Members Cart&quot; contents once you have logged on. <a href="javascript:session_win();">[More Info]</a>');

// FORGOT
define('NAVBAR_TITLE_FORGOT', 'Password Forgotten');
define('HEADING_TITLE_FORGOT', 'I\'ve Forgotten My Password!');

define('TEXT_PASSWORD_REMINDER', 'If you\'ve forgotten your password, enter your e-mail address below and we\'ll send you an e-mail message containing your new password.');

define('IMAGE_BUTTON_RESET_PASSWORD', 'Reset Password');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: The E-Mail Address was not found in our records, please try again.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - New Password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'A new password was requested from ' . tep_get_ip_address() . '.' . "\n\n" . 'Your new password to \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Success: A new password has been sent to your e-mail address.');

// ACCOUNT
define('NAVBAR_TITLE_ACCOUNT', 'Create an Account');
define('HEADING_TITLE_ACCOUNT', 'My Account Information');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><strong>NOTE:</strong></small></font> If you already have an account with us, please login at the <a href="%s"><u>login page</u></a>.');
define('TABLE_HEADING_NEW_CUSTOMER', 'Account Details');

define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Dear Mr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");
define('EMAIL_WELCOME', 'We welcome you to <strong>' . STORE_NAME . '</strong>.' . "\n\n");
define('EMAIL_TEXT', 'You can now take part in the <strong>various services</strong> we have to offer you. Some of these services include:' . "\n\n" . '<li><strong>Permanent Cart</strong> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><strong>Address Book</strong> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><strong>Order History</strong> - View your history of purchases that you have made with us.' . "\n" . '<li><strong>Products Reviews</strong> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<strong>Note:</strong> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
define('IMAGE_BUTTON_CREATE', 'Create Account');

// ADDRESSES
define('IMAGE_BUTTON_EDIT_ADDRESS', 'Edit Address');
define('TABLE_HEADING_ADDRESS_BOOK_ENTRIES', 'Address Book Entries');
define('TABLE_HEADING_EDIT_ADDRESS', 'Edit Address');
define('TABLE_HEADING_NEW_ADDRESS', 'New Address');
define('ENTRY_STATE_ERROR_INVALID', 'Please enter a valid state name or two letter code');
define('WARNING_PRIMARY_ADDRESS_DELETION', 'The primary address cannot be deleted. Please set another address as the primary address and try again.');
define('PRIMARY_ADDRESS', '(primary address)');

?>