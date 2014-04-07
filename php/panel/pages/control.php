<?php

session_start();
if(!(isset($_SESSION['adm_logged']) && ($_SESSION['adm_logged'] == true))){
	header("Location: index.php");
	exit;		              
}
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/settings.inc.php");
require_once("../inc/functions.inc.php");


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
    <title><?php echo _SITE_NAME; ?> :: Admin Panel :: Kontrol</title>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <link href="../css/style_<?php echo _CSS_STYLE;?>.css" type=text/css rel=stylesheet>
	 <link href="../facybox.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="../facybox_urls.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
	 <script src="../facybox.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('a[rel*=facybox]').facybox({
		// noAutoload: true 
		'transitionIn'      : 'none',
			'transitionOut'     : 'none',
			'titlePosition'     : 'over',
			'cyclic'            : true,
			'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
				return '<span id="fancybox-title-over">Image ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
			}
	});

	$("h2",$("#changelog")).css("cursor","pointer").click(function(){
		$(this).next().slideToggle('fast');
	}).trigger("click");

/*
	$.ajax({
		url : "mail.php",
			type: "POST",
			success: function(data, textStatus, jqXHR)
			{
			},
			error: function (jqXHR, textStatus, errorThrown)
			{

			}
	});

 */

});
	function userChange(){
	var userId=	$("#userFilter").val();
		document.location.href='control.php?userId='+userId;
	}
</script>
</head>
<link rel='stylesheet' type='text/css' href='../modules/datagrid/css/style_blue.css'>
<body style="background: #ffffff;">

<br />

<h3 align="center">Kontroller</h3>
<div width='%80' style="padding-left: 40px;">
Kullaniciya göre filtrele:
<select id='userFilter' onchange='userChange()'>
<?php
$db=new Database();
if($db->open()){

	$db->query("select id,name from eleman where state=0 ");

	while($row=$db->fetchAssoc()){
		echo "<option value='$row[id]'";
		if(isset($_GET['userId'])){

			if($_GET['userId']==$row['id'])
				echo " selected ";
		}	
		echo " >$row[name]</option>";
	}

}
?>
</select>

</div>
<br>
<table class="blue_class_table" width="80%" style="margin-left: auto; margin-right: auto;" dir="ltr">
<?php
function checkDay($day){
	global $controls;

	foreach($controls as $d=>$f)
	{
		if($d==$day) return $f;
	}
	return false;
}
$sqlc="select p.id as pid,c.id as cid, p.name as name,tarih,c.file as file from control as c inner join point as p on p.id=c.pointId";
if($_SESSION['adm_status'] !== "main admin"){
	$sqlc.=" where c.userId=$_SESSION[adm_user_id]";
}
$dbx=new Database();
$controls=array();
if($dbx->open()){
	$dbx->query($sqlc);
	while($row=$dbx->fetchAssoc()){
		$dt=new DateTime();
		$dt->setTimestamp( strtotime($row["tarih"])); 
		$controls[$row["pid"]*1000+$dt->format('m')*100+$dt->format('d')]=$row['cid'];

	}
}
//print_r($controls);


$sqlp="select p.id as id , p.name as name, b.name as  bname , b.userId as userId, e.name as ename from point as p".
	  " inner join bolge as b on b.id = p.bolgeId inner join eleman as e on e.id = b.userId where 1=1 ";
if($_SESSION['adm_status'] !== "main admin"){
	$sqlp=$sqlp." and b.userId=$_SESSION[adm_user_id]";
}else{
//print_r($_GET);
	if(isset($_GET['userId'])){ 
		$sqlp=$sqlp." and  b.userId=$_GET[userId]";
	}elseif(isset($_GET['pointId'])){
	}


}
//echo $sqlp;
if($dbx->open()){
	$dbx->query($sqlp);
	while($row=$dbx->fetchAssoc()){		
		$date= new DateTime();
		//$date->add($di);
		$date->modify('-30 day');

		echo "<tr><td  class='blue_class_td '  >$row[ename]</td><td  class='blue_class_td '  ><a href='points.php?meng_mode=edit&meng_rid=$row[id]' rel='facybox'>$row[name]</a></td>";
		for($k=0;$k<30;$k++){

			//$date->add($dia);
			//

			$date->modify('+1 day');
			if($retFile=checkDay($row["id"]*1000+$date->format('m')*100+$date->format('d'))){
				echo "
					<td  class='blue_class_td '  ><a href='showimg.php?id=$retFile' rel='facybox'>
					<span style='color:red; text-weight:bold'>".
					$date->format('d')."</span></a></td>";
			}else {
				echo "
					<td  class='blue_class_td '>	";
				if($_SESSION['adm_status'] !== "main admin"){
					echo "<a href='addControl.php?pid=$row[id]&date=".$date->getTimestamp()."' rel='facybox'>";
				}
				echo $date->format('d')."</td>";
			}
		}
		echo "</tr>";
	}
}
?>
</table>

<br />
</body>
</html>
