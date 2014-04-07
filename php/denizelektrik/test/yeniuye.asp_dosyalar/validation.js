function checkForm(objform)
{var arClass,bValid,uValid,uFlag;bValid=false;uFlag=false;uValid=false;noAlert=false;var objField=objform;for(var iFieldCounter=0;iFieldCounter<objField.length;iFieldCounter++)
{var ozellikler=objField[iFieldCounter].attributes;for(i=0;i<ozellikler.length;i++)
{if(ozellikler[i].name=="valid"){arClass=ozellikler[i].value.split('|');for(var iClassCounter=0;iClassCounter<arClass.length;iClassCounter++)
{var kontrolKod=arClass[iClassCounter];if(kontrolKod.indexOf(',')>=0)
{if(kontrolKod.indexOf('-')==-1)
{if(objField[iFieldCounter].value.length>=parseInt(kontrolKod.split(',')[1]))
{uValid=true;}else{uValid=false;}}
else
{if(objField[iFieldCounter].value.length>=parseInt(kontrolKod.split(',')[1].split('-')[0])&&objField[iFieldCounter].value.length<=parseInt(kontrolKod.split(',')[1].split('-')[1]))
{uValid=true;}else{uValid=false;}}
if(uValid==false&&objField[iFieldCounter].value!="")uFlag=true;kontrolKod=kontrolKod.split(',')[0];}
switch(kontrolKod)
{case'z':if(objField[iFieldCounter].value!="")
{bValid=true;}else
{bValid=false;}break;case'zadres':if(objField[iFieldCounter].value!=""&&objField[iFieldCounter].value.indexOf(' ')>0)
{bValid=true;}else
{bValid=false;}break;case 'zradio':
					bValid = false;
					if ($("input[@name='"+objField[iFieldCounter].name+"']:checked").val())
						bValid = true;
					break;case'yazi':if(objField[iFieldCounter].value!="")
bValid=isStringV2(objField[iFieldCounter].value.replace(/^\s*|\s*$/g,''));break;case'zyazi':bValid=isStringV2(objField[iFieldCounter].value.replace(/^\s*|\s*$/g,''));break;case'numara':if(objField[iFieldCounter].value!="")
bValid=isNumberV2(objField[iFieldCounter].value);break;case'gsm':if(objField[iFieldCounter].value!="")
bValid=isNumberV3(objField[iFieldCounter].value);break;case'zgsm':bValid=isNumberV3(objField[iFieldCounter].value);break;case'znumara':bValid=isNumberV2(objField[iFieldCounter].value);break;case'email':if(objField[iFieldCounter].value!="")
bValid=isEmailV2(objField[iFieldCounter].value);break;case'zemail':bValid=isEmailV2(objField[iFieldCounter].value);break;case'tarih':if(objField[iFieldCounter].value!="")
bValid=isDate(objField[iFieldCounter].value);noAlert=true;break;case'ztarih':bValid=isDate(objField[iFieldCounter].value);noAlert=true;break;case'kredi':if(objField[iFieldCounter].value!="")
bValid=IsCreditCardValid(objField[iFieldCounter].value);break;case'zkredi':bValid=IsCreditCardValid(objField[iFieldCounter].value);break;case'onay':bValid=objField[iFieldCounter].checked;break;default:bValid=true;}
if(bValid==false||uFlag==true)
{if(noAlert==false){if(bValid==false)
{alert(arClass[iClassCounter+1]);}else{alert(arClass[iClassCounter+2]);}}
objField[iFieldCounter].focus();return false;}
noAlert=false;}}}}
return true;}
function isStringV2(strValue)
{return(typeof strValue=='string'&&strValue!=''&&isNaN(strValue));}
function isNumberV2(strValue)
{return(!isNaN(strValue)&&strValue!='');}
function isNumberV3(strValue)
{return(!isNaN(strValue)&&strValue!=''&&strValue.indexOf('0')!=0);}
function isEmailV2(strValue)
{var objRE=/^[\w-\.\']{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]{2,}$/;return(strValue!=''&&objRE.test(strValue));}
function IsCreditCardValid(number){var nChecksum=0;var nProdVal;var nTime=-1;card=strip(number)+'';nLen=card.length;if(nLen<13)return false;for(count=nLen;count>0;count--){nTime=(++nTime%2);nProdVal=card.charAt(count-1)*(nTime+1);if(nProdVal>9)nProdVal-=9;nChecksum+=nProdVal;}
nChecksum%=10;return(nChecksum==0);}
function strip(number){var sOut='';mask='1234567890';for(count=0;count<=number.length;count++){if(mask.indexOf(number.substring(count,count+1),0)!=-1)sOut+=number.substring(count,count+1);}
return sOut;}
var dtCh=".";var minYear=1900;var maxYear=2100;function isInteger(s){var i;for(i=0;i<s.length;i++){var c=s.charAt(i);if(((c<"0")||(c>"9")))return false;}
return true;}
function stripCharsInBag(s,bag){var i;var returnString="";for(i=0;i<s.length;i++){var c=s.charAt(i);if(bag.indexOf(c)==-1)returnString+=c;}
return returnString;}
function daysInFebruary(year){return(((year%4==0)&&((!(year%100==0))||(year%400==0)))?29:28);}
function DaysArray(n){for(var i=1;i<=n;i++){this[i]=31
if(i==4||i==6||i==9||i==11){this[i]=30}
if(i==2){this[i]=29}}
return this}
function isDate(dtStr){var daysInMonth=DaysArray(12)
var pos1=dtStr.indexOf(dtCh)
var pos2=dtStr.indexOf(dtCh,pos1+1)
var strDay=dtStr.substring(0,pos1)
var strMonth=dtStr.substring(pos1+1,pos2)
var strYear=dtStr.substring(pos2+1)
strYr=strYear
if(strDay.charAt(0)=="0"&&strDay.length>1)strDay=strDay.substring(1)
if(strMonth.charAt(0)=="0"&&strMonth.length>1)strMonth=strMonth.substring(1)
for(var i=1;i<=3;i++){if(strYr.charAt(0)=="0"&&strYr.length>1)strYr=strYr.substring(1)}
month=parseInt(strMonth)
day=parseInt(strDay)
year=parseInt(strYr)
if(pos1==-1||pos2==-1){alert("Lütfen Tarihi : gg.aa.yyyy biçiminde girin!")
return false}
if(strMonth.length<1||month<1||month>12){alert("Lütfen geçerli ay girin!")
return false}
if(strDay.length<1||day<1||day>31||(month==2&&day>daysInFebruary(year))||day>daysInMonth[month]){alert("Lütfen geçerli gün girin!")
return false}
if(strYear.length!=4||year==0||year<minYear||year>maxYear){alert("Lütfen yýlý 4 hane olarak girin "+minYear+" - "+maxYear)
return false}
if(dtStr.indexOf(dtCh,pos2+1)!=-1||isInteger(stripCharsInBag(dtStr,dtCh))==false){alert("Lütfen Geçerli bir tarih girin!")
return false}
return true}