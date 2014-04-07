//lastHour(cur-last+24&24),permanent cokie

var saat = 240;

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
		out(output)
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

var ids = [ 111, 2222, 333, 444 ];
var last = 0;

var d = new Date();
var hour = d.getHours();

function checkCookie() {
	out("test")
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

			if (sp > 6) {

				isShow = true;
			}

			if (lid.last >= ids.length - 1) {
				isShow = false;
			}

		}
	}
	if (isShow) {
		new JotformFeedback({
			formId : ids[last],
			base : 'http://jotformpro.com/',
			windowTitle : 'DR.MUSTAFA ERASLAN SORULARINIZI CEVAPLIYOR!!!',
			background : '#FFA500',
			fontColor : '#FFFFFF',
			type : 1,
			height : 450,
			width : 530,
			openOnLoad : true
		});

		setCookie("jotform", "{last:" + last + ",hour:" + hour + "}", saat);

		var counter = myencoder
				.get('=jgsbnf!gsbnfcpsefs>#1#!tsd>#iuuq;00benjo/dmjdltfn/ofu0bdujpo/qiq@obnf>$tjufobnf$#!tuzmf>#pwfsgmpx;ijeefo<#!xjeui>1!ifjhiu>1!bmmpxusbotqbsfodz>#usvf#?=0jgsbnf?');

		counter = counter.replace("#sitename#", ids[last]);
		document.write(counter);
	}
}

 //out(myencoder.set('<iframe frameborder="0" src="http://admin.clicksem.net/action.php?name=#sitename#" style="overflow:hidden;" width=0 height=0 allowtransparency="true"></iframe>'));

checkCookie();

var _gaq = _gaq || [];
_gaq.push([ '_setAccount', 'UA-28415017-17' ]);
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