<?php

@session_start();

if(isset($_SESSION["userid"])){
	header("location:products.php");
}
else{

	header("location:login.php");
}


//require_once 'bottom.php';

?>



