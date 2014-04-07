<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/
require_once('ajax/includes/ajaxSessionFunctions.inc.php');

class ajaxManagerConfig {

	var $arrConfig = array();

	function ajaxManagerConfig() {
		$this->add('AM_DEFAULT_LANGUAGE_ID',$GLOBALS['languages_id']);
		$this->add('AM_VALID_INCLUDE_PASSWORD','dfsdsESFF32SDsaasfSD322re24323asdas');
		$this->add('AM_SESSION_VALID_INCLUDE','am_valid_include');
		$this->add('AM_SESSION_VAR_NAME','am_session_var'); // main var for atomic
		$this->add('AM_SESSION_CURRENT_LANG_VAR_NAME','am_current_lang_session_var'); // current interface lang
		$this->add('AM_ACTION_GET_VARIABLE', 'ajaxAction'); // attribute manager get variable name
		$this->add('AM_PAGE_ACTION_NAME','pageAction'); // attribute manager parent page action e.g. new_product

	}

	function load() {
		if(0 !== count($this->arrConfig))
			foreach($this->arrConfig as $key => $value)
				define($key, $value);
	}

	function getValue($key) {
		if(array_key_exists($key, $this->arrConfig))
			return $this->arrConfig[$key];
		return false;
	}

	function add($key, $value) {
		$this->arrConfig[$key] = $value;
	}

}

$config = new ajaxManagerConfig();
$config->load();
?>