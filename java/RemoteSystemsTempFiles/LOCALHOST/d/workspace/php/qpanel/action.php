<?php

require_once  "config.php";

$debug=true;

$name=$_GET['form'];
$p=$_GET["pusblisher"];

$sql="select fpid from fp where fid='$name' and username='$p'";
if($debug)
echo $sql;

$res=mysql_query($sql) or die("<b>Veritabanı Hatası:</b>.\n<br />sorgu: " .
$sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());;

$row = mysql_fetch_assoc($res);

$fpid= $row["fpid"];

$days=date("Y-m-d H:i:s");

	$result = myQuery("insert into action (fp, time) values ('$fpid','$days');");


?>