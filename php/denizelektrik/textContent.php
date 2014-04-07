<?php

$arr=select ("select * from content where menuId=$_GET[content]");
$arrmenu=select("select name from menu where id =$_GET[content]");
//print_r($arrmenu);
$name=$arrmenu[0]["name"];
echo "<h1>$name</h1>".$arr[0]["content"];

?>