<?php 
require_once 'config.php';
require_once 'Dbtool.php';

$bigimg=Dbtool::selectOne("products","bigimg","id",$_GET["pid"],false);

echo "<table border='1' ><tr><td><div align='center'><img align='center' src='$bigimg' /></div></td>".
		"<td valign='top'><INPUT type='button' value='Click here to go back' onClick='history.back()'> </td></tr></table>";
$moves=array("ip"=>$_SERVER["REMOTE_ADDR"],"move"=>"bigimg->$_GET[pid]","moveid"=>"1");

Dbtool::myQuery(Dbtool::getInsert("moves",$moves));
?>
