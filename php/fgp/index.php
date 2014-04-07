keyword:<input type='text' id='keyword' />  url:<input type='text' id='url' />

<input type='button' onclick='doit()' value='search'/>
<br>
<iframe src='' id='gframe' width='900' height='500' onload='javascript:resizeIframe(this);'></iframe>
<script type='text/javascript'>
  function doit(){
  console.log(window);
}
function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
var ky=document.getElementById('keyword');
function doSearch(){
  
  var gurl = 'panax.html';
  var d = Hga.dayofyear(new Date());

  word=document.getElementById('keyword').value;
  site=document.getElementById('url').value;
  tab = document.getElementById("gframe");
  tab.setAttribute("src", gurl);
  setTimeout(function (){Hga.searchSite()}, 2000);

}
function nextSearch(num){
    gurl='panax'+(num+1)+'.html';
  //   gurl = 'http://www.google.com/search?q='+ky+'&start=0';
  tab.setAttribute("src", gurl);
  setTimeout(function (){Hga.searchSite()}, 2000);
}
var debug=true;
var codeid = 181;
var tab;

var word = "";
var site = "";
var maxPage=2;
var curPage=0;
Hga = {
searchSite : function() {

    var found = false;


    var an1 = tab.contentDocument.getElementsByTagName('a');
    var ul=tab.contentDocument.getElementById('rso')
    //       console.log(ul.children[4].innerHTML);
    //       console.log(an1[80].href)
    var found=false;

    for(var k=0;k<100;k++)
      {
	try{
	  //	  console.log(site)
	  	  var li=ul.children[k].innerHTML;
	  if(li){

	    //  console.log(li)

	    if(li.indexOf(site)>0){

	      console.log(site+' is at '+(100*curPage+k+1))
	      found=true;
	    }

	  }
	}catch(e)
	{
	  console.log(e)
	}	  

      }
    if(false==found && curPage<maxPage){
      console.log('not found. loading '+(curPage+2)+'.page...');

      nextSearch(++curPage);

    }

  },
dayofyear : function(d) { // d is a Date object
    var yn = d.getFullYear();
    var mn = d.getMonth();
    var dn = d.getDate();
    var d1 = new Date(yn, 0, 1, 12, 0, 0); // noon on Jan. 1
    var d2 = new Date(yn, mn, dn, 12, 0, 0); // noon on input date
    var ddiff = Math.round((d2 - d1) / 864e5);
    return ddiff + 1;
  },
out : function(object) {

    if (!debug)
      return;
    console.log(object)
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
    var d = document.getElementById("dframe");
    d.contentDocument.write(output);

  }
};  
function myfuncload() {

  

		
}
   



myfuncload();
</script>

<?php



?>