<?php
require_once "db.php";

/**
 * farklı anketlerde buranın değişmesi gerekecek
 */
function getCount($vote){
	
	$query="select count(0) as sayi from anketDet where vote=$vote ";
	$result=mysql_query($query);
	
	$row=mysql_fetch_assoc($result);
	return $row["sayi"];
	
}
$yes=getCount(1);
$no=getCount(2);
$yesPer=round($yes/($yes+$no)*100);
$noPer=round( 100-$yesPer);
echo "
Sitemizi beğendiniz mi?
<p align='left' style='font-size:small;'>E(%$yesPer) H(%$noPer)</p>
";


echo "
<img src='anketImg.php?yes=$yes&no=$no'/>";

?>