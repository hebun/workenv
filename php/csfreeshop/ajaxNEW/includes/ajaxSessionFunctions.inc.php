<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/
function ajaxSessionUnregister($strSessionVar) {
	if(ajaxSessionIsRegistered($strSessionVar)){
		tep_session_unregister($strSessionVar);
	}
	unset($GLOBALS[$strSessionVar]);
}

function ajaxSessionRegister($strSessionVar,$value = '') {
	if(!ajaxSessionIsRegistered($strSessionVar)) {
		tep_session_register($strSessionVar);
		$GLOBALS[$strSessionVar] = $value;
	}
}

function ajaxSessionIsRegistered($strSessionVar) {
	return tep_session_is_registered($strSessionVar);
}

function ajaxGetSesssionVariable($strSessionVar) {
	if(isset($GLOBALS[$strSessionVar]))
		return $GLOBALS[$strSessionVar];
	return false;
}

function ajaxSetSessionVariable($key, $value) {
	$GLOBALS[$key] = $value;
}
?>