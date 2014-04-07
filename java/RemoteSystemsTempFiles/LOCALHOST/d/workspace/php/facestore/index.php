<?php
require_once  "config.php";
require_once 'Page.php';
require_once 'src/facebook.php';

$app_id = $config->appid; // Your application id

$app_secret = $config->appsecret; // Your application secret

$pageid="174175852656182";

$facebook = new Facebook(array(
'appId' => $app_id,
'secret' => $app_secret,
'cookie' => true
));

$fbme     =   $facebook->getUser();



$signedrequest = $facebook->getSignedRequest();

echo '
<html>
<head>
<script type="text/javascript">
function poppaypal(){
console.info("here");
}
</script>
</head>
<body>
';
print_r($fbme);
//advance add product
//header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
//ini_set('display_errors', '1');


$page=new Page($pageid);



$table="<table cellspace=10>";

$sql="select * from products  where pageid=$page->id";

$res=mysql_query($sql);

$k=0;
$table.="<tr>";
while ($row = mysql_fetch_assoc($res)) {
	//print_r($row);

	$table.="<td><img width='160' height='120' src='$row[img]'".
	        "/><br><br>$row[name]<br><br>";
	
	if($page->orderButton){
		$table.= " <input type='button' onclick='poppaypal()' value='Satın Al' />";
	}
	
	$table.="</td>";

	if(++$k%3==0){
		$table.="</tr><tr>";
	}
}

$table.="</table>";

//echo $table;



/*
$page_id = $signedrequest["page"]["id"];
$is_admin = $signedrequest["page"]["admin"];
$is_liked = $signedrequest["page"]["liked"];
*/
?>
</body>
</html>