<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/
?>
                
<?php 
            if (($oscTemplate->hasBlocks('box_bottom_content_set')))	{
?>
				<?php echo $oscTemplate->getBlocks('box_bottom_content_set'); ?>
<?php
			}
						if	($current_page == FILENAME_DEFAULT)	{
						echo tep_draw_content_bottom();
						}
?>

</div>
			 <!-- bodyContent //-->
           
<?php
  if (($oscTemplate->hasBlocks('boxes_column_left')) || ( file_exists(DIR_WS_MODULES.'cat_navbar.php'))) {
?>
                <div id="columnLeft" class="grid_<?php echo $oscTemplate->getGridColumnWidth(); ?> <?php echo ($oscTemplate->hasBlocks('boxes_column_left') ? 'pull_' . $oscTemplate->getGridContentWidth() : ''); ?>">
                  <div>
									<?php echo $oscTemplate->getBlocks('boxes_column_left'); ?></div>
                </div>
<?php 
}
?>

<?php
  if ($oscTemplate->hasBlocks('boxes_column_right')) {
?>

                <div id="columnRight" class="grid_<?php echo $oscTemplate->getGridColumnWidth(); ?>">
                  <div><?php echo $oscTemplate->getBlocks('boxes_column_right'); ?></div>
                </div>

<?php
  }
?>
    		


    		
    	</div>
        
<?php 
            if (($oscTemplate->hasBlocks('boxes_above_footer')))	{
?>
    <div class="row_7">
            <div class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?>"> 
                  <div class="grid_<?php echo $oscTemplate->getGridContainerWidth(); ?>">
				<?php echo $oscTemplate->getBlocks('boxes_above_footer'); ?>
            	</div>
     			 </div>
    </div>                
<?php
			}
?>
            
                  
       
    
    
		<a class="logo" href="<?php echo tep_href_link(FILENAME_DEFAULT);?>"><?php echo tep_image(DIR_WS_IMAGES.'store_logo.png', STORE_NAME, '', '', '')?></a> 

	<!--	 bodyWrapper //-->
    	<div class="row_5">     
        	<div class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?>"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
       </div>
</div></div></div>
<?php echo $oscTemplate->getBlocks('footer_scripts'); ?>
</body>
<!--[if lt IE 9]>
  <link href="css/ie_style.css" rel="stylesheet" type="text/css" />
<![endif]-->
  <script type="text/javascript" src="ext/js/imagepreloader.js"></script>
  <script type="text/javascript">
		preloadImages([
			'images/user_menu.gif',
			'images/div_cat_navbar.jpg',
			'images/marker_bg.png',
			'images/wrapper_pic.png',
			'images/wrapper_pic-act.png',
			'images/wrapper_pic_border.gif',
			'images/wrapper_pic_border-act.gif']);
	</script>
</html>
