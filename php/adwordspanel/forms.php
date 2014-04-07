<?php
require_once 'config.php';
session_start();

//var_dump($_SESSION);
if(!isset($_SESSION["usertype"]) || $_SESSION["usertype"]!="0"){
	header("location:login.php");
}
if(isset($_POST["del"])){
	myQuery("delete from form where id=$_POST[id]");
	die("success");
}


$formid="";
$musteri="0";

if(isset($_GET["edit"])){
	$formtable=select("select * from form where id=$_GET[edit]");
	


	$formid=$formtable[0]["formid"];

	$musteri=$formtable[0]["customerid"];

}

$order="";
if(isset($_GET["order"])){
	$order=" order by $_GET[order] asc ";
}

require_once 'top.php';


if(isset($_POST["add"])){

	if($formid==""){

		echo "insert";
		$user=$_POST;

		unset($user["add"]);

		myQuery(getInsert("form",$user));
	}else{
		echo "update";
		myQuery("update form set formid='$formid',customerid=$musteri");
	}
}else {



}

$month="";
if(isset($_GET["m"])){

	$month=" and month(time)=$_GET[m] ";

}
$sql="select f.id,f.formid,(select count(0) from action as a inner join formpublisher as".
	 " fp on fp.id=a.fp where fp.formid=f.id $month) as click,u.isim as customer
			   from form as f inner join user as u on u.id=f.customerid $order
		";

//echo $sql;
$table=select($sql);
?>
<div id="center-column">
	<div class="top-bar">

		<h1>Formlar</h1>

	</div>
	<div class="select-bar">
		<div style="font-size: 16px;">
			Aya göre listele: <a href="forms.php?m=2" style="color: #43729F;">Şubat</a>
			<a href="forms.php?m=3" style="color: #43729F;">Mart</a> <a
				href="forms.php?m=4" style="color: #43729F;">Nisan</a>
		</div>

	</div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th><a href="forms.php?order=f.formid">Form id</a></th>

				<th><a href="forms.php?order=u.isim">Müşteri</a>
				</th>
				<th><a href="forms.php?order=click">Gösterim</a>
				</th>
				<th>Düzenle</th>
				<th>Sil?</th>
			</tr>
		
			
<?php 

foreach($table as $row)
{
echo "<tr>
		<td >$row[formid] </td>
	
		<td>$row[customer] </td>
		<td>$row[click] </td>
		 <td><img src='img/edit-icon.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='editForm($row[id])' /></td>
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deleteForm($row[id])' /></td>
		
		</tr>";

}
echo "</table>";


?>
	</div>
	<div class="table">
	<form action="forms.php<?php if($formid!="")echo "?edit=$_GET[edit]";?>" method="post">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="2">Yeni Form Ekle</th>
			</tr>
			<tr>
				<td width="172"><strong>Form id</strong></td>
				<td><input type="text" name="formid" class="text" value="<?php echo $formid;?>" /></td>
			</tr>
		
			<tr>
				<td><strong>Müşteri</strong></td>
				<td><select name="customerid" style="width: 270px">
				<?php

				$publishers=select("select * from user where type=2");
				$k=0;
				foreach ($publishers as $p){
					if($musteri==$k){
						echo "<option selected='selected' value='$p[id]'>$p[isim]</option>";
					}else{
						echo "<option value='$p[id]'>$p[isim]</option>";
					}
					$k++;
				}
				
				
				?></select></td>
			</tr>
		
			<tr>
				<td></td>
				<td><input type="submit" Value="<?php echo $formid==""?"Ekle":"Güncelle" ?>" name="add" class="button" /></td>
			</tr>
		</table>
		</form>
	</div>
</div>


<?php

require_once 'bottom.php';

?>