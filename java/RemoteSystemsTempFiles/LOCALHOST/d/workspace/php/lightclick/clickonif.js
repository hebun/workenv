var isOverIFrame = false;

function processMouseOut() {
	
	isOverIFrame = false;
	top.focus();
}

function processMouseOver() {

	isOverIFrame = true;
}
function removeLike(){
	document.getElementsByTagName('body')[0].removeChild(like)
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