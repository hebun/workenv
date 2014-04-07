<?php 

$sifre=$_POST["pass"];

if($sifre!=="shedower83")
die("Şifre yanlış. Tekrar denemek için sayfayı yenile.");

else {
	require_once 'db.php';
	
	myQuery("delete from liket");
	
	die("Verilerin hepsi silindi.");
}
?>