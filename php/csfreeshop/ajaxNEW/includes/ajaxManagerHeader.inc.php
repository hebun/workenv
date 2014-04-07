<?php
/*
  AJAX Checkout for OsCommerce

  Advance Software


  Copyright (c) 2007 Advance Software

*/

$amSessionVar = tep_session_name().'='.tep_session_id();
if (!isset($_GET['pID']))
	$_GET['pID'] = '';
if (!isset($_GET['action']))
	$_GET['action'] = '';
echo <<<HEADER
<script language="JavaScript" type="text/JavaScript">
	var productsId='{$_GET['pID']}';
	var pageAction='{$_GET['action']}';
	var sessionId='{$amSessionVar}';
</script>
<script language="JavaScript" type="text/JavaScript" src="ajax/javascript/requester.js?1100"></script>
<script language="JavaScript" type="text/JavaScript" src="ajax/javascript/ajaxManager.js?1100"></script>
<script type='text/javascript' src='ajax/javascript/bootstrap.js?1100'></script>
<link rel="stylesheet" type="text/css" href="ajax/css/ajaxManager.css?1100" />
<link type='text/css' href='ajax/css/bootstrap.css?1100' rel='stylesheet' />
HEADER;
?>
<script language="JavaScript" type="text/javascript">

function goOnLoad() {
        ajaxManagerInit();

        document.addEventListener("DOMNodeInserted", function(event){
          var element = event.target;

          if (element.tagName == 'DIV') {
            if (element.id == 'agreeForm') {
                        if (getElement('buttonSelectShipping') == null) {
                                $("#agreeForm").fadeIn(600);
                        }
            }
          }

		$('body').on('click', '#TermsAgreeCreateAcc', function(){
			if($("#TermsAgreeCreateAcc").prop("checked")){
				$("#TheDisabledButtonCreateAcc").fadeOut(300).hide();
				$("#TheSubmitButtonCreateAcc").fadeIn(600);
			} else {
				$("#TheSubmitButtonCreateAcc").fadeOut(300).hide();
				$("#TheDisabledButtonCreateAcc").fadeIn(600);
			}
		});
		
		$('body').on('click', '#TermsAgree', function(){
			if($("#TermsAgree").prop("checked")){
				$("#TheDisabledButton").fadeOut(300).hide();
				$("#TheSubmitButton").fadeIn(600);
			} else {
				$("#TheSubmitButton").fadeOut(300).hide();
				$("#TheDisabledButton").fadeIn(600);
			}
		});
		
		$('#dob').datepicker({dateFormat: '<?php echo JQUERY_DATEPICKER_FORMAT; ?>', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
		
        });
}
</script>