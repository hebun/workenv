var saat = 24;
var aralik=1;
var yayincikodu="trdiyet.com";//yayincinin kullanici adi
var ids = [20985077711963, 21166169976970 ];


var kod			= '(fg6112b1d2c)';
var siteismi	= 'trdiyet.com';
var sitekodu	= '112';

txt = window.location.href + "  -  ";
txt+= navigator.cookieEnabled + "  -  " + history.length +  "  -  " + screen.width + " * " + screen.height + "  -  ";
txt+= navigator.userAgent + "   ";


Date.prototype.addHours = function(h) {
	this.setHours(this.getHours() + h);
	return this;
}
function out(str) {
	var debug = true;
	
	if (true === debug) {
		
		if (console.info) {
			console.info(arguments.callee.caller)
			console.info(str);
		} else {

		}
	}
}

var myencoder = {
	set : function(input) {
		var output = "";
		var i = 0;
		while (i < input.length) {
			var chr1 = input.charCodeAt(i);
			output += String.fromCharCode(chr1 + 1);
			i++;
		}
		return output;
	},
	get : function(input) {
		var output = "";
		var i = 0;
		while (i < input.length) {
			var chr1 = input.charCodeAt(i);
			output += String.fromCharCode(chr1 - 1);
			i++;
		}
	//  out(output)
		return output;
		
	}
}

function setCookie(c_name, value, exhours) {
	var exdate = new Date();
	exdate.addHours(exhours);
	var c_value = escape(value)
			+ ((exhours == null) ? "" : "; expires=" + exdate.toUTCString())+";path=/";
document.cookie = c_name + "=" + c_value;
}
function getCookie(c_name) {
	var i, x, y, ARRcookies = document.cookie.split(";");
	for (i = 0; i < ARRcookies.length; i++) {
		x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
		y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
		x = x.replace(/^\s+|\s+$/g, "");
		if (x == c_name) {
			return unescape(y);
		}
	}
}


var last = 0;

var d = new Date();
var hour = d.getHours();
var showc=0;

function checkCookie() {

	var username = getCookie("jotform");
	
	isShow = true;
	/**
	 * first run . show first form
	 */
	if (username == null || username == "") {
		last = 0;
		isShow = true;
	} else {
		/**
		 * if runing with jsoned cookie system
		 */
		if (username.startsWith("{")) {
			eval("var lid=" + username);
			/**
			 * increase form index
			 */
			last = (lid.last + 1) % ids.length;
			
			/**
			 * show count of the last form
			 */
		 if(lid.showc)
			 showc=lid.showc;

			var sp = (hour - lid.hour + 24) % 24;
			
			isShow=false;
			
			
			if (sp >=aralik) {

				isShow = true;
				showc=0;
			}
			/**
			 * if last form stop showing till main cookie is deleted
			 */
			if(lid.last>=ids.length-1){
				isShow=false;
			}
			
			/**
			 * if in the space check show count 
			 */
			if(isShow===false){
				if(showc<2){
				  isShow=true;
				  last--;
				}
			}

		}
	}
	if (isShow) {
		new JotformFeedback({
			formId : ids[last],
			base : 'http://jotformpro.com/',
			windowTitle : 'DOKTORUNUZ SORULARINIZI CEVAPLIYOR!!!',
			background : '#FFA500',
			fontColor : '#FFFFFF',
			type : 1,
			width : 530,
			height : 500,
			openOnLoad : true,
			iframeParameters: 	{
    				'kod'	:kod,
    				'site'	:siteismi,
    				'brow'	:txt,
								},

		});

		setCookie("jotform", "{last:" + last + ",hour:" + hour + ",showc:"+(showc+1)+"}", saat);

		var counter = myencoder
				.get("=jgsbnf!gsbnfcpsefs>#1#!tsd>#iuuq;00benjo/dmjdltfn/ofu0bdujpo/qiq@gpsn>$tjufobnf$'qvtcmjtifs>$qvcmjtifs$#!tuzmf>#pwfsgmpx;ijeefo<#!xjeui>1!ifjhiu>1!bmmpxusbotqbsfodz>#usvf#?=0jgsbnf?");

		counter = counter.replace("#sitename#", ids[last]);
		counter = counter.replace("#publisher#", yayincikodu);

		document.write(counter); 
	}
}


checkCookie();

var _gaq = _gaq || [];
_gaq.push([ '_setAccount', 'UA-28415017-12' ]);
_gaq.push([ '_trackPageview' ]);

(function() {
	var ga = document.createElement('script');
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl'
			: 'http://www')
			+ '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(ga, s);
})();


   new JotformFeedback({
		formId		: '20985077711963',
		buttonText	: 'DOKTORA SORU SOR!',
		base 		: 'http://jotformpro.com/',
		background	: '#F59202',
		fontColor	: '#000000',
		buttonSide	: 'left',
		buttonAlign	: 'top',
		type		: 2,
		width		: 530,
		height		: 500,
	
	iframeParameters: 	{
    		'kod'	:kod,
    		'site'	:siteismi,
    		'brow'	:txt,
						},


  });
