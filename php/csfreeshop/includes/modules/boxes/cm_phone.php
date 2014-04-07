<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2011 osCommerce

  Released under the GNU General Public License
*/

  class cm_phone {
    var $code = 'cm_phone';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_phone() {
      $this->title = MODULE_BOXES_PHONE_TITLE;
      $this->description = MODULE_BOXES_PHONE_DESCRIPTION;
      $this->box_title = MODULE_BOXES_PHONE_BOX_TITLE;

      if ( defined('MODULE_BOXES_PHONE_STATUS') ) {
        $this->sort_order = MODULE_BOXES_PHONE_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_PHONE_STATUS == 'True');
		$this->pages = MODULE_BOXES_PHONE_DISPLAY_PAGES;
		$this->group = 'boxes_header';
      }
    }

    function execute() {
	  global $oscTemplate;
	  
	  $data = '';
	  $execute = false;
	  if ((tep_not_null(MODULE_BOXES_PHONE_BOX_TEXT1_MAIN)) || (tep_not_null(MODULE_BOXES_PHONE_BOX_TEXT2_MAIN)))	{
        $data .= '<div class="box_header_phone">'.MODULE_BOXES_PHONE_BOX_TEXT1_MAIN.' &nbsp;&nbsp;'.MODULE_BOXES_PHONE_BOX_TEXT2_MAIN.'</div>';
		$execute = true;
      }
	  if($execute){
      	$oscTemplate->addBlock($data, $this->group);
	  }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_PHONE_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Banner Column Module', 'MODULE_BOXES_PHONE_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_PHONE_CONTENT_PLACEMENT', 'Header Block', 'The module should be loaded in the under header or above footer block', '6', '1', 'tep_cfg_select_option(array(\'Header Block\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_PHONE_SORT_ORDER', '6040', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_PHONE_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");	  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_PHONE_STATUS', 'MODULE_BOXES_PHONE_CONTENT_PLACEMENT', 'MODULE_BOXES_PHONE_SORT_ORDER', 'MODULE_BOXES_PHONE_DISPLAY_PAGES');
    }
  }
?>