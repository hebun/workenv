<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/

function GetAjaxManagerInstance($get) {

	if (true)  //loads first time? yes
	{
			ajaxSessionUnregister(AM_SESSION_VAR_NAME);
			ajaxSessionRegister(AM_SESSION_VAR_NAME, array());

      $ajaxManager = new ajaxManagerTest(ajaxGetSesssionVariable(AM_SESSION_VAR_NAME));
  }
  else  //loads via ajax
  {
  		$ajaxManager = new ajaxManagerTest($parameter);
  }

	return $ajaxManager;
}

function draw_button($title = null, $priority = null, $params = null, $icon = null) {
	if($priority == 'primary') {
		$draw_button = '<span style=""><a ' . $params . ' class="classname ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-primary" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ' . $icon . '"></span><span class="ui-button-text">' . $title . '</span></a></span>';
	} else {
		$draw_button = '<span style=""><a ' . $params . ' class="classname ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-secondary ui-priority-secondary" role="button" aria-disabled="false"><span class="ui-button-icon-secondary ui-icon ' . $icon . '"></span><span class="ui-button-text">' . $title . '</span></a></span>';
	}
	
	return $draw_button;
}

?>