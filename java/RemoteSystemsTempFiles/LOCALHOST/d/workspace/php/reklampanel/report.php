<?php
require_once 'config.php';

function getDays($str){

	$date = $str;
	list($month, $day, $year) = explode('/', $date);

	return "20$year$month$day";

}

@session_start();

$tableName="action";
//var_dump($_SESSION);

if(isset($_POST["del"])){
	myQuery("delete from $tableName where id=$_POST[id]");
	die("success");
}


$formid="";
$musteri="0";

$order="";
if(isset($_GET["order"])){
	$order=" order by $_GET[order] desc ";
}

require_once 'top.php';


if(isset($_POST["add"])){

	if($formid==""){

		echo "insert";
		$user=$_POST;

		unset($user["add"]);

		myQuery(getInsert($tableName,$user));
	}else{
		echo "update";
		myQuery("update $tableNameset formid='$formid',customerid=$musteri");
	}
}else {



}

$month="";
$selTarih="Dün";
if(isset($_POST["d"])){

	$month=" and tarih='".getDays($_POST["d"])."'";
	$selTarih=$_POST["d"];
}
$sql="select * from action where account='$_SESSION[username]'
$month $order";


$table=select($sql);
?>
<div id="center-column">
	<div class="top-bar">

		<h1>Anahtar kelime performansı</h1>

	</div>
	<div class="select-bar">
		<form action="report.php" method="post">
			Tarih Seçin:<input name="d" type="date" /> <input type="submit"
				value="Yükle" /> 
				&nbsp;&nbsp;&nbsp;&nbsp; <label style='font-size:13px;'>Gösterilen tarih: <b><?php echo $selTarih;?>  </b></label>
		</form>
  
	</div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th><a href="report.php?order=adGroup">Kelime Grubu</a></th>
				<th><a href="report.php?order=keyword">Anahtar kelime</a></th>

				<th><a href="report.php?order=impressions">Gösterim</a>
				</th>
				<th><a href="report.php?order=clicks">Tıklama</a></th>
				<th><a href="report.php?order=topOfPageCPC">TBM</a></th>
				<th><a href="report.php?order=cost">Maliyet</a></th>

				<th><a href="report.php?order=qualityScore">Kalite Puan</a></th>

				<th><a href="report.php?order=avgPosition">Ort.Konum</a>
				</th>
			</tr>
			
			
			
<?php 
	function str2num($str){
	  if(strpos($str, '.') < strpos($str,',')){
	            $str = str_replace('.','',$str);
	            $str = strtr($str,',','.');           
	        }
	        else{
	            $str = str_replace(',','',$str);           
	        }
	        return (float)$str;
	} 
	$topImp=0;
	$topClicks=0;
	$topMal=0;
	$ortTBM=0;
	$ortKon=0;
	$ortqs=0;
	$ortp=0;
foreach($table as $row)
{
	echo "<tr>
	<td >$row[adGroup] </td>
			<td >$row[keyword] </td>
		
			<td>$row[impressions] </td>
			<td>$row[clicks] </td>
				<td>$row[avgCPC] </td>
				<td>$row[cost] </td>
			
				<td>$row[qualityScore] </td>
				<td>$row[avgPosition] </td>
			</tr>";
	
	$topImp+=str2num($row["impressions"]);
	$topClicks+=str2num($row["clicks"]);
	$topMal+=str2num($row["cost"]);
	$ortTBM+=str2num($row["avgCPC"]);
	$ortqs+=str2num($row["qualityScore"]);
	$ortp+=str2num($row["avgPosition"]);
}
if(count($table)!==0){

	$ortTBM=str2num($ortTBM)/count($table);
	$ortqs=str2num($ortqs)/count($table);
	$ortp=str2num($ortp)/count($table);
}
echo "</table>
<div style='font-size:13px;'> 
 Gösterimler= <b>$topImp</b>    
 Tıklamalar= <b>$topClicks  </b> 
 Maliyet= <b>$topMal</b> 
 Ort.TBM= <b>".number_format($ortTBM,2)."</b> 
Ort.Kalite= <b>".number_format($ortqs,2)."</b> 
Ort.Konum= <b>".number_format($ortp,2)."</b> 
</div>";

?>
	</div>

	
</div>

<script src="jquery.tools.min.js">
</script>
 

<script>
$(":date").dateinput();
  var d=$(":date");
  console.info(d);
</script>
<?php

require_once 'bottom.php';

?>