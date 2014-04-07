var allurl = location.href.split('/');

var temp = "";
for ( var k = 0; k < allurl.length; k++) {
	if (k != allurl.length - 1)
		temp += allurl[k] + "/";
}
var currentUrl = temp;
function ontitlekey(e) {
	var pt = document.getElementById("ptitle");
	pt.innerHTML = document.getElementById("ttitle").value
			+ String.fromCharCode(e.charCode);

}
function oncontentkey(e) {
	var pt = document.getElementById("pcontent");
	pt.innerHTML = document.getElementById("tcontent").value
			+ String.fromCharCode(e.charCode);

}
function onshowurlkey(e) {
	var pt = document.getElementById("pshowurl");
	pt.innerHTML = document.getElementById("tshowurl").value
			+ String.fromCharCode(e.charCode);

}
function deleteAccount(id) {

	if (confirm("Bu hesabi silmek istediğinize emin misiniz?")) {
		Ajax.call({
			url : currentUrl + 'users.php',
			params : {

				del : true,
				id : id
			},
			load : function() {

			},
			success : function(res) {

				if (res === "success") {

					alert("Hesap silindi");

					location.href = location.href;

				}

			}
		});
	}

}
