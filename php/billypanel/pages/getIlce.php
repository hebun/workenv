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

$db=new Database();

if($db->open()){

	$ret=array();
	$db->query("select id,ilname from ilce where ilId=$_POST[ilId] ");

	while($row=$db->fetchAssoc()){
		$ret[]=$row;
	}

	
}
echo json_encode($ret);
?>
