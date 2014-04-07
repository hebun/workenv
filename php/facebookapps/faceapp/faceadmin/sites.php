<?php
require_once 'config.php';
@session_start();

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
$category="";
if(isset($_GET["sid"])){

	$sid=$_GET["sid"];
	$siterow=select("select * from sites where id=$sid");
	$siterow=$siterow[0];
	$title=$siterow["title"];
	$content=$siterow["content"];
	$showurl=$siterow["showurl"];
	$targeturl=$siterow["targeturl"];
	$category=$siterow["category"];
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
$table=select("select s.sname,s.id,s.title,s.content,s.showurl,s.targeturl,s.category,count(a.id) as say from sites as s left join action as a on a.siteid=s.id  group by s.id,s.title,s.content,s.showurl,s.targeturl");

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Kampanyalar</h1>

	</div>
	<div class="select-bar"></div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
			<th >İsim</th>
				<th>Başlık</th>

				
				<th width="20%">Görünen Url</th>
				<th>Kategori</th>
				<th>Tık.</th>
				<th>Düz.</th>
				<th>Sil</th>
			</tr>
			
			
<?php 

foreach($table as $row)
{
echo "<tr>
<td >$row[sname] </td>
		<td >$row[title] </td>
		
		
		<td width='20%'>$row[showurl] </td>
		<td width='5%'>$row[category] </td>
		<td>$row[say] </td>
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
				<td width="172"><strong>İsim</strong></td>
				<td><input type="text" value="<?php echo $title;?>" id="tsname" name="sname"  style="width:300px;" /></td>
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
			</tr>			
				<tr>
				<td><strong>Kategori</strong></td>
				<td><input type="text" name="category" style="width:300px;" value="<?php echo $category;?>"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" Value="<?php echo isset($_GET["sid"])?"Güncelle":"Ekle" ?>" name="add" class="button" /></td>
			</tr>
		</table>
		</form>
	</div>
	<br>
	<br>
<?php
echo "<div class='table'  style='border:1px blue solid;width:300;height:53px;padding-left:4px;padding-top:4px;'>
	
	<div style='color:blue;font-weight: bold;font-family: fantasy, cursive, Serif;font-size:14px;'  >
	<a target='_blank' id='ptitle' href='action.php?adid=$row[id]&pid=1' style='color:blue'>
	  $title	</a>
	 <span style='color:red;font-family: fantasy, cursive, Serif;font-weight: normal;font-size:11px;' id='pshowurl'>
	  <a target='_blank' href='action.php?adid=$row[id]&pid=1' style='color:red'>$showurl</a>
	</span>
	</div>
		
	<div style='font-size:14px;' id='pcontent'>
	 $content
	</div>
	
	</div>";
?>

	</div>
	

<?php

require_once 'bottom.php';

?>