<?php
 header('Content-Type: text/html');
 header('P3P: policyref="/p3p.xml", CP="NOI DSP COR CURa OUR NOR"');
?><html>
<head>
<meta charset="utf-8">
<meta http-equiv='content-type' content='text/html; charset=utf-8' />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35091245-1']);
  _gaq.push(['_trackPageview']);
  
  
  <?php if($_GET["pid"]=="9" ){
?>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33712490-2']);
  _gaq.push(['_setDomainName', 'hastane.com.tr']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

<?php }?>
  
(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  

</script>
</head>
<body style="overflow:hidden;">
<?php 

require_once 'config.php';

$r=rand(0,100);
$acode=selectOne("publisher","acode","id",$_GET["pid"]);
//echo $acode;
if($r<=100){//burdaki 100 sayýsý jot form çýkma ihtimalidir. yani text reklam mý yoksa form mu olacak onun yüzdesi. 

	$ra=rand(0,100);
	$url="UA-33712490-1";
	
	if($ra<=100){//bu satýrdaki 100 sayýsý hemen aþaðýsýndaki url'nin yüzdesi oluyor.
	  $url="http://form.jotformpro.com/form/23475787120962";  
	  
	}
	elseif($ra<=0){//burdaki url'yi ve sayýyý yeni formun url'si ve yüzdesi ile deðiþtireceksin. 4 tane ekledim. þimdlik yüzdeleri 0 oldugu için çalýþmayacaktýr zaten. 
	  $url="http://form.jotformpro.com/form/23084583185963";
	 
	}
	elseif($ra<=0){
	  $url="http://www.clicksem.net";
	 
	}
	elseif($ra<=0){
	  $url="http://www.clicksem.net";
	
	}
	elseif($ra<=0){
	  $url="http://www.clicksem.net";
	 
	}
	echo '<iframe scrolling="no" height="250" frameborder="no" width="300" src="'.$url.'"></iframe>';
}else{


	$sites=select('select * from sites where category=0 ORDER BY RAND() LIMIT 0,4');
	//$acode=selectOne("publisher","acode","id",$_GET["pid"]);
	//$sites=$sites[0];
	echo "<div  style='background-color:white;width:290px;height:240px;'>";
	foreach ($sites as $row) {
		
	echo " 
			<div class='table'  style='border:0px blue solid;height:53px;'>
		
		<div style='color:blue;font-weight: bold;font-size:14px;'  id='ptitle'>
		<a target='_blank' href='action.php?adid=$row[id]&pid=$_GET[pid]'>
		  $row[title]	</a>
		 <span style='color:red;font-weight: normal;font-size:10px;' id='pshowurl'>
		 <a target='_blank' style='color:red;' href='action.php?adid=$row[id]&pid=$_GET[pid]'> $row[showurl]</a>
		</span>
		</div>
			
		<div style='font-size:14px;' id='pcontent'>
		 $row[content]
		</div>
		
		</div>

			";
	}
	echo "</div>";
}
?>
<script type="text/javascript">

<?php if($_GET["pid"]=="9" ){
}else{ ?>

 var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $acode;?>']);
  _gaq.push(['_trackPageview']);
  
  <?php } ?>

  </script>
</body>
</html>