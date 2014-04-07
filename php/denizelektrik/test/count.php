<?php

require_once  "../db.php";	

$name=$_GET['name'];

$sel=mysql_query("select * from liket where name=$name");

$result = mysql_query("update liket set count=count+1 where name='$name'");		 
if (mysql_affected_rows()==0) {
	$result = mysql_query("insert into liket (count, name) values (1,'$name');");
}

?>