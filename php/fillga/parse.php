<?php
error_reporting(E_ERROR);
require_once "config.php";

$monts=array("Oca"=>1,"Şub"=>2,"Mar"=>3,"Nis"=>4,"May"=>5,"Haz"=>6,"Tem"=>7,"Ağu"=>8,"Eyl"=>9,"Eki"=>10,"Kas"=>11,"Ara"=>12);

$xml=simplexml_load_file("upload/file2.xml");

//print_r($xml);
//
//
$date=$xml["dateRange"][0];
$darr=explode(' ',$date);
$dateint=Dapi::getTwoDigit($darr[2])."".Dapi::getTwoDigit($monts[$darr[1]])."".Dapi::getTwoDigit($darr[0]);

print_r($darr);
echo $dateint;
$dapi=new Dapi();
$dapi->fillgaPrepare();

foreach ($xml->table->row as $row) {
	if($row['clicks']=="0") continue;
//	print_r($row);
	$row['tarih']=$dateint;
	$dapi->fillgaCallSpWithArray($row->attributes());
}
?>
