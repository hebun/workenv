var t;
function timeProd(e){
	if(e.charCode!='0'||e.keyCode=='8'||e.keyCode=='46'){clearTimeout(t);t=setTimeout("ProdSearch()",1000);}
	else
	{return;}
}
function ProdSearch(){
	document.getElementById('ReklamAramaDiv').style.top=findPosY(document.getElementById('src2'))+18;
	document.getElementById('ReklamAramaDiv').style.left=findPosX(document.getElementById('src2'));
	if(document.getElementById('src2').value.length>=3){
		document.getElementById('ReklamAramaDiv').style.display='block';
		//GadgetModul('post','ajax/plugin_reklam_urun_search.asp','src='+escape(document.getElementById('src2').value),'','ReklamAramaDiv','');
		getSearch.prdSearch('src='+escape(document.getElementById('src2').value));
	}else{
		document.getElementById('ReklamAramaDiv').style.display='none';
	}
}
var getSearch = (function() {
	var lyrSearch = {};
	lyrSearch.prdSearch = function(send) {
		var ajaxManager = $.manageAjax.create(
			'cacheQueue', 
			{ queue: true, cacheResponse: true }
		); 
		ajaxManager.add({
			type: 'POST',
			data: send,
			url: 'ajax/plugin_reklam_urun_search.asp',
			success: function (data) {
					$("#ReklamAramaDiv").html(data);
			}
		});
	};
	return {
		prdSearch: lyrSearch.prdSearch
	};
}());

function isNumber(field){var re=/^[0-9]*$/;if(!re.test(field.value))
{alert('Bu bölgeye sadece sayý yazabilisiniz.');field.value=field.value.replace(/[^0-9]/g,"");}}
function MM_goToURL(){var i,args=MM_goToURL.arguments;document.MM_returnValue=false;for(i=0;i<(args.length-1);i+=2)eval(args[i]+".location='"+args[i+1]+"'");}
function MM_openBrWindow(theURL,winName,features){window.open(theURL,winName,features);}
function submitform(){document.aramaformu.submit();}
function kardivackapa(prdid){if(document.getElementById('kardiv'+prdid).style.display=='block')
{document.getElementById('kardiv'+prdid).style.display='none';}
else
{document.getElementById('kardiv'+prdid).style.display='block';}}

function ackapa(nesneadi)
{
    if(document.getElementById(nesneadi).style.display == "none")
    {document.getElementById(nesneadi).style.display = "block";}
	else
	{document.getElementById(nesneadi).style.display = "none";}
}
function ac(nesneadi){document.getElementById(nesneadi).style.display = "block";}
function kapa(nesneadi){document.getElementById(nesneadi).style.display = "none";}