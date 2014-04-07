<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/

require_once('ajax/classes/ajaxManagerConfig.class.php');
require_once('ajax/classes/stopDirectAccess.class.php');
$stopDirectAccess = new stopDirectAccess();
$stopDirectAccess->authorise(AM_SESSION_VALID_INCLUDE);
// stopDirectAccess::authorise(AM_SESSION_VALID_INCLUDE);
?>
<div id="ajaxManager">
</div>