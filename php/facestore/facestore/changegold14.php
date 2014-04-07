<?php 
require_once 'config.php';

function myQuery($query){

	mysql_query($query) or die("<b>Veritabanı Hatası:</b>.\n<br />Query: " .
	$query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
}

if(!isset($_GET["auth"]))
 die("unauthorized!");

if($_GET["auth"]!="adminipekvera28")

die("unauthorized!!!");
 
if(!isset($_GET["newvalue"]))
	die("unauthorized!!");

$sql="update constants set `value`='$_GET[newvalue]' where `key`='gold14'";

myQuery($sql);

echo "updated constans..";

$sql="update products set price=consprice*$_GET[newvalue]/100";

myQuery($sql);

echo "<br> updated products...";

?>