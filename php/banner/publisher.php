<?php
require_once 'config.php';

@session_start();

//var_dump($_SESSION);
$dbtable="publisher";
if(!isAdmin()){
	header("location:login.php");
}
if(isset($_POST["del"])){
	myQuery("delete from ".$dbtable." where id=$_POST[id]");
	die("success");
}
if(isset($_POST["popup"])){
  myQuery("update publisher set popup=$_POST[wayp] where id=$_POST[id]");
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
$table=select("select p.id as pid,p.pname,p.site,p.acode ,p.popup as pop, f.* from publisher as p inner join formsize as f on f.id=p.sizeid");

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Yayıncılar</h1>

	</div>
	<div class="select-bar"></div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th>İsim</th>
				<th>Site Adresi</th>
				<th>analitics</th>
				<th>Kod</th>				
                                <th>Popup?</th>

				<th>Sil?</th>
			</tr>
			
<?php 

foreach($table as $row)
{
  $isPop=$row["pop"]=="1";
  $popText=$isPop?"Pasif Et":"Aktif Et";
echo "<tr>
		<td >$row[pname] </td>
		<td>$row[site] </td>
		<td>$row[acode] </td>
		<td>".getCode($row["pid"],$row["width"],$row["height"])."</td>
	 <td><input type='button' value='$popText' onclick='togglePopup($row[pop],$row[pid])'></input></td>
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deletePublisher($row[pid])' /></td>		
		</tr>";

}
echo "</table>";

?>
	</div>
	<div class="table">
	<form action="publisher.php" method="post">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="2">Yeni Yayıncı Ekle</th>
			</tr>
			<tr>
				<td width="172"><strong>Site İsmi</strong></td>
				<td><input type="text" name="pname" style="width:300px;" /></td>
			</tr>
			<tr>
				<td><strong>Site Adresi</strong></td>
				<td><input type="text" name="site" style="width:300px;" /></td>
			</tr>			
			<tr>
				<td width="172"><strong>Analitics Kodu</strong></td>
				<td><input type="text" name="acode" style="width:300px;" /></td>
			</tr>
				<tr>
				<td width="172"><strong>Form büyüklüğü</strong></td>
				<td>
				<select name="sizeid"> 
				
				<?php
				$sizet=select("select * from formsize");
				
				foreach($sizet as $sr){
				 echo "<option value='$sr[id]'>$sr[width]X$sr[height]</option>";
				}
				
				?>
				
				</select>
				</td>
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
