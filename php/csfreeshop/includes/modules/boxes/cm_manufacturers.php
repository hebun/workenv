<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class cm_manufacturers {
    var $code = 'cm_manufacturers';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_manufacturers() {
      $this->title = MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_TITLE;
      $this->description = MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_DESCRIPTION;

      if ( defined('MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_STATUS') ) {
        $this->sort_order = MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_STATUS == 'True');
        $this->pages = MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_CONTENT_PLACEMENT == 'Footer Block') ? 'boxes_footer' : 'boxes_header');
      }
    }

    function getData() {
      global $HTTP_GET_VARS, $oscTemplate;

      $data = '';

      $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
      if ($number_of_rows = tep_db_num_rows($manufacturers_query)) {
// Display a drop-down
          $manufacturers_array = array();
          if (MAX_MANUFACTURERS_LIST < 2) {
            $manufacturers_array[] = array('id' => '', 'text' => PULL_DOWN_DEFAULT);
          }

          while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
            $manufacturers_name = $manufacturers['manufacturers_name'];
            $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                           'text' => $manufacturers_name);
          }

          $content = tep_draw_form('manufacturers', tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false), 'get') .
                     tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, (isset($HTTP_GET_VARS['manufacturers_id']) ? $HTTP_GET_VARS['manufacturers_id'] : ''), 'onchange="this.form.submit();" size="' . MAX_MANUFACTURERS_LIST . '" class="select chzn-select"') . tep_hide_session_id() .
                     '</form>';

          $data = '<div class="box_manufacturers">' .
		  		  '		<div class="manufacturers custom_select">' .
                  '  	<label class="fl_left">'. MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_BOX_TITLE.': </label>' .
                  '' . $content  . '' .
          		  '		</div>' .
				  '</div>';
      }

      return $data;
    }

    function execute() {
      global $SID, $oscTemplate;

      if ((USE_CACHE == 'true') && empty($SID)) {
        $output = tep_cache_manufacturers_box();
      } else {
        $output = $this->getData();
      }

      $oscTemplate->addBlock($output, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Manufacturers Module', 'MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_CONTENT_PLACEMENT', 'Header Block', 'Should the module be loaded in the Header Block or Footer Block?', '6', '1', 'tep_cfg_select_option(array(\'Header Block\', \'Footer Block\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_SORT_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_STATUS', 'MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_CONTENT_PLACEMENT', 'MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_SORT_ORDER','MODULE_BOXES_MANUFACTURERS_HEADER_FOOTER_DISPLAY_PAGES');
    }
  }
?>
