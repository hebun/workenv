var saat=1;

Date.prototype.addHours= function(h){
    this.setHours(this.getHours()+h);
    return this;
}

function setCookie(c_name,value,exhours)
{
var exdate=new Date();
exdate.addHours(exhours);
var c_value=escape(value) + ((exhours==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}
function checkCookie()
{
var username=getCookie("jotform");
  if (username!=null && username!="")
  {

  }
else
  {

 
	new JotformFeedback(
{
formId:'33155949558872',
base:'http://www.jotform.com/',
windowTitle:'billyboy ',
background:'#FFA500',fontColor:'#FFFFFF',type:1,width:450,height:410,openOnLoad:true
}
);
 //  setCookie("jotform","jotformuser",saat);
    
  }
}
checkCookie();

 

var _gaq = _gaq || [];
  _gaq.push(
  ['_setAccount', 'UA-45709457-1'],
  ['_trackPageview'],
  ['b._setAccount', 'UA-45709457-2'],
  ['b._trackPageview']
);
(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();