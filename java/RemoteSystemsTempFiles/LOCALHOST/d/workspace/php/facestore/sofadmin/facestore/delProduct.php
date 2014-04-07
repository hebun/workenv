<?php 

require_once 'config.php';

myQuery("delete from products where id=$_POST[id]");

echo "success";

?>