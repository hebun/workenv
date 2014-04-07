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

	return [ curleft, curtop ];

}





