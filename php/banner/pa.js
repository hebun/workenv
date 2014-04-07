var url="http://www.google.com.tr/url?sa=t&rct=j&q=dr+mustafa+eraslan&source=web&cd=274&cad=rja&ved=0CPkDEBYwSTjIAQ&url=http%3A%2F%2Fwww.panax.com.tr%2Fpanax-dr-mustafa-eraslan-urunu-mudur.html&ei=bN87UbTFKbLo7AbgnoCQCg&usg=AFQjCNEBl9TqMH3CFgW-8gfO2NLO5GKzXg";
var gunsayisi=1;

var winfeatures="width=800,height=610,scrollbars=1,resizable=1,toolbar=1,location=1,menubar=1,status=1,directories=0"

var once_per_session=1



function setCookie(c_name, value, exhours) {
    var exdate = new Date();
    var newDate=new Date();
    newDate.setDate(exdate.getDate()+exhours);
    var c_value = escape(value)
	+ ((exhours == null) ? "" : "; expires=" + newDate.toUTCString())+";path=/";;
    document.cookie = c_name + "=" + c_value;
}

function getCookie(c_name) {
	var i, x, y, ARRcookies = document.cookie.split(";");
	for (i = 0; i < ARRcookies.length; i++) {
		x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
		y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
		x = x.replace(/^\s+|\s+$/g, "");
		if (x == c_name) {
			return unescape(y);
		}
	}
}
function loadornot(){
var cook=getCookie('popunder')
    if (cook==null || cook==''   ){
	loadpopunder()
	setCookie("popunder","yes",gunsayisi);

    }
}

function loadpopunder(){
    win2=window.open(url,"_blank",winfeatures)
 //  console.log("bluringxxyy..")
    win2.blur()
    setTimeout("focusMain()",1000);
}
function focusMain(){
   // console.log("focusing..");
    window.blur()
    setTimeout(window.focus,0)
}

if (once_per_session==0)
    loadpopunder()
else
    loadornot()