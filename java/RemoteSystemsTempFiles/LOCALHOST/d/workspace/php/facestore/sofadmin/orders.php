<?php
require_once 'config.php';
session_start();


if(isset($_POST["del"])){
	myQuery("delete from orders where id=$_POST[id]");
	die("success");
}


$formid="";
$musteri="0";



$order="";
if(isset($_GET["order"])){
	$order=" order by $_GET[order] asc ";
}else {
	$order=" order by id desc ";
}

require_once 'top.php';



$sql="select *  from orders $order";

//echo $sql;
$table=select($sql);
?>
<div id="center-column">
	<div class="top-bar">

		<h1>Siparişler</h1>

	</div>
	<div class="select-bar">
		Sütun başlıklarına tıklayarak sıralama yapabilirsiniz.

	</div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th><a href="orders.php?order=id">Sipariş İd</a></th>

				<th><a href="orders.php?order=namesurname">Ad-Soyad</a>
				</th>
				<th><a href="orders.php?order=tel">Telefon</a>
				</th>
				
				<th>Sil?</th>
			</tr>
		
			
<?php 

foreach($table as $row)
{
echo "<tr>
		<td >$row[id] </td>
	
		<td>$row[namesurname] </td>
		<td>$row[tel] </td>
		
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deleteOrder($row[id])' /></td>
		
		</tr>";

}
echo "</table>";


?>
	</div>
	<div class="table">
	
	</div>
</div>


<?php

require_once 'bottom.php';

?>