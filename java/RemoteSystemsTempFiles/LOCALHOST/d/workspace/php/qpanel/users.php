<?php
require_once 'config.php';
session_start();

//var_dump($_SESSION);
if(!isset($_SESSION["usertype"]) || $_SESSION["usertype"]!="0"){
	header("location:login.php");
}
if(isset($_POST["del"])){
	myQuery("delete from user where id=$_POST[id]");
	die("success");
}
require_once 'top.php';


if(isset($_POST["add"])){

	$user=$_POST;

	unset($user["add"]);

	myQuery(getInsert("user",$user));
}else {



}
$table=select("select * from user");

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Kullanıcılar</h1>

	</div>
	<div class="select-bar"></div>
	<div class="table">
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th>İsim/ünvan</th>
				<th>Kullanıcı Adı</th>
				<th>Şifre</th>
				<th>Rol</th>
				<th></th>
			</tr>
			
			
			
			
			
<?php 
$roles=array("Admin","Yayıncı","Müşteri");
foreach($table as $row)
{
echo "<tr>
		<td >$row[isim] </td>
		<td>$row[username] </td>
		<td>$row[password] </td>
		<td>".$roles[$row["type"]]."</td>
	 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='deleteUser($row[id])' /></td>
		
		</tr>";

}
echo "</table>";


?>
	</div>
	<div class="table">
	<form action="users.php" method="post">
		<table class="listing form" cellpadding="0" cellspacing="0">
			<tr>
				<th class="full" colspan="2">Yeni Kullanıcı Ekle</th>
			</tr>
			<tr>
				<td width="172"><strong>İsim/Ünvan</strong></td>
				<td><input type="text" name="isim" class="text" /></td>
			</tr>
			<tr>
				<td><strong>Kullanıcı Adı</strong></td>
				<td><input type="text" name="username" class="text" /></td>
			</tr>
			<tr>
				<td><strong>Şifre</strong></td>
				<td><input name="password" type="text" class="text" /></td>
			</tr>
			<tr>
				<td><strong>Rol</strong></td>
				<td><select name="type" style="width: 270px">
						<option value="0">Admin</option>
						<option value="1">Yayıncı</option>
						<option value="2">Müşteri</option>
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