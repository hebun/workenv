<?php
require_once 'config.php';
session_start();

//var_dump($_SESSION);
if(!isset($_SESSION["usertype"]) || $_SESSION["usertype"]!="0"){
	header("location:login.php");
}
if(isset($_POST["del"])){
	myQuery("delete from site where id=$_POST[id]");
	die("success");
}
require_once 'top.php';


if(isset($_POST["add"])){

	$user=$_POST;

	unset($user["add"]);

	myQuery(getInsert("site",$user));
}else {



}
$table=select("select * from site");

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Kullanıcılar</h1>

	</div>
	<div class="select-bar"></div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th>Site</th>
				<th>Kelime(ler)</th>
			<th>Bugün</th>
				<th>Dün</th>
				<th>Sil</th>
			
			</tr>
			
<?php 

foreach($table as $row)
{
	
	$days=date("z");
	$tcount=select("select count(0) as say,days from actionp where days=$days and siteid=$row[id]");
	$count=$tcount[0]["say"];
	$tcount=select("select count(0) as say,days from actionp where days+1=$days and siteid=$row[id]");
	$count2=$tcount[0]["say"];
	
echo "<tr>
		<td >$row[site] </td>
		<td>$row[words] </td>
		<td>$count</td>
		<td>$count2</td>
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deleteSite($row[id])' /></td>
		
		</tr>";

}
echo "</table>";

?>
	</div>
	<div class="table">
	<form action="plugin.php" method="post">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="2">Yeni Site Ekle</th>
			</tr>
			<tr>
				<td width="172"><strong>Site</strong></td>
				<td><input type="text" name="site" class="text" /></td>
			</tr>
			<tr>
				<td><strong>Kelime(ler)</strong></td>
				<td><input type="text" name="words" class="text" /></td>
			</tr>
		
			<tr>
				<td></td>
				<td><input type="submit" Value="ekle" name="add" class="button" /></td>
			</tr>
		</table>
		</form>
	</div>
</div>


<?php

require_once 'bottom.php';

?>