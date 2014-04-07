<?php
require_once 'config.php';
session_start();

//var_dump($_SESSION);
if(!isset($_SESSION["usertype"]) || $_SESSION["usertype"]!="0"){
	header("location:login.php");
}
if(isset($_POST["del"])){
	myQuery("delete from formpublisher where id=$_POST[id]");
	die("success");
}
require_once 'top.php';

$order="";
if(isset($_GET["order"])){
	$order=" order by $_GET[order] asc ";
}


if(isset($_POST["add"])){

	$user=$_POST;

	unset($user["add"]);

	myQuery(getInsert("formpublisher",$user));
}else {



}

$tmonth=date("m");
$tday=date("d");
$tyear=date("Y");

$month="";
if(isset($_GET["m"])){

	$month=" and month(time)=$_GET[m] ";

}elseif(isset($_GET["d"])){

	if($_GET["d"]=="b" )
	$month=" and year(time)=$tyear and month(time)=$tmonth and day(time)=$tday ";
	else if($_GET["d"]=="d" ){
		
		$tday=$tday-1;
		$month=" and year(time)=$tyear and month(time)=$tmonth and day(time)=$tday ";
	    
	}
}

$sql="select fp.id as fpid,f.*,p.*,(select count(0)  from action where fp=fp.id $month) as click from".
" formpublisher as fp inner join user as p on p.id=fp.publisherid inner join".
" form as f on f.id=fp.formid where p.type=1  $order";

//echo $sql;
$table=select($sql);
?>
<div id="center-column">
	<div class="top-bar">

		<h1>Form-Yayıncı</h1>

	</div>
	<div class="select-bar">
		<div style="font-size: 16px;">
			Güne göre listele: <a href="formpublisher.php?d=b"
				style="color: #43729F;">Bugün</a> <a href="formpublisher.php?d=d"
				style="color: #43729F;">Dün</a>
		</div>

	</div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th><a href="formpublisher.php?order=f.formid">Form id</a></th>

				<th><a href="formpublisher.php?order=p.isim">Yayıncı</a>
				</th>
				<th><a href="formpublisher.php?order=click">Gösterim</a></th>
				<th>Sil?</th>
			</tr>
			
			
			
			
			
			
			
			
			
<?php 

foreach($table as $row)
{
echo "<tr>
		<td >$row[formid] </td>
	
		<td>$row[isim] </td>
		<td>$row[click] </td>
		
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deleteFormpublisher($row[fpid])' /></td>
		
		</tr>";

}
echo "</table>";


?>
	</div>
	<div class="table">
	<form action="formpublisher.php" method="post">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="2">Yeni  Ekle</th>
			</tr>
			<tr>
				<td width="172"><strong>Form id</strong></td>
				<td><select name="formid" style="width: 270px">
				<?php

				$publishers=select("select * from form");
				
				foreach ($publishers as $p){
					
					echo "<option value='$p[id]'>$p[formid]</option>";
				}
				
				
				?></select></td>
			</tr>
		
			<tr>
				<td><strong>Yayıncı</strong></td>
				<td><select name="publisherid" style="width: 270px">
				<?php

				$publishers=select("select * from user where type=1");
				
				foreach ($publishers as $p){
					
					echo "<option value='$p[id]'>$p[isim]</option>";
				}
				
				
				?></select></td>
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