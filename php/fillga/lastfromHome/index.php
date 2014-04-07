<?php 
@session_start();

if(isset($_SESSION['userid'])){
header('location:campaigns.php');

}else{

header('location:login.php');

}
?>
