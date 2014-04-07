<?php
require_once 'config.php';
session_start();

//var_dump($_SESSION);
if(!isset($_SESSION["usertype"]) || $_SESSION["usertype"]!="2"){
	header("location:login.php");
}

require_once 'top.php';


$month=" and month(time)=".date("m");
if(isset($_GET["m"])){

	$month=" and month(time)=$_GET[m] ";

}
$sql="select f.id,f.formid
	,DATE_FORMAT(a.time, '%d.%m.%Y') as time,count(a.id) as click 
	from form as f inner join user as u on u.id=f.customerid 

	inner join formpublisher as fp on fp.formid=f.id
	INNER JOIN action as a on a.fp=fp.id
	where f.customerid=$_SESSION[userid] $month 

	GROUP BY month(time) ";

//echo $sql;
$table=select($sql);
?>
<div id="center-column">
	<div class="top-bar">

		<h1>Gösterimler</h1>

	</div>
	<div class="select-bar">
		<div style="font-size:16px;" >
			Aya göre listele: <a href="gosterim.php?m=2" style="color: #43729F;">Şubat</a> 
			<a href="gosterim.php?m=3" style="color: #43729F;">Mart</a>
			<a href="gosterim.php?m=4" style="color: #43729F;">Nisan</a>
			</div>
		
	</div>
	
	
	<div class="table">
	
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
								
				<th>Tarih</th>
				<th>Gösterim</th>
				
			</tr>
			
			
			
<?php 
$total=0;
foreach($table as $row)
{
echo "<tr>
		<td >$row[time] </td>
		
		<td>$row[click] </td>
	 
		
		</tr>";
$total+=$row["click"];
}
echo "
<tr><td>Toplam:</td><td>$total</td></tr>
</table>";


?>
	</div>

</div>


<?php

require_once 'bottom.php';

?>