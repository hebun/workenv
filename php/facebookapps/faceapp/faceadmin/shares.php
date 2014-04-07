<?php
require_once 'config.php';

@session_start();

//var_dump($_SESSION);
$dbtable="share";

if(isset($_POST["del"])){
	myQuery("delete from   ".$dbtable." where id=$_POST[id]");
	die("success");
}

require_once 'top.php';

if(isset($_POST["add"])){

	$user=$_POST;

	unset($user["add"]);
	
	//$user["code"]=str_replace("#pid#",$user["id"],$bcode);
	
	myQuery(getInsert($dbtable,$user));
	
}else {



}

$table=select("select * from $dbtable  order by id desc ");

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Paylasimlar</h1>

	</div>
	<div class="select-bar"></div>
	<div style="width:1050px;height:600px;overflow:scroll">

		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th>Mesaj</th>
				<th>Baslik</th>
				<th>Baslik etiket</th>				
				<th>Baslik url</th>
  				<th>Aciklama</th>
		                <th>Resim url</th>
    		                <th>Alt link</th>
		                 <th>Alt link url</th>
				<th>Sil?</th>
                	</tr>
			
<?php 

foreach($table as $row)
{

echo "<tr >
		<td >$row[message] </td>
		<td>$row[name] </td>
		<td>$row[caption] </td>
		<td >$row[link] </td>
		<td>$row[description] </td>
		<td>$row[picture] </td>	
		<td>$row[aname] </td>	
		<td>$row[alink] </td>	
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deleteShare($row[id])' /></td>	
		</tr>";

}
echo "</table>";

?>
	</div>

	<div class="table">
	<form action="shares.php" method="post">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="2">Yeni paylasim ekle</th>
			</tr>
			<tr>
				<td width="172"><strong>Mesaj</strong></td>
				<td><input type="text" name="message" style="width:300px;" /></td>
			</tr>
			<tr>
  <td><strong>Baslik</strong></td>
				<td><input type="text" name="name" style="width:300px;" /></td>
			</tr>			
			<tr>
  <td width="172"><strong>Baslik etiket</strong></td>
				<td><input type="text" name="caption" style="width:300px;" /></td>
			</tr>
				<tr>
				<td width="172"><strong>Baslik url</strong></td>
<td><input type="text" name="link" style="width:300px;" /></td>
			</tr>
	<tr>
				<td width="172"><strong>Aciklama</strong></td>
<td><input type="text" name="description" style="width:300px;" /></td>
			</tr>


	<tr>
				<td width="172"><strong>Resim url</strong></td>
<td><input type="text" name="picture" style="width:300px;" /></td>
			</tr>

	<tr>
				<td width="172"><strong>Alt link</strong></td>
<td><input type="text" name="aname" style="width:300px;" /></td>
			</tr>
	<tr>
				<td width="172"><strong>Alt link url</strong></td>
<td><input type="text" name="alink" style="width:300px;" /></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" Value="ekle" name="add" class="button" /></td>
			</tr>
		</table>
		</form>
	</div>
</div>
	
</div>


<?php

require_once 'bottom.php';

?>
