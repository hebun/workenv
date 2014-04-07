<?php

mysql_query("delete from $_GET[table] where id=$_GET[id]");

header("location:adminMain.php?page=$_GET[ref]");

?>