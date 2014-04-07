/*
AJAX Checkout for OsCommerce

Advance Software 


Copyright (c) 2007 Advance Software

*/

var placeHolderDiv;
var url = 'ajax/ajaxManager.php';
var ajaxRequester = new Requester();

function ajaxManagerInit() {
	if(ajaxRequester.isAvailable()) 
	ajaxRefresh(true);
	return(false);
}

function getElement(id) {
	return document.getElementById(id);
	return(false);
}

function getDropDownValue(id) {
	return getElement(id).value;
	return(false);
}

function getValue(id) {
	return getElement(id).value;
	return(false);
}

//------------------------------------------------------------------<< Common Stuff
function ajaxSendRequest(requestString,functionName, refresh, target, async) {

	var arRequestString = new Array;
	var url = 'ajax/ajaxManager.php';

	if('' != requestString)
	arRequestString.push(requestString);

	if('' != productsId) 
	arRequestString.push('products_id='+productsId);

	if('' != pageAction)
	arRequestString.push('pageAction='+pageAction);

	if('' != sessionId)
	arRequestString.push(sessionId);

	if(refresh == false) 
	ajaxRequester.setAction(ajaxEmpty);	
	else 
	ajaxRequester.setAction((((null == functionName) || ('' == functionName)) ? ajaxUpdateContent : functionName));

	if(null == target) {
		ajaxRequester.setTarget('ajaxManager');
	}
	else {
		ajaxRequester.setTarget(target);
		arRequestString.push('target='+target);
	}


	//show loading..

	if (target == null)
	var objBody = document.getElementById('ajaxManager');
	else
	var objBody = document.getElementById(target);

	var objOverlay = document.createElement("div");
	objOverlay.setAttribute('id','overlay');

	objOverlay.style.position = 'absolute';
	objOverlay.style.textAlign = 'center';
	objOverlay.style.verticalAlign = 'middle';
	objOverlay.style.width = objBody.clientWidth;
	objOverlay.style.height = objBody.clientHeight;

	objBody.insertBefore(objOverlay, objBody.firstChild);
  objOverlay.style.display = 'block';
  document.getElementById("overlay").innerHTML = '<table border=0 width=100% height=100%><tr><td align="center"><img src="images/loading.gif"></td></tr></table>';

  //eof show loading

if (getElement('buttonChangeShippingAddress') != null) getElement('buttonChangeShippingAddress').disabled = true;
if (getElement('buttonChangePaymentAddress') != null) getElement('buttonChangePaymentAddress').disabled = true;
if (getElement('buttonSelectPayment') != null) getElement('buttonSelectPayment').disabled = true;
if (getElement('buttonSelectShipping') != null) getElement('buttonSelectShipping').disabled = true; 
if (getElement('buttonSelectPaymentAddress') != null) getElement('buttonSelectPaymentAddress').disabled = true;
if (getElement('buttonSelectShippingAddress') != null) getElement('buttonSelectShippingAddress').disabled = true;
if (getElement('buttonPlaceOrder') != null) getElement('buttonPlaceOrder').disabled = true;


requestString = arRequestString.join('&');
ajaxRequester.loadURL(url, requestString, async);

return false;
}

function ajaxEmpty(){}

function ajaxReportError(request) {
	alert('Sorry. There was an error.');
	return(false);
}

function ajaxRefresh(bolFirstCall) {
	var rString = (!bolFirstCall) ? 'ajaxAction=refresh' : '';
	ajaxSendRequest(rString);
	return false;
}

function ajaxUpdateContent(id) {
	getElement(ajaxRequester.getTarget()).innerHTML = ajaxRequester.getText();

	if (getElement('buttonChangeShippingAddress') != null) getElement('buttonChangeShippingAddress').disabled = false;
	if (getElement('buttonChangePaymentAddress') != null) getElement('buttonChangePaymentAddress').disabled = false;
	if (getElement('buttonSelectPayment') != null) getElement('buttonSelectPayment').disabled = false;
	if (getElement('buttonSelectShipping') != null) getElement('buttonSelectShipping').disabled = false;

	if (getElement('buttonSelectPaymentAddress') != null) getElement('buttonSelectPaymentAddress').disabled = false;
	if (getElement('buttonSelectShippingAddress') != null) getElement('buttonSelectShippingAddress').disabled = false;
	if (getElement('buttonPlaceOrder') != null) getElement('buttonPlaceOrder').disabled = false;
	
	return(false);

}

function ajaxUpdateContentMulti(id) {
	var result = ajaxRequester.getText();

	//split string with </divresult> word
	arr = result.split('</divresult>');	

	for (i=0; i<arr.length; i++) {
		try {
			//get div name
			regexp = /<divresult name=\"(\w+)\">/;
			var divelement = arr[i].match(regexp)[1];
			//get div content
			var divresult = arr[i].replace(regexp,"") ;
			getElement(divelement).innerHTML = divresult;  
		}
		catch (error) {}    
	}

	if (getElement('buttonChangeShippingAddress') != null) getElement('buttonChangeShippingAddress').disabled = false;
	if (getElement('buttonChangePaymentAddress') = null) getElement('buttonChangePaymentAddress').disabled = false;
	if (getElement('buttonSelectPayment') != null) getElement('buttonSelectPayment').disabled = false;
	if (getElement('buttonSelectShipping') != null) getElement('buttonSelectShipping').disabled = false;

	if (getElement('buttonSelectPaymentAddress') != null) getElement('buttonSelectPaymentAddress').disabled = false;
	if (getElement('buttonSelectShippingAddress') != null) getElement('buttonSelectShippingAddress').disabled = false;
	if (getElement('buttonPlaceOrder') != null) getElement('buttonPlaceOrder').disabled = false;
	
	return(false);

}

//------------------------------------------------------------------<< page Actions
function ajaxRefreshShipping(async) {
	ajaxSendRequest('ajaxAction=showShipping',ajaxUpdateContentMulti,true,'shipping_area', async);
	return false;
}

function ajaxRefreshPayment(async) {
	ajaxSendRequest('ajaxAction=showPayment',ajaxUpdateContentMulti,true,'payment_area', async);
	return false;
}

function ajaxRefreshProducts(async) {
	ajaxSendRequest('ajaxAction=showProducts','',true,'products_area', false, async);
	return false;
}

function ajaxRefreshTotals(async) {
	ajaxSendRequest('ajaxAction=showTotals','',true,'totals_area', async);
	return false;
}

function ajaxSetInterfaceLanguage(languageId) {
	ajaxSendRequest('ajaxAction=setInterfaceLanguage&language_id='+languageId);
	return false;
}

function ajaxSetSession() {
	var session_var = getValue('session_var');
	ajaxSendRequest('ajaxAction=createSession&session_var='+session_var,'',true,'test_div');
	return false;
}

function ajaxShowChangeAddress()
{
	$("#TheSubmitButton").hide();
	$("#TheDisabledButton").hide();
	ajaxSendRequest('ajaxAction=showChangeAddress','',true,'shipping_area');
	return false;
}

function ajaxShowChangePaymentAddress()
{
	ajaxSendRequest('ajaxAction=showChangePaymentAddress','',true,'payment_area');
	return false;
}

function ajaxPerformLogin() {
	var login_email_address = getValue('login_email_address');
	var login_password = getValue('login_password');
	ajaxSendRequest('ajaxAction=PerformLogin&email_address='+login_email_address+'&password='+login_password,ajaxUpdateContentMulti,true,'payment_area', false);
	location.reload();
	return false;
}

function ajaxPerformPlaceOrder() {
	ajaxSendRequest('ajaxAction=PerformPlaceOrder',ajaxUpdateContentMulti,true,'placeorder_area');
	return(false);
}

function ajaxPerformShippingSelection() {
	submitted = false;
	if (getElement('buttonSelectPayment') == null) {
		$("#agreeForm").fadeIn(600);
	}
	if (getElement('shipping_'+selected_shipping) != null) 
	{
		var shipping  = getValue('shipping_'+selected_shipping);
	}
	else
	{
		var shipping = getValue('shipping');
	}
	ajaxSendRequest('ajaxAction=PerformShippingSelection&shipping='+shipping,ajaxUpdateContentMulti,true,'shipping_area');
	return false;

}


function ajaxPerformPaymentSelection() {
	submitted = false;
	
	if (getElement('buttonSelectPayment') == null || getElement('buttonSelectShipping') == null) {
		$("#agreeForm").fadeIn(300);
	}
	additional_fields = '';
	if (selected_payment >= 0)
	{
		var payment = getValue('payment_'+selected_payment);
	}
	else
	{
		var payment = getValue('payment');
	}

	if (check_form() == true)
	{
		ajaxSendRequest('ajaxAction=PerformPaymentSelection&payment='+payment+additional_fields,ajaxUpdateContentMulti,true,'payment_area');
	}
	else return false;

	return false;

}

function ajaxPerformCreateAccount()
{ 
	submitted = false;
	if (check_create_account()==true)
	{ 

		var email_address = getValue('email_address');
		if (getElement('gender') != null) var gender  = getValue('gender');
		var firstname  = getValue('firstname');
		var lastname   = getValue('lastname');
		if (getElement('dob') != null) var dob = getValue('dob');
		if (getElement('company') != null) var company   = getValue('company');
		var street_address = getValue('street_address');
		if (getElement('suburb') != null) var suburb  = getValue('suburb');
		var postcode = getValue('postcode');
		var city  = getValue('city');
		if (getElement('state') != null) var state  = getValue('state');
		var country  = getValue('country');
		var telephone  = getValue('telephone');
		var fax  = getValue('fax');
		var newsletter  = getValue('newsletter');
		var password = getValue('password');
		var confirmation = getValue('confirmation');

		ajaxSendRequest('ajaxAction=PerformCreateAccount'
		+'&email_address='+email_address
		+'&gender='+gender
		+'&firstname='+firstname
		+'&lastname='+lastname
		+'&dob='+dob
		+'&company='+company
		+'&street_address='+street_address
		+'&suburb='+suburb
		+'&postcode='+postcode
		+'&city='+city
		+'&state='+state
		+'&country='+country
		+'&telephone='+telephone
		+'&fax='+fax
		+'&newsletter='+newsletter
		+'&password='+password
		+'&confirmation='+confirmation
		//);
		, ajaxUpdateContentMulti, true, 'shipping_area', false);
		location.reload();
		} else	return false;

	}

	function ajaxPerformShippingAddress()
	{ 
		submitted = false;

		if (getElement('gender') != null) var gender  = getValue('gender');
		if (getElement('firstname') != null) var firstname  = getValue('firstname');
		if (getElement('lastname') != null) var lastname   = getValue('lastname');
		if (getElement('company') != null) var company   = getValue('company');
		if (getElement('street_address') != null) var street_address = getValue('street_address');
		if (getElement('suburb') != null) var suburb  = getValue('suburb');
		if (getElement('postcode') != null) var postcode = getValue('postcode');
		if (getElement('city') != null) var city  = getValue('city');
		if (getElement('state') != null) var state  = getValue('state');
		if (getElement('country') != null) var country  = getValue('country');

		if (firstname!= null && lastname!=null && street_address!=null && firstname!='' && lastname!='' && street_address!='')
		{
			if (check_form_address()==true)
			{ 
				ajaxSendRequest('ajaxAction=PerformShippingAddress'
				+'&gender='+gender
				+'&firstname='+firstname
				+'&lastname='+lastname
				+'&company='+company
				+'&street_address='+street_address
				+'&suburb='+suburb
				+'&postcode='+postcode
				+'&city='+city
				+'&state='+state
				+'&country='+country
				//);
				,ajaxUpdateContentMulti,true,'shipping_area');
			}
			else return false;

		}
		else
		{

			if (getElement('address_'+selected_address) != null) var address  = getValue('address_'+selected_address);

			ajaxSendRequest('ajaxAction=PerformShippingAddressSelection'
			+'&address='+address
			,ajaxUpdateContentMulti,true,'shipping_area');

		}
		
		return(false);
	}

	function ajaxPerformPaymentAddress()
	{ 
		submitted = false;

		if (getElement('gender') != null) var gender  = getValue('gender');
		if (getElement('firstname') != null) var firstname  = getValue('firstname');
		if (getElement('lastname') != null) var lastname   = getValue('lastname');
		if (getElement('company') != null) var company   = getValue('company');
		if (getElement('street_address') != null) var street_address = getValue('street_address');
		if (getElement('suburb') != null) var suburb  = getValue('suburb');
		if (getElement('postcode') != null) var postcode = getValue('postcode');
		if (getElement('city') != null) var city  = getValue('city');
		if (getElement('state') != null) var state  = getValue('state');
		if (getElement('country') != null) var country  = getValue('country');

		if (firstname!= null && lastname!=null && street_address!=null && firstname!='' && lastname!='' && street_address!='')
		{
			if (check_form_address()==true)
			{ 
				ajaxSendRequest('ajaxAction=PerformPaymentAddress'
				+'&gender='+gender
				+'&firstname='+firstname
				+'&lastname='+lastname
				+'&company='+company
				+'&street_address='+street_address
				+'&suburb='+suburb
				+'&postcode='+postcode
				+'&city='+city
				+'&state='+state
				+'&country='+country
				//);
				,ajaxUpdateContentMulti,true,'payment_area');
			}
			else return false;

		}
		else
		{

			if (getElement('payment_address_'+selected_payment_address) != null) var address  = getValue('payment_address_'+selected_payment_address);

			ajaxSendRequest('ajaxAction=PerformPaymentAddressSelection'
			+'&address='+address
			,ajaxUpdateContentMulti,true,'payment_area');

		}
		
		return(false);
	}

function check_agree(title, text) {
	if ($("#TermsAgree").prop("checked")){
		$("#TheSubmitButton").hide();
		$('#order_submitted').fadeIn(300);
		if (getElement('comments') != null) var comments = getValue('comments');

		ajaxSendRequest('ajaxAction=PerformPlaceOrder'+'&comments='+comments,ajaxUpdateContentMulti,true,'placeorder_area');
	} else {
		return $("<div class='dialog' title='" + title + "'><p>" + text + "</p></div>")
		.dialog({
			resizable: false,
			modal: true,
			draggable: false,
			open: function(event, ui) {
			    $(this).parent()
					.css('position', 'fixed')
					.css('top', '30%');
				$(this).parents(".ui-dialog:first").find(".ui-icon-closethick")
					.css('top', '0')
					.css('left', '0');
			},
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	}
	
	return(false);
}

function check_agree_create(title, text) {

	return $("<div class='dialog' title='" + title + "'><p>" + text + "</p></div>")
	.dialog({
		resizable: false,
		modal: true,
		draggable: false,
		open: function(event, ui) {
		    $(this).parent()
				.css('position', 'fixed')
				.css('top', '30%');
			$(this).parents(".ui-dialog:first").find(".ui-icon-closethick")
				.css('top', '0')
				.css('left', '0');

		},
		buttons: {
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
	
	return(false);
}

	function formatString(string)
	{
		if (/^[a-ö].+$/.test(string))
		var string = string.charAt(0).toUpperCase() + string.slice(1);
		return string;
		
		return(false);
	}

	function validateString(name) {
		if(name == 'firstname') {
			document.getElementById("firstname").value = 
			formatString(document.getElementById("firstname").value) + "\n";
		}

		if(name == 'lastname') {
			document.getElementById("lastname").value = 
			formatString(document.getElementById("lastname").value) + "\n";
		}

		if(name == 'company') {
			document.getElementById("company").value = 
			formatString(document.getElementById("company").value) + "\n";
		}

		if(name == 'street_address') {
			document.getElementById("street_address").value = 
			formatString(document.getElementById("street_address").value) + "\n";
		}

		if(name == 'suburb') {
			document.getElementById("suburb").value = 
			formatString(document.getElementById("suburb").value) + "\n";
		}

		if(name == 'city') {
			document.getElementById("city").value = 
			formatString(document.getElementById("city").value) + "\n";
		}

		if(name == 'state') {
			document.getElementById("state").value = 
			formatString(document.getElementById("state").value) + "\n";
		}
		
		return(false);
	}

	function update_cart()
	{	
		$.ajax({
			type: 'GET',
			url: encodeURI($('form[name=boxcart_quantity]').attr('action')) + '&count_contents=1&ajax=1',
			data: $('form').serialize(),
			async: false,
			success: function(data) {
				$('#headercart').html(data);
			}
		});
		return(false);
	}
	
	
	function ajaxPerformShippingRefresh() {
		submitted = false;
		var orderTotalNewValue = parseFloat(getValue('orderTotalNewValue'));
		var orderTotalOldValue = parseFloat(getValue('orderTotalOldValue'));


		if (getElement('shippingselected') != null) 
		{
			var shipping = getValue('shippingselected');

			if (getElement('freeShippingOver') != null) {
				var freeShippingOver =  parseFloat(getValue('freeShippingOver'));
				if (orderTotalOldValue > freeShippingOver && orderTotalNewValue < freeShippingOver) {
					ajaxSendRequest('ajaxAction=showShipping',ajaxUpdateContentMulti,true,'shipping_area', false);
					ajaxRefreshTotals();

				} else if ( orderTotalNewValue > freeShippingOver ) {			
					ajaxSendRequest('ajaxAction=PerformShippingSelection&shipping=free_free',ajaxUpdateContentMulti,true,'shipping_area');
				} else {
					ajaxSendRequest('ajaxAction=PerformShippingSelection&shipping='+shipping,ajaxUpdateContentMulti,true,'totals_area');
				}

			} else {
				ajaxSendRequest('ajaxAction=PerformShippingSelection&shipping='+shipping,ajaxUpdateContentMulti,true,'totals_area');
			}	
		} else {
			ajaxRefreshShipping(false);
			ajaxRefreshTotals();
		}
		return false;
	}
	
	// Update infobox total using the accounting.js library
	// http://josscrowcroft.github.io/accounting.js/
	function update_total(total, total_new, diff)
	{

		var total = parseFloat(total) ;

		if (typeof total == 'undefined') {
			total = parseFloat(0.00) ;
		}

		if (typeof total_new == 'undefined') {
			var total_new = $(document.getElementById('boxcart-total')).html() ;

			if (typeof total_new == 'string') {
				total_goal = total_new ;
			}

			var total_new = accounting.toFixed(total_new, 2);
			var diff = total_new - total ;

		}

		var total_float = total ;
		total_float = total_float.toFixed(2) ;

		if (symbol_left != '') {
			currency_symbol = symbol_left ;
			currency_format = "%s%v" ;
		} else if (symbol_right != '') {
			currency_symbol = symbol_right ;
			currency_format = "%v%s" ;
		}

		if (typeof currency_symbol == 'undefined')
		currency_symbol = '' ;

		total_float = accounting.formatMoney(total_float, currency_symbol, decimal_places, thousands_point, decimal_point, currency_format) ;
		$("#span_cart_box").find('div[class=boxcartTotal]')
			.find('span[id=boxcart-total]').remove() ;
		$("#span_cart_box").find('div[class=boxcartTotal]')
			.find('span').append( '<span id="boxcart-total">' + total_float + '</span>' ) ;

		setTimeout(function () {
			total = total + (diff / 10) ;

			if (total < total_new && diff > 0.0) {

				update_total(total, total_new, diff);
				return(false);
				
			} else if (total > total_new && diff < 0.0) {
				
				update_total(total, total_new, diff);
				return(false);
				
			} else if (Number((total - diff / 10).toFixed(0)) == 0 || Number((total).toFixed(0)) == 0) {

				$(".boxcartTotal").hide();
				$('#boxcart-content').html('<li style="font-size:11px; float:right;">' + $('#boxcart-text-empty').html() + '</li>') ;
				return(false) ;

			} else {
				$("#span_cart_box").find('div[class=boxcartTotal]').find('span[id=boxcart-total]').hide() ;
				$("#span_cart_box").find('div[class=boxcartTotal]').find('span').append( '<span id="boxcart-total">' + total_goal + '</span>' ) ;
				return(false) ;	
					
			}

		}, 100);

		return(false);
	}

	// Remove from cart
	//
	function cartremove(products_id) 
	{

		$('input[value="' + products_id + '"][name=\"cart_delete[]\"]').attr('checked', true) ;

		var productsInCart = parseInt( $("#content-body input[name=products_in_cart]").val() ) ;

		// If this is the last product in cart then refresh the entire page
		//
		if ( productsInCart <= 1 ) 
		{
			$('form[name=cart_quantity]').submit(); 
		}
		
		// Get the order total from the infobox before new product is added
		//
		var total = $(document.getElementById('boxcart-total')).html() ;
		var total = total.replace(/[^0-9.]/g, '') ;
		var total = parseFloat(total) ;
		

		$.ajax({
			type: 'POST',
			url: encodeURI($('form[name=cart_quantity]').attr('action')) + '&ajax=1',
			data: $('form[name=cart_quantity]').serialize(),
			async:false,
			success: function(data) {
				ajaxRefreshProducts();
				update_cart();
			},
			dataType: 'html'
		});

		$.ajax({
			type: 'GET',
			url: encodeURI($('form[name=cart_quantity]').attr('action')) + '&show_total=1&ajax=1', 
			data: $('form').serialize(),
			success: function(data) {
				$('#boxcart-total').html(data);
				update_total(total);
			}
		});
		
		ajaxPerformShippingRefresh();
		
		//Clone the old image for use in animation
		var $oldcart =  $('#boxcart-content');
		var $tempcart = $oldcart.clone().prependTo($('#boxcart-content').parent('form'));
		var $newcart = $oldcart.clone().prependTo($('#boxcart-content').parent('form'));
		
		$tempcart.find('li')
			.removeAttr('id');
			
		$newcart.hide();
		$oldcart.hide();


		$newcart.find($(document.getElementById('pc-' + products_id))).remove() ;

		// Product count 
		//
		count = $('li[id^="pc-"]').size() ;

		if ( count == 0 ) {
			$(".boxcartTotal").hide();
			
		}
		
		var newWidth = $tempcart.width();

		$newcart.hide();
		
		$tempcart
		.animate( {
			width: newWidth, // Resize image width on animation
			height: $newcart.height() // Resize image height on animation
			}, 500, function(){ // Value is total time for animation to finish

				$('#boxcart-content').html('<li style="font-size:11px; float:right;">' + $('#boxcart-text-empty').html() + '</li>') ;
				// Callback function, we append new product and
				// remove $newcart and $tempcart
				$oldcart.find($(document.getElementById('pc-' + products_id))).remove();
				$oldcart.show();

				$newcart.remove();
				$tempcart.remove();

		});
		
		return(false);
	}

	// Plus or Minus function
	//
	function updateqty(action, products_id) {
		//  products_id = $('div[id=content-body]').find('span').attr('rel');

		val = parseInt( $('input[id="pl' + products_id + '"][name=\"cart_quantity[]\"]').val() ) ;

		if ( action  == 'plus' ) 
		{
			val = val + 1 ;
		}
		else if ( action == 'moins' )
		{
			if ( val <= 0 ) return(false) ;
			val = val - 1 ;
		} 
		else
		{
			return(false) ;
		}

		var productsInCart = parseInt( $("#content-body input[name=products_in_cart]").val() ) ;

		// If this is the last product in cart then refresh the entire page

		if ( productsInCart == 1 && val == 0) 
		{
			$('form[name=cart_quantity]').submit();
		}

		$(document.getElementById('pl' + products_id)).val(val);


		// Delete button in shopping cart infobox
		// 
		new_button = $('#boxcart-button-remove').clone() ;
		new_button.find('button').attr('rel', products_id) ;
		new_button.find('button').attr('onClick', 'cartremove(\'' + products_id + '\');') ;


		// Products details in shopping cart infobox
		//
		product_name = '<li data-id="' + products_id + '" id="pc-' + products_id + '">';
		product_name += '<span class="newItemInCart">';
		product_name += '<span class="name">' + $(document.getElementById('pn-' + products_id)).html() + '</span>';
		product_name += '<input class="count" id="pq-' + products_id +  '" value="' + val + '" type="text">'  ; 
		product_name += new_button.html()  ;
		product_name += '<input type="hidden" name="products_id[]" value="' + products_id + '" />'  ;
		product_name += '<input type="checkbox" name="cart_delete[]" value="' + products_id + '" style="display:none;" />'  ;
		product_name += '</span>';
		product_name += '</li>';

		// Updating infobox content
		$("#boxcart-total-area").show();

		// Get the order total from the infobox before new product is added
		//
		var total = $(document.getElementById('boxcart-total')).html() ;
		var total = total.replace(/[^0-9.]/g, '') ;
		var total = parseFloat(total) ;


		$.ajax({
			type: 'POST',
			url: encodeURI($('form[name=cart_quantity]').attr('action')) + '&ajax=1',
			data: $('form[name=cart_quantity]').serialize(),
			async:false,
			complete: function(data) {
				ajaxRefreshProducts();
				update_cart();
			},
			dataType: 'html'
		});				

		// Updating cart total
		//
		$.ajax({
			type: 'GET',
			url: encodeURI($('form[name=cart_quantity]').attr('action')) + '&show_total=1&ajax=1', 
			data: $('form').serialize(),
			success: function(data) {
				$('#boxcart-total').html(data);
				update_total(total);
			}
		});


		ajaxPerformShippingRefresh();

		// Remove product from infobox list
		// 
		$(document.getElementById('pc-' + products_id)).remove() ;

		// Product count 
		//
		count = $('li[id^="pc-"]').size() ;

		// Append product to the list

		if ( count == 0 ) $("#boxcart-content").find('li').remove() ;

		if ( val > 0 ) $('#boxcart-content').append( product_name ) ;
		$('.boxcartTotal').show() ;

		return(false);
	}