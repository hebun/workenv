<?php 
require_once 'config.php';

$ret=select("select id from cip where ip='".$_SERVER["REMOTE_ADDR"]."'");
if(count($ret)>0)
 die("Sadece bir kere indirim kuponu alabilirsiniz.");

$ret=select("select code from ccodes order by rand() limit 0,1");

echo $ret[0]["code"];

myQuery(getInsert("cip",array("ip"=>$_SERVER["REMOTE_ADDR"])));

?>