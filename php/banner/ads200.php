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
<?php
require_once 'config.php';
$popDb=selectOne("publisher","popup","id",$_GET["pid"]);

$isPop=$popDb=="1";
if($isPop)
  {
    echo "<script type='text/javascript' src='pa.js'></script>";
  }
?>
</head>
<body style="overflow:hidden;">
<?php 

require_once 'config.php';



class site{
	var	$name;
	var $perc;
	function site($name,$perc){
		$this->name=$name;
		$this->perc=$perc;
	}
}
$arr=array(

//burdan

	   new site("http://form.jotformpro.com/form/30053617720950",99),
	   new site("http://form.jotformpro.com/form/30053617720950",1)


//buraya kadar
);

$rNo=rand(0,100);
$total=0;
$theSite;
foreach ($arr as $obj){
	if($rNo<=($obj->perc+$total)){
		$theSite=$obj->name;
		break;
	}
	$total+=$obj->perc;
}


$r=rand(0,100);
$acode=selectOne("publisher","acode","id",$_GET["pid"]);


	echo '<iframe scrolling="no"  width="200" height="480" frameborder="no" src="'.$theSite.'"></iframe>';
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
