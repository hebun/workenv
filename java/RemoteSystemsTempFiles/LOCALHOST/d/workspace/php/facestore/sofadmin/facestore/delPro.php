<?php 
require_once 'config.php';
if(isset($_GET["id"])){
	
	myQuery("delete from products where id=$_GET[id]");
}
?>