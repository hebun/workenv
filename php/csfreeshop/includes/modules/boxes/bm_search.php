<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class bm_search {
    var $code = 'bm_search';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function bm_search() {
      $this->title = MODULE_BOXES_SEARCH_TITLE;
      $this->description = MODULE_BOXES_SEARCH_DESCRIPTION;

      if ( defined('MODULE_BOXES_SEARCH_STATUS') ) {
        $this->sort_order = MODULE_BOXES_SEARCH_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_SEARCH_STATUS == 'True');
				$this->pages = MODULE_BOXES_SEARCH_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_SEARCH_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $oscTemplate;
			  
      $data = '<div class="infoBoxWrapper box3">' . tep_draw_box_wrapper_top() .
          //    '  <div class="infoBoxHeading">' . tep_draw_box_title_top() . MODULE_BOXES_SEARCH_BOX_TITLE . tep_draw_box_title_bottom() . '</div>' .
              '  <div class="infoBoxContents search">' . tep_draw_box_content_top() . ' 
			    		' . tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get') ."\n".
	  		  		'	 	<div class="input-width fl_left">'."\n".
              ' 		<div class="width-setter">'."\n".			  
			  	 	tep_draw_input_field('keywords', MODULE_BOXES_SEARCH_BOX_TITLE, 'size="10" maxlength="300" class="go fl_left" onblur="if(this.value==\'\') this.value=\'' . MODULE_BOXES_SEARCH_BOX_TITLE . '\'" onfocus="if(this.value ==\'' . MODULE_BOXES_SEARCH_BOX_TITLE . '\' ) this.value=\'\'"') . '' . tep_hide_session_id() ."\n".  
			  			'	  		</div>' ."\n".
			 				'	   	</div>' ."\n".
			  			'		'.tep_image_submit('button_header_search.gif', '', ' class="button_header_search fl_left"').'' ."\n".
						'		<div class="advanced cl_both"><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '">'.MODULE_BOXES_ITEM_ADVANCED_SEARCH.'</a></div>' ."\n".
			  			'    </form>' . 
			  			'' . tep_draw_box_content_bottom() . '</div>'. "\n".
          	  '' . tep_draw_box_wrapper_bottom() . '</div>';
			  
			  

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_SEARCH_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Search Module', 'MODULE_BOXES_SEARCH_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_SEARCH_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_SEARCH_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_SEARCH_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");						
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_SEARCH_STATUS', 'MODULE_BOXES_SEARCH_CONTENT_PLACEMENT', 'MODULE_BOXES_SEARCH_SORT_ORDER', 'MODULE_BOXES_SEARCH_DISPLAY_PAGES');
    }
  }
?>
