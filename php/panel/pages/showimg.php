<?php

session_start();
if(!(isset($_SESSION['adm_logged']) && ($_SESSION['adm_logged'] == true))){
	header("Location: index.php");
	exit;		              
}
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/settings.inc.php");
require_once("../inc/functions.inc.php");

$id=$_GET['id'];
$db=new Database();

if($db->open()){

	$db->query("select file,file1 from control where id=$id");
	$row=$db->fetchAssoc();
	echo "<img style='border: 1px solid; ' src='../upload/$row[file]' /><br><br><img  style='border: 1px solid; ' src='../upload/$row[file1]' />";

}

?>
