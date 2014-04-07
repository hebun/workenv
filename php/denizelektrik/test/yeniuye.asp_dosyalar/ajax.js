var IE=document.all?true:false
if(!IE)document.captureEvents(Event.MOUSEMOVE)
document.onmouseover=getMouseXY;var hedefID="";var tempX=0;var tempY=0;var old_balon="boþ";var old_css="boþ";var old_resim="boþ";var KeepContent="";function getScreenXY(){tempX=screen.width/3;tempY=document.body.scrollTop+(screen.height/3);if(tempX<0){tempX=0}
if(tempY<0){tempY=0}
document.getElementById('PopUpAlertDiv').style.top=document.body.scrollTop;document.getElementById('PopUpSepetDiv').style.top=document.body.scrollTop;document.getElementById('PopUpUyelikDiv').style.top=document.body.scrollTop;document.getElementById('PopUpAlertBackDiv').style.width=document.body.scrollWidth;document.getElementById('PopUpAlertBackDiv').style.height=document.body.scrollHeight;document.getElementById('PopUpAlertBackDiv').style.filter="alpha(opacity:80)";document.getElementById('PopUpAlertBackDiv').style.KHTMLOpacity=80/100;document.getElementById('PopUpAlertBackDiv').style.MozOpacity=80/100;document.getElementById('PopUpAlertBackDiv').style.opacity=80/100;}
function fadeIn(objId,opacity){if(document.getElementById){obj=document.getElementById(objId);if(opacity<=100){setOpacity(obj,opacity);opacity+=10;window.setTimeout("fadeIn('"+objId+"',"+opacity+")",0.1);}}}
var obw=0;var dheg=0;function fadewidth(objId,opacity,heg){if(document.getElementById){obj=document.getElementById(objId);if(obw<=opacity){obw+=1;obj.style.width=obw;window.setTimeout("fadewidth('"+objId+"',500)",2);}else{if(dheg<=heg){dheg+=1;obj.style.width=dheg;window.setTimeout("fadewidth('"+objId+"',200)",2);}}}}
var hegd=0;function heightboyut(objId,heg){if(document.getElementById){obj=document.getElementById(objId);if(hegd<=heg){hegd+=1;obj.style.height=dheg+'%';window.setTimeout("heightboyut('"+objId+"',200)",2);}}}
function setOpacity(obj,opacity){opacity=(opacity==100)?99.999:opacity;obj.style.filter="alpha(opacity:"+opacity+")";obj.style.KHTMLOpacity=opacity/100;obj.style.MozOpacity=opacity/100;obj.style.opacity=opacity/100;}
function getMouseXY(e){
	if(IE){
		tempX=event.clientX+document.body.scrollLeft
		tempY=event.clientY+document.body.scrollTop
	}else{
		tempX=e.pageX
		tempY=e.pageY
	}
	if(tempX<0){tempX=0}
	if(tempY<0){tempY=0}
	if(typeof(balonAktif)!='undefined'){
		if(balonAktif==1){
			var nesneler;
			if(!e){e=window.event};
			if(e.target!=null){nesneler=e.target}
			else{nesneler=e.srcElement}
			var ozellik=balonlar(nesneler);
			if(ozellik.indexOf("img=")>=0&&typeof(cssLayoutAktif)!='undefined'&&cssLayoutAktif==1){
				if(old_resim!=ozellik){document.getElementById('cssLayout').style.display="block";AjaxModul("adminv2/ajax_image_upload.asp",ozellik,"cssLayout");old_resim=ozellik;}
				document.getElementById('cssLayout').style.left=tempX-5;document.getElementById('cssLayout').style.top=tempY-5;
			}
			else if(ozellik.indexOf("pid=")>=0){
				if(old_balon!=ozellik){
					document.getElementById('urunBalonu').style.left=tempX+5;
					document.getElementById('urunBalonu').style.top=tempY+5;
					document.getElementById('urunBalonu').style.display="block";
					
					//GadgetModul('post','ajax/plugin_urun_balonu.asp',ozellik,'','urunBalonu','');
					getPrdBalloon.getBalloon(ozellik);
					old_balon=ozellik;
				}
			}
			else{old_css="";old_balon="";old_resim="";document.getElementById('urunBalonu').style.display="none";}
		}
	}
	return true
}

var getPrdBalloon = (function() {
	var prdBalloon = {};
	prdBalloon.getBalloon = function(ozellik) {
		var ajaxManager = $.manageAjax.create(
			'cacheQueue', 
			{ queue: true, cacheResponse: true }
		); 
		ajaxManager.add({
			type: 'POST',
			data: ozellik,
			url: '/ajax/plugin_urun_balonu.asp',
			success: function (data) {
					$("#urunBalonu").html(data);
			}
		});
	};
	return {
		getBalloon: prdBalloon.getBalloon
	};
}());

function balonlar(n){var i=0;var metin="-";var ozellikler=n.attributes;for(i=0;i<ozellikler.length;i++){if(ozellikler[i].name=="src"&&typeof(cssLayoutAktif)!='undefined'&&cssLayoutAktif==1){if(ozellikler[i].value!='')
{metin="img="+ozellikler[i].value;break;}}
else if(ozellikler[i].name=="class"&&typeof(cssLayoutAktif)!='undefined'&&cssLayoutAktif==1)
{if(ozellikler[i].value!='')
{metin="cssname="+ozellikler[i].value;break;}}
else if(ozellikler[i].name=="bln")
{if(!isNaN(ozellikler[i].value)){metin="pid="+ozellikler[i].value;break;}}}
return metin;}
function AjaxHttpRequest(){var obje;var browser=navigator.appName;if(browser=="Microsoft Internet Explorer"){try
{obje=new ActiveXObject("Microsoft.XMLHTTP");}
catch(e)
{obje=new ActiveXObject('Msxml2.XMLHTTP');}}else{obje=new XMLHttpRequest();}
return obje;}
var xmlHttp=AjaxHttpRequest();function AjaxModul(hedef_url,hedef_parametre,hedefLayer){try{if(hedef_parametre=='keepcontent')
{KeepContent=document.getElementById(hedefLayer).innerHTML}
else{KeepContent=""}
hedefID=hedefLayer;var x=hedef_parametre.split('&');var kaynak="";var j,y;for(j=0;j<=x.length-1;j++)
{y=x[j].split('=');kaynak=kaynak+y[0]+'='+escape(y[1])+'&';}
xmlHttp.open("POST",hedef_url,true);xmlHttp.setRequestHeader('If-Modified-Since','Wed, 31 Dec 1980 00:00:00 GMT');xmlHttp.setRequestHeader('Expires','Wed, 31 Dec 1980 00:00:00 GMT');xmlHttp.setRequestHeader('Cache-Control','no-cache');xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');xmlHttp.setRequestHeader('Content-length',kaynak.length);xmlHttp.setRequestHeader('Connection','close');xmlHttp.onreadystatechange=ResultAjaxModul;xmlHttp.send(kaynak);}
catch(e)
{document.getElementById('AjaxLoading').style.display="none";xmlHttp.send(hedef_parametre);}}
function ResultAjaxModul(){if((xmlHttp.readyState==0)||(xmlHttp.readyState==1)||(xmlHttp.readyState==2)||(xmlHttp.readyState==3)){document.getElementById('AjaxLoading').style.display="block";if(document.documentElement)
{document.getElementById('AjaxLoading').style.left=tempX;document.getElementById('AjaxLoading').style.top=tempY;}}
if(xmlHttp.readyState==4){document.getElementById('AjaxLoading').style.display="none";if((xmlHttp.responseText)!=="")
{document.getElementById(hedefID).innerHTML=KeepContent+xmlHttp.responseText
KeepContent=""}else{}}}
function GadgetModul(SubmitMethod,dataURL,paramURL,Title,containerID,containerClass)
{try{document.getElementById(containerID).innerHTML='<img src=images/ajax_loader.gif>';}catch(e){}
var ml=new Gadget(SubmitMethod,dataURL,paramURL,Title,containerID,containerClass);ml.load();}
function Gadget(SubmitMethod,dataURL,paramURL,Title,containerID,containerClass)
{if(SubmitMethod!=undefined)
{this._SubmitMethod=SubmitMethod;}
if(dataURL!=undefined)
{this._dataURL=dataURL;}
if(paramURL!=undefined)
{this._ParamURL=paramURL;}
if(Title!=undefined)
{this._Title=Title;}
if(containerID!=undefined)
{this._containerID=containerID;}
if(containerClass!=undefined)
{this._containerClass=containerClass;}}
Gadget.prototype._SubmitMethod="POST";Gadget.prototype._Title="";Gadget.prototype._request=undefined;Gadget.prototype._containerID="container";Gadget.prototype._containerClass="ml_container";Gadget.prototype.load=function()
{document.getElementById('AjaxLoading').style.display="block";this._request=this._getXMLHTTPRequest();var _this=this;this._request.onreadystatechange=function(){_this._onData()};this._request.open(this._generateSubmitMethod(),this._generateDataUrl(),true);this._request.setRequestHeader('If-Modified-Since','Wed, 31 Dec 1980 00:00:00 GMT');this._request.setRequestHeader('Expires','Wed, 31 Dec 1980 00:00:00 GMT');this._request.setRequestHeader('Cache-Control','no-cache');this._request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');this._request.setRequestHeader('Content-length',this._generateParamURL().length);this._request.setRequestHeader('Connection','close');this._request.send(this._generateParamURL());}
Gadget.prototype._writeContainer=function()
{document.write("<div id='"+this._containerID+"' class='"+this._containerClass+"'>"+this._Title+"</div>");}
Gadget.prototype._render=function(title)
{var content=document.getElementById(this._containerID);try{content.innerHTML=title;}
catch(e){}}
Gadget.prototype._generateSubmitMethod=function()
{return this._SubmitMethod;}
Gadget.prototype._generateDataUrl=function()
{return this._dataURL;}
Gadget.prototype._generateParamURL=function()
{return this._ParamURL;}
Gadget.prototype._onData=function()
{if(this._request.readyState==4)
{if(this._request.status=="200")
{document.getElementById('AjaxLoading').style.display="none";this._render(this._request.responseText);if(this.onDraw!=undefined)
{this.onDraw();}}
else
{if(this.onError!=undefined)
{this.onError({status:this_request.status,statusText:this._request.statusText});}}
delete this._request;}else
{document.getElementById('AjaxLoading').style.display="block";}}
Gadget.prototype._getXMLHTTPRequest=function()
{var xmlHttp;try
{xmlHttp=new ActiveXObject("Msxml2.XMLHttp");}
catch(e)
{try
{xmlHttp=new ActiveXObject("Microsoft.XMLHttp");}
catch(e2)
{}}
if(xmlHttp==undefined&&(typeof XMLHttpRequest!='undefined'))
{xmlHttp=new XMLHttpRequest();}
return xmlHttp;}
function ackapa(nesneadi)
{if(document.getElementById(nesneadi).style.display=="none")
{document.getElementById(nesneadi).style.display="block";}else{document.getElementById(nesneadi).style.display="none";}}
function ac(nesneadi)
{document.getElementById(nesneadi).style.display="block";}
function kapa(nesneadi)
{document.getElementById(nesneadi).style.display="none";}
function Gizle(nesneadi)
{document.getElementById(nesneadi).style.visibility="hidden";}
function Goster(nesneadi)
{document.getElementById(nesneadi).style.visibility="visible";}
function findPosY(obj){var curtop=0;if(obj.offsetParent){while(obj.offsetParent){curtop+=obj.offsetTop
obj=obj.offsetParent;}}
else if(obj.y)curtop+=obj.y;return curtop;}
function findPosX(obj)
{var curleft=0;if(obj.offsetParent){while(obj.offsetParent){curleft+=obj.offsetLeft
obj=obj.offsetParent;}}
else if(obj.x)curleft+=obj.x;return curleft;}