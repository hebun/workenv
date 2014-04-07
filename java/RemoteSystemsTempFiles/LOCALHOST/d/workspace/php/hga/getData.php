<?php
require_once 'config.php';
header('Content-Type: text/html; charset=utf-8');
$site="";

$word="";
$days=date("z");

$ip=$_SERVER["REMOTE_ADDR"];

$table=select("select * from site ");

$okSites=array();

foreach ($table as $row){

	$atable=	select("select * from actionp where siteid=$row[id] and days=$days and ip='$ip' and 1=1");
	if(count($atable)==0){
		$site=$row["site"];
		$words=explode(",",$row["words"]);
		$word=$words[0];
		$okSites[]=array("site"=>$site,"word"=>$word,"siteid"=>$row["id"]);
			
	}

}
$ind=rand(0,count($okSites));
$okRow=$okSites[$ind];
myQuery(getInsert("actionp",array("siteid"=>$okRow["siteid"],"days"=>$days,"ip"=>$ip)));

$site=$okRow["site"];
$word=$okRow["word"];

echo "{\"site\":\"$site\",\"word\":\"$word\",\"code\":\"upcontrole()\"}";

?>