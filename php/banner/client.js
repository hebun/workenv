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
function goDay(day){

location.href='https://www.clicksem.net/banner/kform.php?day='+day;
}
function goDayMails(day){

location.href='https://www.clicksem.net/banner/fmails.php?day='+day;
}
function dynaGoDay(day,page){
location.href='https://www.clicksem.net/banner/'+page+'.php?day='+day;
} 
function selectMailTable(mailtable){
location.href='facemails.php?mailtable='+mailtable;
} 
function togglePopup(way,id){
    Ajax.call({
	url : currentUrl + 'publisher.php',
	params : {

	    popup : true,
	    id : id,
	    wayp:(way+1)%2
	},
	load : function() {

	},
	success : function(res) {

	    if (res === "success") {

		if(way)
		    alert("Popup iptal edildi.");
		else 					alert("Popup aktif edildi.");
		location.href = location.href;

	    }

	}
    });
    
}
function dynaDelete(id,page) {

	if (confirm("Bu kaydi silmek istediğinize emin misiniz?")) {
		Ajax.call({
			url : currentUrl + page+'.php',
			params : {

				del : true,
				id : id
			},
			load : function() {

			},
			success : function(res) {

				if (res === "success") {

					alert("Kayit silindi");

					location.href = location.href;

				}

			}
		});
	}

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
function deleteShare(id) {

	if (confirm("Bu paylasimi silmek istediğinize emin misiniz?")) {
		Ajax.call({
		    url : currentUrl + 'jshare.php',
			params : {

				del : true,
				id : id
			},
			load : function() {

			},
			success : function(res) {

				if (res === "success") {

					alert("Paylasim silindi");

					location.href = location.href;

				}

			}
		});
	}

}
function deleteSite(id) {

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
