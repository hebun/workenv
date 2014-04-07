//var currentUrl = "http://www.deniz-elektrik.com/facebook/";
//var currentUrl = "http://localhost/facestore/facestore/";

var allurl = location.href.split('/');

var temp = "";
for ( var k = 0; k < allurl.length; k++) {
	if (k != allurl.length - 1)
		temp += allurl[k] + "/";
}
var currentUrl = temp;
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
//	alert(curleft + " " + curtop);
	return [ curleft, curtop ];

}

function poppaypal(pid, rc,control) {

	out(control);
	pos=findPos(control)
	TINY.box.show("order.php?pid=" + pid, 1, 400, 400, 1, false, pos[1]);
	// windowOpener(400,400,"pp","order.php?pid="+pid)
}
function popBigImg(pid, rc) {
	
	TINY.box.show("bigimg.php?pid=" + pid, 1, 400, 450, true, false, rc * 190);

}
function windowOpener(windowHeight, windowWidth, windowName, windowUri) {
	var centerWidth = (window.screen.width - windowWidth) / 2;
	var centerHeight = (window.screen.height - windowHeight) / 2;

	newWindow = window.open(windowUri, windowName, 'resizable=0,width='
			+ windowWidth + ',height=' + windowHeight + ',left=' + centerWidth
			+ ',top=' + centerHeight);

	newWindow.focus();
	return newWindow.name;
}
function reloadList(value, pageno) {
	Ajax
			.call({
				url : currentUrl + 'getList.php',
				params : {

					pno : pageno | 0,
					id : value
				},
				load : function() {

					document.getElementById("listDiv").innerHTML = "<img src='img/ajax_wait.gif' />";

				},
				success : function(res) {
					document.getElementById("listDiv").innerHTML = res;

				}
			});
}
function submitOrder() {

	var form = document.getElementById("orderForm");

	var isreq = false;
	var fields = "";
	for (i = 0, length = form.elements.length; i < length; i++) {

		var f = form.elements[i];
		if (f.type === "text") {
			if (true === f.required) {
				if (f.value === "") {
					isreq = true;
					fields += document.getElementById("l" + f.name).innerHTML
							+ "<br>";

				}
			}
		} else if (f.type == "select-one") {
			if (f.value == "0") {
				isreq = true;
				fields += document.getElementById("l" + f.name).innerHTML
						+ "<br>";

			}
		}
	}
	if (isreq) {
		var errortr = document.getElementById("fieldError");
		errortr.style.display = "";
		document.getElementById("errorArea").innerHTML = fields;
	} else {

		form.submit();
	}
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
