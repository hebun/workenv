<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/
require_once('ajax/includes/ajaxSessionFunctions.inc.php');
class stopDirectAccess {

	function authorise($sessionVar) {
		ajaxSessionRegister($sessionVar);
		$GLOBALS[$sessionVar] = stopDirectAccess::makeSessionId();
	}

	function deAuthorise($sessionVar) {
		ajaxSessionUnregister($sessionVar);
	}

	function checkAuthorisation($sessionVar) {
		if(!ajaxSessionIsRegistered($sessionVar))
			exit("Session not registered or have expired - You cant access this page directly. Please reload a page.");

		if($GLOBALS[$sessionVar] != stopDirectAccess::makeSessionId())
			exit("Session don't match - You cant access this page directly. Please reload a page.");

	}

	function makeSessionId() {
		return sha1(md5(AM_VALID_INCLUDE_PASSWORD));
	}

}

?>