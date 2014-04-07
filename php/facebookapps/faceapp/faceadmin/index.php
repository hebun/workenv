<?php
//random ads,action,image banner 300/250
//current:ads.php
$time=time();


@session_start();
if(isset($_SESSION["userid"])){
	header("location:publisher.php");
}
else{

header("location:login.php");
}

//require_once 'bottom.php';

?>



