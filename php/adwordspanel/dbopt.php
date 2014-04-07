<?php 

require_once  "config.php";

$sql="delete from action where day(time)<5 ";

$res=mysql_query($sql) or die("<b>Veritabanı Hatası:</b>.\n<br />sorgu: " .
$sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());;

?>