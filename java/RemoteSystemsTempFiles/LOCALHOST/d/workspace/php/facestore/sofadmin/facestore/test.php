<?php
require_once 'Dbtool.php';

$arr=array("id"=>"1","colum"=>"asdfas");

echo Dbtool::getUpdate("testable",$arr,"name","ismet");

?>
