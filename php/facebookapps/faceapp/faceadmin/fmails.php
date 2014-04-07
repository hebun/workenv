<?php
require_once 'config.php';

@session_start();

//var_dump($_SESSION);
$dbtable="fmail";

if(isset($_POST["del"])){
  myQuery("delete from   ".$dbtable." where id=$_POST[id]");
  die("success");
}

require_once 'top.php';

if(isset($_POST["add"])){

  $user=$_POST;

  unset($user["add"]);

  $user["pid"]=1;
	
  myQuery(getInsert($dbtable,$user));
	
}else {

}
$selectedDay=isset($_GET['day'])?$_GET['day']:date('z');
$table=select("select (id-4) as id ,name,surname from $dbtable where days=$selectedDay   order by id desc ");

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Mailler</h1>

	</div>
	<div class="select-bar">
Gün Seçin:
  <select id='days' onchange='goDayMails(this.value)'>
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
	<div style="width:1070px;height:600px;overflow:scroll">

		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>

<th>Sira</th>				<th>E-mail</th>
				<th>Ad</th>
				<th>Soyad</th>				

				<th>Sil?</th>
                	</tr>
			
<?php 

foreach($table as $row)
{

echo "<tr >
		<td >$row[id] </td>
		<td >$row[email] </td>
		<td>$row[name] </td>
		<td>$row[surname] </td>

	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='dynaDelete($row[id],\"fmails\")' /></td>	
		</tr>";

}
echo "</table>";

?>
	</div>

</div>
	
</div>


<?php

require_once 'bottom.php';

?>
