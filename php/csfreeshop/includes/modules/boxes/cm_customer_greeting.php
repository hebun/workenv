<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2011 osCommerce

  Released under the GNU General Public License
*/

  class cm_customer_greeting {
    var $code = 'cm_customer_greeting';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_customer_greeting() {
      $this->title = MODULE_BOXES_CUSTOMER_GREETING_TITLE;
      $this->description = MODULE_BOXES_CUSTOMER_GREETING_DESCRIPTION;
      $this->box_title = MODULE_BOXES_CUSTOMER_GREETING_BOX_TITLE;

      if ( defined('MODULE_BOXES_CUSTOMER_GREETING_STATUS') ) {
        $this->sort_order = MODULE_BOXES_CUSTOMER_GREETING_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_CUSTOMER_GREETING_STATUS == 'True');
        $this->pages = MODULE_BOXES_CUSTOMER_GREETING_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_CUSTOMER_GREETING_CONTENT_PLACEMENT == 'Content Top Set Block') ? 'box_top_content_set' : 'box_bottom_content_set');
      }
    }

    function execute() {
	  global $oscTemplate;

	//  $execute = false;
	//  if (tep_not_null(TEXT_MAIN))	{
        $data = '<div class="customer_greeting">'.tep_customer_greeting().'</div>';
		$execute = true;
    //  }
	  	  
	  if($execute){
      	$oscTemplate->addBlock($data, $this->group);
	  }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_CUSTOMER_GREETING_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Banner Header Module', 'MODULE_BOXES_CUSTOMER_GREETING_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_CUSTOMER_GREETING_CONTENT_PLACEMENT', 'Content Top Set Block', 'The module should be loaded in the Content Top Set Block or Content Bottom Set Block only', '6', '1', 'tep_cfg_select_option(array(\'Content Top Set Block\', \'Content Bottom Set Block\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_CUSTOMER_GREETING_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_CUSTOMER_GREETING_DISPLAY_PAGES', 'index.php', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");	  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_CUSTOMER_GREETING_STATUS', 'MODULE_BOXES_CUSTOMER_GREETING_CONTENT_PLACEMENT', 'MODULE_BOXES_CUSTOMER_GREETING_SORT_ORDER', 'MODULE_BOXES_CUSTOMER_GREETING_DISPLAY_PAGES');
    }
  }
?>