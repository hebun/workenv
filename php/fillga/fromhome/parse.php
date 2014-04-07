<?php
//error_reporting(E_ERROR);
function fillDb($type)
{

	$monts=array("Oca"=>1,"Şub"=>2,"Mar"=>3,"Nis"=>4,"May"=>5,"Haz"=>6,"Tem"=>7,"Ağu"=>8,"Eyl"=>9,"Eki"=>10,"Kas"=>11,"Ara"=>12);

	$xml=simplexml_load_file("upload/$type.xml");

	//print_r($xml);
	//
	//
	$date=$xml["dateRange"][0];
	$darr=explode(' ',$date);
	$dateint=Dapi::getTwoDigit($darr[2])."".Dapi::getTwoDigit($monts[$darr[1]])."".Dapi::getTwoDigit($darr[0]);

	$dapi=new Dapi();
	if($type=='gorsel')
	{
		$dapi->fillgaPrepareGorsel();
	}
	elseif($type=='hesap'){

		$dapi->fillgaPrepareHesap();

	}else
		$dapi->fillgaPrepare();

	foreach ($xml->table->row as $row) {
		if($row['clicks']=="0") continue;
		$row['tarih']=$dateint;
		$cid=intval(substr(str_replace("-","",$row['customerID']),-7));
		$row['customerId']=9999999-$cid;
		echo $row['customerId']."-"."$cid .";
		if($type=='gorsel'){
			$dapi->fillgaCallSpWithArrayGorsel($row->attributes());
		}elseif($type=='hesap'){

			$dapi->fillgaCallSpWithArrayHesap($row->attributes());
			

		}else
			$dapi->fillgaCallSpWithArray($row->attributes());
	}
}
?>
