<?php
require_once 'config.php';

@session_start();

//var_dump($_SESSION);
$dbtable="visits";

if(isset($_POST["del"])){
	myQuery("update  ".$dbtable." set del=1 where id=$_POST[id]");
	die("success");
}


require_once 'top.php';

$selectedDay=isset($_GET['day'])?$_GET['day']:date('z');

$table=select("select * from visits where comp=$selectedDay and del=0 order by id desc  ");

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Sorular</h1>

	</div>
	<div class="select-bar">
  Gün Seçin:
<select id='days' onchange='goDay(this.value)'>
<?php 
  $today=intval(date('z'));
for($ind=$today;$ind>39;$ind--){

  $va=$ind;
  $isSelect=$ind==$selectedDay?' selected ':'';
  echo "<option value='$va' $isSelect >".getDateFromDay($va,2013)->format('d-m-Y')."</option>";
} 
?> 
</select>
&nbsp; Toplam Kayit: <?php 
echo count($table);
?> 
</div>
	<div style="height:600;width:1070px;overflow:scroll">

		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th>Sira</th>
	<th>İsim</th>
				<th>Soyisim</th>
				<th>Telefon</th>
				<th>Email</th>				
                                <th>Adres</th>
                                <th>Referans</th>
				<th>Soru</th>
				<th>Sonuc</th>
				<th>Sil?</th>
			</tr>
			
<?php 

foreach($table as $row)
{
  $isPop=$row["pop"]=="1";
  $popText=$isPop?"Pasif Et":"Aktif Et";
  $background=$row['vis_sonuc']=='KAZANDINIZ'?'#FFF000':'#FFFFFF';
  $nid=intval($row['id'])-176;
echo "<tr style=\"font-size:10px;\" bgcolor=\"$background\">

		<td >$nid </td>
		<td >$row[fname] </td>
		<td>$row[fsurname] </td>
		<td>$row[ftel] </td>
		<td >$row[femail] </td>
		<td>$row[fadres] </td>
		<td>$row[fref] </td>
		<td>$row[fsoru] </td>	
		<td>$row[vis_sonuc] </td>
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deletePublisher($row[id])' /></td>	
		</tr>";

}
echo "</table>";

?>
	</div>
	
</div>


<?php

require_once 'bottom.php';

?>
