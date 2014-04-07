<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class cm_multy_bestsellers {
    var $code = 'cm_multy_bestsellers';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_multy_bestsellers() {
      $this->title = MODULE_BOXES_MULTY_BEST_SELLERS_TITLE;
      $this->description = MODULE_BOXES_MULTY_BEST_SELLERS_DESCRIPTION;

      if ( defined('MODULE_BOXES_MULTY_BEST_SELLERS_STATUS') ) {
        $this->sort_order = MODULE_BOXES_MULTY_BEST_SELLERS_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_MULTY_BEST_SELLERS_STATUS == 'True');
        $this->pages = MODULE_BOXES_MULTY_BEST_SELLERS_DISPLAY_PAGES;
        $this->group = ((MODULE_BOXES_MULTY_BEST_SELLERS_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');		
      }
    }

    function execute() {
      global $HTTP_GET_VARS, $current_category_id, $languages_id, $oscTemplate, $currencies;

	  $count = 0;
	  $col_best_sellers = 0;
	  $row_best_sellers = 0;
	  $col_items_best_sellers = (BOX_MULTY_BESTSELLERS_PER_ROW - 1);

      if (!isset($HTTP_GET_VARS['products_id'])) {
        if (isset($current_category_id) && ($current_category_id > 0)) {
          $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_description, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit " . BOX_MULTY_BESTSELLERS_MAX_DISPLAY);
        } else {
          $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_description, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered desc, pd.products_name limit " . BOX_MULTY_BESTSELLERS_MAX_DISPLAY);
        }

        if (tep_db_num_rows($best_sellers_query) >= BOX_MULTY_BESTSELLERS_MIN_DISPLAY) {
          while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
				  $best_sellers_list .= '';
			
				if (($col_best_sellers === 0) && ($row_best_sellers != 0)) {
				  $best_sellers_list .= '';
				} 
				if ($col_best_sellers === 0) {
				  $best_sellers_list .= '<ul class="best_sellers" id="best_sellers-'.$row_best_sellers.'">';
			   }else {
	   			  $best_sellers_list .= ''; 
			   }
			
				$p_id = $best_sellers['products_id'];
				if	(BOX_MULTY_BESTSELLERS_SHOW_NAME == 'true')	{
					$name_prod = '<div class="name name_padd  equal-height-box_best_sellers"><span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_id) . '">' . $best_sellers['products_name'] . '</a></span></div>';				
				}else{
					$name_prod = '';	
				}
				if	(BOX_MULTY_BESTSELLERS_SHOW_PIC == 'true')	{
					$pic_prod = '<div class="pic_padd wrapper_pic_div pic" align="center" style="width:'.(BOX_MULTY_BESTSELLERS_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(BOX_MULTY_BESTSELLERS_IMAGE_HEIGHT + PIC_MARG_H).'px;"><a class="prods_pic_bg" href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $p_id).'" style="width:'.(BOX_MULTY_BESTSELLERS_IMAGE_WIDTH + PIC_MARG).'px;height:'.(BOX_MULTY_BESTSELLERS_IMAGE_HEIGHT + PIC_MARG).'px;">'.tep_image(DIR_WS_IMAGES . $best_sellers['products_image'], $best_sellers['products_name'], (BOX_MULTY_BESTSELLERS_IMAGE_WIDTH), (BOX_MULTY_BESTSELLERS_IMAGE_HEIGHT), ' style="width:'.(BOX_MULTY_BESTSELLERS_IMAGE_WIDTH).'px;height:'.(BOX_MULTY_BESTSELLERS_IMAGE_HEIGHT).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"').''.tep_draw_box_multy_bestsellers_pic_top().''.tep_draw_box_multy_bestsellers_pic_bottom().'</a></div>';				
				}else{
					$pic_prod = '';	
				}
				if	(BOX_MULTY_BESTSELLERS_SHOW_PRICE == 'true')	{
					if (tep_not_null($best_sellers['specials_new_products_price'])) {
					  $best_sellers_price = '<b>'.PRICE.'</b><span class="productSpecialPrice">' . $currencies->display_price($best_sellers['specials_new_products_price'], tep_get_tax_rate($best_sellers['products_tax_class_id'])) . '</span> ';
					} else {
					  $best_sellers_price = '<b>'.PRICE.'</b><span class="productSpecialPrice">'.$currencies->display_price($best_sellers['products_price'], tep_get_tax_rate($best_sellers['products_tax_class_id'])).'</span>';
					}
					$sp_price = '<h2 class="price price_padd fl_left">'.$best_sellers_price.'</h2>';				
				}else{
					$sp_price = '';	
				}
				if	(BOX_MULTY_BESTSELLERS_SHOW_BUY == 'true')	{
					$p_buy_now_text = '<div class="button__padd"><div class="bg_button2" onMouseOut="this.className=\'bg_button2\';" onMouseOver="this.className=\'bg_button2-act\';">' .tep_draw_button2_top() . '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'" id="tdb1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_IN_CART .'</span></a>' . tep_draw_button2_bottom().'</div></div>'. "\n";				
				}else{
					$p_buy_now_text = '';	
				}
				if	(BOX_MULTY_BESTSELLERS_MAX_DESCR != 0)	{
					$p_desc =  '<div class="desc desc_padd">'.mb_substr(strip_tags($best_sellers['products_description']), 0, BOX_MULTY_BESTSELLERS_MAX_DESCR, 'UTF-8').'...</div>';
				}else{
					$p_desc = '';	
				}
			
			
			$best_sellers['specials_new_products_price'] = tep_get_products_special_price($p_id);
											
			$p_details_text = '<div class="bg_button22" onMouseOut="this.className=\'bg_button22\';" onMouseOver="this.className=\'bg_button22-act\';">' .tep_draw_button_top() . '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '" id="tdb1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text">'.  IMAGE_BUTTON_DETAILS .'</span></a>' . tep_draw_button_bottom().'</div>'. "\n";

			
			$count ++;			  
				if ($count <= 9 )	{
				$separ = '0';
				} else {
				$separ = '';
				} 
			  
				$best_sellers_list .= 
				  '<li style="width:'.(BOX_MULTY_BESTSELLERS_WIDTH).'px;" class="wrapper_prods hover ">'. "\n".
				  
				  
				  '			'.$pic_prod.''. "\n".
				  '		<div class="border_prods">'. "\n".
				  '				<div class="padd">' . "\n".
				  '       	' . $name_prod . "\n".
				  				  					  				  	 
				  '					'.$p_desc.''. "\n".
				  '					'.$sp_price.''. "\n".
				  '					'.$p_buy_now_text.''. "\n".
				  '			</div>'. "\n".				  				  
				  '		</div>'. "\n";

			
				if ($col_best_sellers >= $col_items_best_sellers) {
					$best_sellers_list .= '</ul>';
					$row_best_sellers ++;
					$col_best_sellers = 0;
				}else{
					$best_sellers_list .= '</li>';
					$col_best_sellers ++;	
				}
				
			}
			
			
          
		$data = 
			  /*'	<script type="text/javascript">' . "\n" .
			  '			$(document).ready(function(){' . "\n" . 			
			  '				 var row_list_box_best_sellers = $(\'.best_sellers\');' . "\n" .
			  '				  row_list_box_best_sellers.each(function(){' . "\n" .
			  '				  new equalHeights_box_best_sellers($(\'#\' + $(this).attr("id")));' . "\n" .
							  '});' . "\n" .			 			 			  			  			  			  			   
																												   
						'})' . "\n" .
			  '	</script>'. "\n".*/		
			  '<div class="infoBoxWrapper box5">' . "\n" .
			  '  	<div class="infoBoxHeading">' . tep_draw_box_title_top() . '<a href="' . tep_href_link(FILENAME_BESTSELLERS_PRODUCTS) . '">' . MODULE_BOXES_MULTY_BEST_SELLERS_BOX_TITLE . '</a>' . tep_draw_box_title_bottom() . '</div>' . "\n".
			  ' 	<div class="infoBoxContents">' . tep_draw_box_content_top() . '' . $best_sellers_list.'' . tep_draw_box_content_bottom() . '</div>' . "\n".
			//  ' 	<div class="bg_button2" onMouseOut="this.className=\'bg_button2\';" onMouseOver="this.className=\'bg_button2-act\';">' .tep_draw_button_top() . '<a href="'.tep_href_link(FILENAME_BESTSELLERS_PRODUCTS).'" id="tdb1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-carat-1-e"></span><span class="ui-button-text">'.  'See all' .'</span></a>' . tep_draw_button_bottom().'</div>' . "\n" .
			  ' </div>' . "\n";
			  
          $oscTemplate->addBlock($data, $this->group);
        }
    }
}
    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_MULTY_BEST_SELLERS_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Best Sellers Module', 'MODULE_BOXES_MULTY_BEST_SELLERS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_MULTY_BEST_SELLERS_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_MULTY_BEST_SELLERS_SORT_ORDER', '1040', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_MULTY_BEST_SELLERS_DISPLAY_PAGES', 'index.php', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_MULTY_BEST_SELLERS_STATUS', 'MODULE_BOXES_MULTY_BEST_SELLERS_CONTENT_PLACEMENT', 'MODULE_BOXES_MULTY_BEST_SELLERS_SORT_ORDER','MODULE_BOXES_MULTY_BEST_SELLERS_DISPLAY_PAGES');
    }
  }
?>
