<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class cm_multy_specials {
    var $code = 'cm_multy_specials';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;
    var $pages;	

    function cm_multy_specials() {
			global $current_page;
      $this->title = MODULE_BOXES_MULTY_SPECIALS_TITLE;
      $this->description = MODULE_BOXES_MULTY_SPECIALS_DESCRIPTION;

      if ( defined('MODULE_BOXES_MULTY_SPECIALS_STATUS') ) {
        $this->sort_order = MODULE_BOXES_MULTY_SPECIALS_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_MULTY_SPECIALS_STATUS == 'True');
				$this->pages = MODULE_BOXES_MULTY_SPECIALS_DISPLAY_PAGES;
	//			if ($current_page == FILENAME_DEFAULT)	{
				$this->group = ((MODULE_BOXES_MULTY_SPECIALS_CONTENT_PLACEMENT == 'Content Top Set Block') ? 'box_top_content_set' : 'box_bottom_content_set');
	//			}else{
  //      $this->group = ((MODULE_BOXES_MULTY_SPECIALS_CONTENT_PLACEMENT == 'Right Column') ? 'boxes_column_left' : 'boxes_column_right');
	//			}
      }
    }

    function execute() {
      global $HTTP_GET_VARS, $languages_id, $currencies, $oscTemplate;

      if (!isset($HTTP_GET_VARS['products_id'])) {
	  $col_specials = 0;
	  $row_specials = 0;
	  $col_items_specials = (BOX_MULTY_SPECIALS_PER_ROW - 1);

  		$specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added DESC";
  		$specials_split = new splitPageResults($specials_query_raw, BOX_MULTY_SPECIALS_PRODUCTS_MAX_DISPLAY);


		$specials_query = tep_db_query($specials_split->sql_query);
			while ($specials = tep_db_fetch_array($specials_query)) {
				  $specials_list .= '';
			
				if (($col_specials === 0) && ($row_specials != 0)) {
				  $specials_list .= '';
				} 
				if ($col_specials === 0) {
				  $specials_list .= '<ul class="specials" id="specials-'.$row_specials.'">';
			   }else {
	   			  $specials_list .= ''; 
			   }
		
				$product_query = tep_db_query("select products_description, products_id from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$specials['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
				$product = tep_db_fetch_array($product_query);
				$p_id = $product['products_id'];		
/* ********************************* */			 
				
				if	(BOX_MULTY_SPECIALS_SHOW_NAME == 'true')	{
					$name_prod = '<div class="name name_padd equal-height-box_specials"><span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id='.$p_id) . '">' . $specials['products_name'] . '</a></span></div>';				
				}else{
					$name_prod = '';	
				}
				if	(BOX_MULTY_SPECIALS_SHOW_PIC == 'true')	{
					$pic_prod = '<div class="pic_padd wrapper_pic_div" style="width:'.(BOX_MULTY_SPECIALS_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(BOX_MULTY_SPECIALS_IMAGE_HEIGHT + PIC_MARG_H).'px;"><a class="prods_pic_bg" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id='.$p_id) . '" style="width:'.(BOX_MULTY_SPECIALS_IMAGE_WIDTH + PIC_MARG_W).'px;height:'.(BOX_MULTY_SPECIALS_IMAGE_HEIGHT + PIC_MARG_H).'px;">' . tep_image(DIR_WS_IMAGES . $specials['products_image'], $specials['products_name'], (BOX_MULTY_SPECIALS_IMAGE_WIDTH), (BOX_MULTY_SPECIALS_IMAGE_HEIGHT), ' style="width:'.(BOX_MULTY_SPECIALS_IMAGE_WIDTH + PIC_MARG_W2).'px;height:'.(BOX_MULTY_SPECIALS_IMAGE_HEIGHT + PIC_MARG_H2).'px;margin:'.PIC_MARG_T.'px '.PIC_MARG_R.'px '.PIC_MARG_B.'px '.PIC_MARG_L.'px;"').''.tep_draw_box_multy_specials_pic_top().''.tep_draw_box_multy_specials_pic_bottom().'</a></div>';				
				}else{
					$pic_prod = '';	
				}
				if	(BOX_MULTY_SPECIALS_SHOW_PRICE == 'true')	{
					$sp_price_1 = '<span class="productSpecialPrice">' . $currencies->display_price($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])).'</span>';
					$sp_price_2 = '<del>' . $currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</del>';
					$sp_price = '<div class="price price_padd"><b>'.PRICE. '</b>'.$sp_price_1.'&nbsp;&nbsp; '.$sp_price_2.'</div>';				
				}else{
					$sp_price = '';	
				}
				if	(BOX_MULTY_SPECIALS_SHOW_BUY == 'true')	{
					$p_buy_now_text = '<div class="button__padd"><div class="bg_button2" onMouseOut="this.className=\'bg_button2\';" onMouseOver="this.className=\'bg_button2-act\';">' .tep_draw_button2_top() . '<a href="'.tep_href_link("products_new.php","action=buy_now&products_id=".$p_id).'" id="tdb1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span><span class="ui-button-text">'.  IMAGE_BUTTON_IN_CART .'</span></a>' . tep_draw_button2_bottom().'</div></div>'. "\n";				
				}else{
					$p_buy_now_text = '';	
				}
				

				if	(BOX_MULTY_SPECIALS_MAX_DESCR != 0)	{
					$p_desc =  '<div class="desc desc_padd top">'.mb_substr(strip_tags($product['products_description']), 0, BOX_MULTY_SPECIALS_MAX_DESCR, 'UTF-8').'...</div>';
				}else{
					$p_desc = '';	
				}
				
			
				$p_details_text = '<div class="bg_button22" onMouseOut="this.className=\'bg_button22\';" onMouseOver="this.className=\'bg_button22-act\';">' .tep_draw_button_top() . '<a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '" id="tdb1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text">'.  IMAGE_BUTTON_DETAILS .'</span></a>' . tep_draw_button_bottom().'</div>'. "\n";

    						
/* ********************************* */	         
				$specials_list .= 
				  '<li style="width:'.(BOX_MULTY_SPECIALS_WIDTH).'px;" class="wrapper_prods hover ">'. "\n".
					
				  '		<div class="border_prods">'. "\n".
					'			'.$pic_prod.''. "\n". //
				  '			<div class="prods_padd">'.				  				  	 
				  '		  '.$p_buy_now_text.''. "\n".
				  '			'.$name_prod.''. "\n".
          '			'.$p_desc.''. "\n".					
					'			'.$sp_price.''. "\n".				  		
				  '			</div>'. "\n".				  
				  '		</div>'. "\n";

			
				if ($col_specials >= $col_items_specials) {
					$specials_list .= '</ul>'. "\n";
					$row_specials ++;
					$col_specials = 0;
				}else{
					$specials_list .= '</li>'. "\n";
					$col_specials ++;	
				}
				
			}

				
		$data =
			  '	<script type="text/javascript">' . "\n" .
			  '			$(document).ready(function(){' . "\n" . 			
			  '				 var row_list_box_specials = $(\'.specials\');' . "\n" .
			  '				  row_list_box_specials.each(function(){' . "\n" .
			  '				  new equalHeights_box_specials($(\'#\' + $(this).attr("id")));' . "\n" .
							  '});' . "\n" .			 			 			  			  			  			  			   
						'})' . "\n" .
			  '	</script>'. "\n".		
			  '<div>' . "\n" .
			  '  	' . tep_draw_title_top() . '<h1><a href="' . tep_href_link(FILENAME_SPECIALS) . '">' . MODULE_BOXES_MULTY_SPECIALS_BOX_TITLE . '</a></h1>' . tep_draw_title_bottom() . '' . "\n".
			  ' 	<div class="contentContainer page_un">
  						<div class="contentPadd"><div class="prods_content prods_table">' . $specials_list.'</div></div>' . "\n".
			//  ' 	<div class="bg_button2" onMouseOut="this.className=\'bg_button2\';" onMouseOver="this.className=\'bg_button2-act\';">' .tep_draw_button_top() . '<a href="'.tep_href_link(FILENAME_SPECIALS).'" id="tdb1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-carat-1-e"></span><span class="ui-button-text">'.  'See all' .'</span></a>' . tep_draw_button_bottom().'</div>' . "\n" .
			  '		</div></div>' . "\n";
			   


		$oscTemplate->addBlock($data, $this->group);
		  
        }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_MULTY_SPECIALS_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Little at Once Products Specials Module', 'MODULE_BOXES_MULTY_SPECIALS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_MULTY_SPECIALS_CONTENT_PLACEMENT', 'Content Bottom Set Block', 'The module should be loaded in the Content Top Set Block or Content Bottom Set Block only', '6', '1', 'tep_cfg_select_option(array(\'Content Top Set Block\', \'Content Bottom Set Block\'), ', now()), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_MULTY_SPECIALS_SORT_ORDER', '8080', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display in pages.', 'MODULE_BOXES_MULTY_SPECIALS_DISPLAY_PAGES', 'index.php', 'select pages where this box should be displayed. ', '6', '0','tep_cfg_select_pages(' , now())");	  
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_MULTY_SPECIALS_STATUS', 'MODULE_BOXES_MULTY_SPECIALS_CONTENT_PLACEMENT', 'MODULE_BOXES_MULTY_SPECIALS_SORT_ORDER', 'MODULE_BOXES_MULTY_SPECIALS_DISPLAY_PAGES');
    }
  }
?>
