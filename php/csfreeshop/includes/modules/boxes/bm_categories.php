<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class bm_categories {
    var $code = 'bm_categories';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function bm_categories() {
      $this->title = MODULE_BOXES_CATEGORIES_TITLE;
      $this->description = MODULE_BOXES_CATEGORIES_DESCRIPTION;

      if ( defined('MODULE_BOXES_CATEGORIES_STATUS') ) {
        $this->sort_order = MODULE_BOXES_CATEGORIES_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_CATEGORIES_STATUS == 'True');
        $this->pages = MODULE_BOXES_CATEGORIES_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_CATEGORIES_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }
	
	
    function tep_show_category($counter, $count) {
      global $tree, $categories_string, $cPath_array;

if ($count == 0 ) $kk=''; else $kk=''; 
    $count++;
	  $categories_string .= '<li '.$kk.' class="htooltip">';
		$categories_string .= '<div class="div_2">';


    for ($i=0; $i<$tree[$counter]['level']; $i++) {
      $categories_string .= '<div class="div">';
    }
        
      
      $categories_string .= '<a href="';

      if ($tree[$counter]['parent'] == 0) {
        $cPath_new = 'cPath=' . $counter;
      } else {
        $cPath_new = 'cPath=' . $tree[$counter]['path'];
      }
			if ($tree[$counter]['image']) {
				$categories_img = ' rel="'.DIR_WS_IMAGES . $tree[$counter]['image'].'"';
			} else {
				$categories_img = '';
			}
      $categories_string .= tep_href_link(FILENAME_DEFAULT, $cPath_new) . '"' . $categories_img . '>'.tep_draw_box_list_top() . '';

      if (isset($cPath_array) && in_array($counter, $cPath_array)) {
        $categories_string .= '<b>';
      }

// display category name
      $categories_string .= $tree[$counter]['name'];

      if (isset($cPath_array) && in_array($counter, $cPath_array)) {
        $categories_string .= '</b>';
      }

      if (tep_has_category_subcategories($counter)) {
        $categories_string .= '<span class="category_arrow"></span>';
      }

      

      if (SHOW_COUNTS == 'true') {
        $products_in_category = tep_count_products_in_category($counter);
        if ($products_in_category > 0) {
          $categories_string .= '&nbsp;(' . $products_in_category . ')';
        }
      }
	  $categories_string .= ''.tep_draw_box_list_bottom()  . /*tep_image(DIR_WS_IMAGES .$tree[$counter]['image'], $tree[$counter]['name'],  HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . */'</a>';
      for ($i=0; $i<$tree[$counter]['level']; $i++) {
      $categories_string .= '</div>';
      }
	  $categories_string .= '</div>';
	  $categories_string .= '</li>';		
      $categories_string .= '';

      if ($tree[$counter]['next_id'] != false) {
        $this->tep_show_category($tree[$counter]['next_id'], $count);
      }
    }

    function getData() {
      global $categories_string, $tree, $languages_id, $cPath, $cPath_array;

      $categories_string = '';
      $tree = array();

      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
      while ($categories = tep_db_fetch_array($categories_query))  {
        $tree[$categories['categories_id']] = array('name' => $categories['categories_name'],
																										'image' => $categories['categories_image'],/* ***************** */	
                                                    'parent' => $categories['parent_id'],
                                                    'level' => 0,
                                                    'path' => $categories['categories_id'],
                                                    'next_id' => false);

        if (isset($parent_id)) {
          $tree[$parent_id]['next_id'] = $categories['categories_id'];
        }

        $parent_id = $categories['categories_id'];

        if (!isset($first_element)) {
          $first_element = $categories['categories_id'];
        }
      }

      if (tep_not_null($cPath)) {
        $new_path = '';
        reset($cPath_array);
        while (list($key, $value) = each($cPath_array)) {
          unset($parent_id);
          unset($first_id);
		  unset($image_id);
          $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$value . "' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
          if (tep_db_num_rows($categories_query)) {
            $new_path .= $value;
            while ($row = tep_db_fetch_array($categories_query)) {
              $tree[$row['categories_id']] = array('name' => $row['categories_name'],
			  										'image' => $row['categories_image'],/* ***************** */	
                                                   'parent' => $row['parent_id'],
                                                   'level' => $key+1,
                                                   'path' => $new_path . '_' . $row['categories_id'],
                                                   'next_id' => false);

              if (isset($parent_id)) {
                $tree[$parent_id]['next_id'] = $row['categories_id'];
              }

              $parent_id = $row['categories_id'];

              if (!isset($first_id)) {
                $first_id = $row['categories_id'];
              }

              $last_id = $row['categories_id'];
            }
            $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
            $tree[$value]['next_id'] = $first_id;
            $new_path .= '_';
          } else {
            break;
          }
        }
      }

      $this->tep_show_category($first_element, $count);

      $data = '<div class="infoBoxWrapper list">' . tep_draw_box_wrapper_top() . 
              '  <div class="infoBoxHeading">' . tep_draw_box_title_top() . MODULE_BOXES_CATEGORIES_BOX_TITLE . tep_draw_box_title_bottom() . '</div>' .
              '  <div class="infoBoxContents">' . tep_draw_box_content_top() . '<ul class="categories">' . $categories_string . '</ul>' . tep_draw_box_content_bottom() . '</div>' .
              '' . tep_draw_box_wrapper_bottom() . '</div>';

      return $data;
    }

    function execute() {
      global $SID, $oscTemplate;

      if ((USE_CACHE == 'true') && empty($SID)) {
        $output = tep_cache_categories_box();
      } else {
        $output = $this->getData();
      }

      $oscTemplate->addBlock($output, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_CATEGORIES_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Categories Module', 'MODULE_BOXES_CATEGORIES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_CATEGORIES_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_CATEGORIES_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_CATEGORIES_DISPLAY_PAGES', 'all', 'select pages where this box should be displayed. ', '6', '1','tep_cfg_select_pages(' , now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_CATEGORIES_STATUS', 'MODULE_BOXES_CATEGORIES_CONTENT_PLACEMENT', 'MODULE_BOXES_CATEGORIES_SORT_ORDER','MODULE_BOXES_CATEGORIES_DISPLAY_PAGES');
    }
  }
?>
