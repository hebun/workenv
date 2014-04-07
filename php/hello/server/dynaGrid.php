<?php
//button icon
ini_set('display_errors','On');
error_reporting(E_ALL);
require_once 'config.php';
require_once 'GridApi.php';

$grid=new GridApi(6,"select * from product") ;

echo $grid->getJson();

?>