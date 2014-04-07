<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/

  if (!isset($process)) $process = false;
?>
<table border="0" cellspacing="2" cellpadding="2" width="100%">
<?php
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = ($gender == 'f') ? true : false;
    } else {
      $male = false;
      $female = false;
    }
?>


	<tr>
	    <td class="main"><?php echo ENTRY_GENDER; ?></td>
	    <td class="main"><?php echo tep_draw_radio_field('gender', 'm', $male,'id="gender"') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female,'id="gender"') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
	  </tr>

<?php
  }
?>
  	<tr>
        <td class="fieldKey"><?php echo ENTRY_FIRST_NAME; ?></td>
        <td class="fieldValue"><?php echo tep_draw_input_field('firstname', '', 'id="firstname" onchange="validateString(\'firstname\')"') . '' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
      </tr>

      <tr> 
        <td class="fieldKey"><?php echo ENTRY_LAST_NAME; ?></td>
        <td class="fieldValue"><?php echo tep_draw_input_field('lastname', '', 'id="lastname" onchange="validateString(\'lastname\')"') . '' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
      </tr>
	</table>
</div>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
</div>
		  <!-- <h3><?php echo CATEGORY_COMPANY; ?></h3> -->
		
		<div style="clear: both;"></div>

		<div class="ui-widget infoBoxContainer" style="float:left; width: 100%;">

				<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo CATEGORY_COMPANY; ?></strong></div>

				<div class="ui-widget-content infoBoxContents ui-corner-bottom">

		  <div class="contentText">
		    <table border="0" cellspacing="2" cellpadding="2" width="100%">
		      <tr>
		        <td class="fieldKey"><?php echo ENTRY_COMPANY; ?></td>
		        <td class="fieldValue"><?php echo tep_draw_input_field('company','','id="company" onchange="validateString(\'company\')"') . '' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
		      </tr>
		    </table>
		  </div>
		</div>

<div style="clear: both;"></div>
  
<?php
  }
?>
</div>
</div>

<div style="clear: both;"></div>

<div class="ui-widget infoBoxContainer" style="float:left; width: 100%;">
	
		<div class="ui-widget-header infoBoxHeading ui-corner-top"><strong><?php echo CATEGORY_ADDRESS; ?></strong></div>

		<div class="ui-widget-content infoBoxContents ui-corner-bottom">
			
		  <div class="contentText">
		    <table border="0" cellspacing="2" cellpadding="2" width="100%">
		      <tr>
		        <td class="fieldKey"><?php echo ENTRY_STREET_ADDRESS; ?></td>
		        <td class="fieldValue"><?php echo tep_draw_input_field('street_address', '', 'id="street_address" onchange="validateString(\'street_address\')"') . '' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
		      </tr>

<?php
  if (ACCOUNT_SUBURB == 'true') {
?>

      
        <tr>
	        <td class="fieldKey"><?php echo ENTRY_SUBURB; ?></td>
	        <td class="fieldValue"><?php echo tep_draw_input_field('suburb', '', 'id="suburb" onchange="validateString(\'suburb\')"') . '' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
	      </tr>
			
<?php
  }
?>

	  
	    <tr>
	        <td class="fieldKey"><?php echo ENTRY_POST_CODE; ?></td>
	        <td class="fieldValue"><?php echo tep_draw_input_field('postcode','','id="postcode"') . '' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
	      </tr>
	      <tr>
	        <td class="fieldKey"><?php echo ENTRY_CITY; ?></td>
	        <td class="fieldValue"><?php echo tep_draw_input_field('city','','id="city" onchange="validateString(\'city\')"') . '' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
	      </tr>

<?php
  if (ACCOUNT_STATE == 'true') {
?>

      
        <tr>
	        <td class="fieldKey"><?php echo ENTRY_STATE; ?></td>
	        <td class="fieldValue">
<?php
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu('state', $zones_array);
      } else {
        echo tep_draw_input_field('state', '', 'id="state" onchange="validateString(\'state\')"');
      }
    } else {
      echo tep_draw_input_field('state', '', 'id="state" onchange="validateString(\'state\')"');
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) echo '<span class="inputRequirement">' . ENTRY_STATE_TEXT . '</span>'; ?></td>
  		</tr>
	
      
<?php
  }
?>

      
	    <tr>
	        <td class="fieldKey"><?php echo ENTRY_COUNTRY; ?></td>
	        <td class="fieldValue"><?php echo tep_get_country_list('country','','id="country"') . '' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
	      </tr>
	    </table>
	  </div>
	</div>
</div>