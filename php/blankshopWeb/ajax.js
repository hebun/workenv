function YeniNesne() {
	var http;
	if (window.XMLHttpRequest) {
		http = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		http = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert('Problem creating the XMLHttpRequest object');
	}
	return http;
}
function emailValidation(email) {

	var emailRegEx = /^([a-zA-Z0-9])([a-zA-Z0-9\._-])*@(([a-zA-Z0-9])+(\.))+([a-zA-Z]{2,4})+$/;

	var testMail = email;

	if (testMail.search(emailRegEx) == -1)
		return false
	return true;

}
function postData(caller) {

	var params, url, layer;

	/**
	 * setting params in ajax..
	 */

	if (caller === "subscribe" || caller === "outSub") {
		if (emailValidation(document.getElementById("mailId").value) === false) {
			alert("Geçersiz E-mail adresi")
			return;
		}
		var out = caller === "outSub" ? "1" : "0";
		params = "email=" + document.getElementById("mailId").value
				+ "&ajax=true&out=" + out;
		url = "subscribe.php";
		layer = "";
	} else {
		alert("no caller");
		return;
	}

	var http = YeniNesne();

	http.open('POST', url);

	http.onreadystatechange = function() {
		procces(layer, http, caller)
	};
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.send(params);

}
function procces(layer, http, caller) {
	// //alert(http.readyState);
	if (http.readyState == 4 && http.status == 200) {

		if (http.responseText) {
			if (caller === "subscribe") {
				// document.getElementById("subsBut").value = "Ekle";
				if (http.responseText === "0")
					alert("Bu E-Mail adresi zaten eklenmiş.")
				else {
					alert("E-Mail adresiniz başarıyla eklendi.");
					document.getElementById("mailId").value="";
				}

			} else if (caller === "outSub") {
				// console.info(http.responseText);
				if (http.responseText == "0") {
					alert("E-Mail bulunamadı.")
				} else if (http.responseText == "1") {
					alert("E-Mail'niz başarıyla çıkarıldı.")
				}
			}

			else
				document.getElementById(layer).innerHTML = http.responseText;
		}
	}

	else {

		if (caller === "subscribe") {
			// document.getElementById("subsBut").value = "Bekleyin..";
		} else {
			// document.getElementById(layer).innerHTML = "<img align='center'
			// src='img/loader.gif />";
		}
	}

}
