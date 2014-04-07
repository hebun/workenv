<?php

require_once  "db.php";



$name=$_GET['name'];

$days=date("z");

$result = mysql_query("update liket set count=count+1 where name='$name' and days=$days");
	
if (mysql_affected_rows()==0) {
	$result = mysql_query("insert into liket (count, name,days) values (1,'$name',$days);");
}

?>