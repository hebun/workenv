<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/
class ajaxManager {

	var $intLanguageId;
	var $arrPageActions = array();
	function ajaxManager() {
		$this->setInterfaceLanguage();
		$this->registerPageAction('actionName','actionName');
	}

	function setInterfaceLanguage($get=array()) {
		if(count($get) > 0) {
			if(is_numeric($get['language_id'])) {
				amSessionRegister(AM_SESSION_CURRENT_LANG_VAR_NAME);
				amSetSessionVariable(AM_SESSION_CURRENT_LANG_VAR_NAME,$get['language_id']);
				$this->intLanguageId = $get['language_id'];
			}
		}
		else {
			$langId = ajaxGetSesssionVariable(AM_SESSION_CURRENT_LANG_VAR_NAME);
			if(false !== $langId)
				$this->intLanguageId = $langId;
			else
				$this->intLanguageId = AM_DEFAULT_LANGUAGE_ID;
		}
	}
	function getSelectedLanaguage() {
		return $this->intLanguageId;
	}

	function registerPageAction($strAction,$strFunction) {
		$this->arrPageActions[$strAction] = $strFunction;
	}

	function unregisterPageAction($strAction) {
		unset($this->arrPageActions[$strAction]);
	}

	function executePageAction($get) {
		$results = array();
		if(array_key_exists(AM_ACTION_GET_VARIABLE,$get)) {
			$actionKey = $get[AM_ACTION_GET_VARIABLE];
			if(array_key_exists($actionKey,$this->arrPageActions)){
				$functionName = $this->arrPageActions[$actionKey];
				if(method_exists($this,$functionName)) {
					$results = $this->$functionName($get);
				}
			}
		}
		return $results;
	}

	function debugOutput($ent) {
		echo (is_array($ent) || is_object($ent)) ? '<pre style="text-align:left">'.print_r($ent, true).'</pre>' : $ent;
	}


	function getAndPrepare($strIndex,$array, &$variable) {
		$variable = tep_db_prepare_input($array[$strIndex]);
	}

}
?>