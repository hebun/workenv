//var currentUrl = "http://www.deniz-elektrik.com/facebook/";
//var currentUrl = "http://localhost/facestore/facestore/";

var allurl = location.href.split('/');

var temp = "";
for ( var k = 0; k < allurl.length; k++) {
	if (k != allurl.length - 1)
		temp += allurl[k] + "/";
}
var currentUrl = temp;
var lastLoadOptions;
function deleteProduct(id) {
	if (confirm("Bu ürünü silmek istediğinize emin misiniz?")) {
		Ajax.call({
			url : currentUrl + 'delProduct.php',
			params : {
				id : id

			},
			load : function() {

			},
			success : function(res) {
				if (res === "success") {

					alert("Ürün silindi");

					console.info(lastLoadOptions);
					reloadList(lastLoadOptions.id, lastLoadOptions.pno,
							lastLoadOptions.order, lastLoadOptions.tip)
				}

			}
		});
	}
}

function closeTiny(){
	TINY.box.hide()
	reloadList(lastLoadOptions.id, lastLoadOptions.pno,
							lastLoadOptions.order, lastLoadOptions.tip)
}

function editProduct(pid, control) {
	pos = findPos(control)
	TINY.box.show("editProduct.php?pid=" + pid, 1, 400, pid == 0 ? 300 : 430,
			1, false);
}
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
function poppaypal(pid, rc, control) {

	pos = findPos(control)
	TINY.box.show("order.php?pid=" + pid, 1, 400, 400, 1, false, pos[1]);

}
function popBigImg(pid, rc, control) {

	pos = findPos(control)
	TINY.box.show("bigimg.php?pid=" + pid, 1, 400, 450, 1, false, pos[1]);

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
function reloadList(value, pageno, orderby, tip) {

	if (orderby == null || orderby === "undefined") {
		orderby = "id";

	}
	var params = {
		id : value,
		pno : pageno | 0,

		order : orderby,
		tip : tip
	};
	Ajax
			.call({
				url : currentUrl + 'getList.php',
				params : params,
				load : function() {
					lastLoadOptions = params;
					//console.info(lastLoadOptions);
					document.getElementById("listDiv").innerHTML = "<img src='img/ajax_wait.gif' />";

				},
				success : function(res) {
					document.getElementById("listDiv").innerHTML = res;

				}
			});
}
function submitEditPro() {

	var form = document.getElementById("orderForm");

	var isreq = false;
	var fields = "";
	for (i = 0, length = form.elements.length; i < length; i++) {

		var f = form.elements[i];
		if (f.type === "text" ) {
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