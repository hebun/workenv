<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class bm_best_sellers {
    var $code = 'bm_best_sellers';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

   
    function bm_best_sellers() {
			global $current_page;
			$this->title = MODULE_BOXES_BEST_SELLERS_TITLE;
      $this->description = MODULE_BOXES_BEST_SELLERS_DESCRIPTION;

      if ( defined('MODULE_BOXES_BEST_SELLERS_STATUS') ) {
        $this->sort_order = MODULE_BOXES_BEST_SELLERS_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_BEST_SELLERS_STATUS == 'True');
        $this->pages = MODULE_BOXES_BEST_SELLERS_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_BEST_SELLERS_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $HTTP_GET_VARS, $current_category_id, $languages_id, $oscTemplate;

      if (!isset($HTTP_GET_VARS['products_id'])) {
        if (isset($current_category_id) && ($current_category_id > 0)) {
          $best_sellers_query = tep_db_query("select distinct p.products_id, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
        } else {
          $best_sellers_query = tep_db_query("select distinct p.products_id, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
        }

        if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
          while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
/* ********************************* */			 
			$name_prod = '<div class="div_1"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '" rel="'.DIR_WS_IMAGES . $best_sellers['products_image'].'">' . $best_sellers['products_name'] . '</a></div>';
			 
/* ********************************* */				
			$count ++;			  
				if ($count <= 9 )	{
				$separ = '0'; // 0
				} else {
				$separ = '';
				} 
			  
            $bestsellers_list .= '<li>'.tep_draw_box_list_top() . '<b>'.$separ.$count .'.</b>'.$name_prod.''.tep_draw_box_list_bottom() . '</li>';
          }
       //   $bestsellers_list .= '';

          $data = '<div class="infoBoxWrapper list">' . "\n" .
			  					'  		<div class="infoBoxHeading">' . tep_draw_box_title_top() . '<a href="' . tep_href_link(FILENAME_TOPSELLERS_PRODUCTS) . '">'. MODULE_BOXES_BEST_SELLERS_BOX_TITLE . '</a>'. tep_draw_box_title_bottom() . '</div>' . "\n".
                  '  		<div class="infoBoxContents">' . tep_draw_box_content_top() . '<ul class="bestsellers">' . $bestsellers_list . '</ul>' . "\n".
									//'' .tep_draw_button2_top() . '<a href="'.tep_href_link(FILENAME_TOPSELLERS_PRODUCTS).'" id="tdb1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text">'.  SEE_ALL .'</span></a>' . tep_draw_button2_bottom().'' . "\n".
									'' . tep_draw_box_content_bottom() . '</div>' . "\n".
                  '</div>';

          $oscTemplate->addBlock($data, $this->group);
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_BEST_SELLERS_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Best Sellers Module', 'MODULE_BOXES_BEST_SELLERS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_BEST_SELLERS_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_BEST_SELLERS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_BEST_SELLERS_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_BEST_SELLERS_STATUS', 'MODULE_BOXES_BEST_SELLERS_CONTENT_PLACEMENT', 'MODULE_BOXES_BEST_SELLERS_SORT_ORDER','MODULE_BOXES_BEST_SELLERS_DISPLAY_PAGES');
    }
  }
?>
