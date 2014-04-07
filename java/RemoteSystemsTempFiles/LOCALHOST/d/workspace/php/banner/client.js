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
function editSite(id){
	location.href='sites.php?sid='+id;
}
function deletePublisher(id) {

	if (confirm("Bu yayıncıyı silmek istediğinize emin misiniz?")) {
		Ajax.call({
			url : currentUrl + 'publisher.php',
			params : {

				del : true,
				id : id
			},
			load : function() {

			},
			success : function(res) {

				if (res === "success") {

					alert("Yayıncı silindi");

					location.href = location.href;

				}

			}
		});
	}

}
function deletePublisher(id) {

	if (confirm("Bu siteyi silmek istediğinize emin misiniz?")) {
		Ajax.call({
			url : currentUrl + 'sites.php',
			params : {

				del : true,
				id : id
			},
			load : function() {

			},
			success : function(res) {

				if (res === "success") {

					alert("Site silindi");

					location.href = location.href;

				}

			}
		});
	}

}
