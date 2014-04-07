<?php 
require_once 'config.php';
require_once 'Dbtool.php';

$bigimg=Dbtool::selectOne("products","bigimg","id",$_GET["pid"],false);

echo "<div align='center'><img align='center' src='../../$bigimg' /><br><br>&nbsp;<br><input type='button'  onclick='parent.TINY.box.hide()' value='Kapat' /></div>";
$moves=array("ip"=>$_SERVER["REMOTE_ADDR"],"move"=>"bigimg->$_GET[pid]","moveid"=>"1");

Dbtool::myQuery(Dbtool::getInsert("moves",$moves));
?>
