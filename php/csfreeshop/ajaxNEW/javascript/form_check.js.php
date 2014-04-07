<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/
?>
<script language="javascript"><!--

var selected;
var selected_shipping = 0;
var selected_payment = 0;
var selected_address = 0;
var selected_payment_address = 0;

function selectRowEffect(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

// one button is not an array
  var shipping = document.getElementById('shipping');
  if (shipping)
  {
    shipping.checked=true;
  }

  var selectable = document.getElementById('shipping_'+buttonSelect);
  if (selectable)
  {
    selectable.checked=true;
    selected_shipping = buttonSelect;
  }

  var selectable_address = document.getElementById('address_'+buttonSelect);
  if (selectable_address)
  {
    selectable_address.checked=true;
    selected_address = buttonSelect;
  }

}

function selectRowEffectPayment(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

// one button is not an array

  var selectable_payment = document.getElementById('payment_'+buttonSelect);
  if (selectable_payment)
  {
    selectable_payment.checked=true;
    selected_payment = buttonSelect;
  }

}

function selectRowEffectPaymentAddress(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

  var selectable_payment_address = document.getElementById('payment_address_'+buttonSelect);
  if (selectable_payment_address)
  {
    selectable_payment_address.checked=true;
    selected_payment_address = buttonSelect;
  }

}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script>
<?
  echo $payment_modules->javascript_validation();

?>
<script language="javascript"><!--
var form = "";

var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {

  if (getElement(field_name) && (getElement(field_name).type != "hidden")) {
    var field_value = getElement(field_name).value;

    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_radio(field_name, message) {
  var isChecked = false;

  if (getElement(field_name) && (getElement(field_name).type != "hidden")) {

    var radio =  document.getElementsByName(field_name);

    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }

    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (getElement(field_name) && (getElement(field_name).type != "hidden")) {
    var field_value = getElement(field_name).value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_password(field_name_1, field_name_2, field_size, message_1, message_2) {
  if (getElement(field_name_1) && (getElement(field_name_1).type != "hidden")) {
    var password = getElement(field_name_1).value;
    var confirmation = getElement(field_name_2).value;

    if (password == '' || password.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}

function check_password_new(field_name_1, field_name_2, field_name_3, field_size, message_1, message_2, message_3) {
  if (getElement(field_name_1) && (getElement(field_name_1).type != "hidden")) {
    var password_current = getElement(field_name_1).value;
    var password_new = getElement(field_name_2).value;
    var password_confirmation = getElement(field_name_3).value;

    if (password_current == '' || password_current.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password_new == '' || password_new.length < field_size) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    } else if (password_new != password_confirmation) {
      error_message = error_message + "* " + message_3 + "\n";
      error = true;
    }
  }
}

function check_create_account() {
  error = false;
  //form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";

<?php if (ACCOUNT_GENDER == 'true') echo '  check_radio("gender", "' . ENTRY_GENDER_ERROR . '");' . "\n"; ?>

  check_input("firstname", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_FIRST_NAME_ERROR; ?>");
  check_input("lastname", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LAST_NAME_ERROR; ?>");

<?php if (ACCOUNT_DOB == 'true') echo '  check_input("dob", ' . ENTRY_DOB_MIN_LENGTH . ', "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n"; ?>

  check_input("email_address", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>");
  check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>");
  check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo ENTRY_POST_CODE_ERROR; ?>");
  check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo ENTRY_CITY_ERROR; ?>");

<?php if (ACCOUNT_STATE == 'true') echo '  check_input("state", ' . ENTRY_STATE_MIN_LENGTH . ', "' . ENTRY_STATE_ERROR . '");' . "\n"; ?>

  check_select("country", "", "<?php echo ENTRY_COUNTRY_ERROR; ?>");

//  check_input("telephone", <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>, "<?php echo ENTRY_TELEPHONE_NUMBER_ERROR; ?>");

  check_password("password", "confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_ERROR_NOT_MATCHING; ?>");
  check_password_new("password_current", "password_new", "password_confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING; ?>");

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}

function check_form_address() {
  error = false;
  error_message = "<?php echo JS_ERROR; ?>";

<?php if (ACCOUNT_GENDER == 'true') echo '  check_radio("gender", "' . ENTRY_GENDER_ERROR . '");' . "\n"; ?>

  check_input("firstname", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_FIRST_NAME_ERROR; ?>");
  check_input("lastname", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LAST_NAME_ERROR; ?>");

<?php if (ACCOUNT_DOB == 'true') echo '  check_input("dob", ' . ENTRY_DOB_MIN_LENGTH . ', "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n"; ?>

  check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>");
  check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo ENTRY_POST_CODE_ERROR; ?>");
  check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo ENTRY_CITY_ERROR; ?>");

<?php if (ACCOUNT_STATE == 'true') echo '  check_input("state", ' . ENTRY_STATE_MIN_LENGTH . ', "' . ENTRY_STATE_ERROR . '");' . "\n"; ?>

  check_select("country", "", "<?php echo ENTRY_COUNTRY_ERROR; ?>");

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    return true;
  }

}

//--></script>
