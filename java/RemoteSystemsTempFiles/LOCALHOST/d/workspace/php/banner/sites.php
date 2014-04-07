<?php
require_once 'config.php';

session_start();

//var_dump($_SESSION);
$dbtable="sites";
if(!isset($_SESSION["usertype"]) || $_SESSION["usertype"]!="0"){
	header("location:login.php");
}
if(isset($_POST["del"])){
	myQuery("delete from ".$dbtable." where id=$_POST[id]");
	die("success");
}

require_once 'top.php';

$sid;
$title="";
$content="";
$showurl="";
$targeturl="";
if(isset($_GET["sid"])){

	$sid=$_GET["sid"];
	$siterow=select("select * from sites where id=$sid");
	$siterow=$siterow[0];
	$title=$siterow["title"];
	$content=$siterow["content"];
	$showurl=$siterow["showurl"];
	$targeturl=$siterow["targeturl"];
}

if(isset($_POST["add"])){

	$user=$_POST;
	unset($user["add"]);
	if(isset($_GET["sid"]))
	{

		myQuery(getUpdate($dbtable,$user,"id=$sid"));
	}else{
		

		myQuery(getInsert($dbtable,$user));
	}
}else {



}
$table=select("select * from ".$dbtable);

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Kampanyalar</h1>

	</div>
	<div class="select-bar"></div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th>Başlık</th>
				<th>İçerik</th>
				<th>Görünen Url</th>
				<th>Hedef Url</th>
				<th>Düzenle</th>
				<th>Sil</th>
			</tr>
			
			
<?php 

foreach($table as $row)
{
echo "<tr>
		<td >$row[title] </td>
		<td >$row[content] </td>
		
		<td>$row[showurl] </td>
		<td>$row[targeturl] </td>
	<td><img src='img/edit-icon.gif' width='16' style='cursor:pointer' height='16' alt='Sil'".
	" onclick='editSite($row[id])' /></td>
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deleteSite($row[id])' /></td>
		
		</tr>";

}
echo "</table>";


?>
	</div>
	<div class="table">
	<form action="sites.php<?php if(isset($_GET["sid"]))echo "?sid=$sid"?>" method="post">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="2">Yeni Kampanya Ekle</th>
			</tr>
			<tr>
				<td width="172"><strong>Başlık</strong></td>
				<td><input type="text" value="<?php echo $title;?>" id="ttitle" name="title" onkeypress="return ontitlekey(event)" style="width:300px;" /></td>
			</tr>
			<tr>
				<td><strong>İçerik</strong></td>
				<td><input type="text" name="content" id="tcontent" value="<?php echo $content;?>"  onkeypress="return oncontentkey(event)" style="width:300px;" /></td>
			</tr>	
			<tr>
				<td><strong>Görünen Url</strong></td>
				<td><input type="text" name="showurl" id="tshowurl" value="<?php echo $showurl;?>" onkeypress="return onshowurlkey(event)" style="width:300px;" /></td>
			</tr>			
				<tr>
				<td><strong>Hedef Url</strong></td>
				<td><input type="text" name="targeturl" style="width:300px;" value="<?php echo $targeturl;?>"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" Value="<?php echo isset($_GET["sid"])?"Güncelle":"Ekle" ?>" name="add" class="button" /></td>
			</tr>
		</table>
		</form>
	</div>
	Ön İzleme:<br>
	<div class="table"  style="border:1px blue solid;width:200px;height:80px;">
	
	<div style="color:blue;font-weight: bold;font-size:14px;" id="ptitle">
	<?php echo $title;?>
	</div>
	
	<div style="font-size:14px;" id="pcontent">
	<?php echo $content;?>
	</div>
	
	<div style="color:orange;font-weight: bold" id="pshowurl">
	<?php echo $showurl;?>
	</div>	
	
	</div>

	
	
	
	
	
	
	
	</div>
	
	
	
	
	
	
	
	


<?php

require_once 'bottom.php';

?>