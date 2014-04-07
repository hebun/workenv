<html>
<head>
<title>Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<body>
<?php
require_once "face/facebook.php";

/*$codes=array(
	'4SwxHhGR',
	'w8f3i7zA',
	'T6MLs3iD',
	'e3pjG6Lr',
	'kJx6J68r',
	'gMg3CpL8',
	'nyX47rDs',
	'Qz2n3U5h',
	'Ru9e4v9j',
	'MZ95Lmsu');*/
$codes=array('face02','face13','face24','face35','face49','face56','face68','face77','face81','face90');
$r=rand(0,9);
@session_start();

//Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
//Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
//unset($_SESSION["authok"]);
//die();
$facebook = new Facebook(array(
			       'appId'  => '737479209612025',
			       'secret' => '8286aea9942394873791eabbe6ac6716',
			       'cookie' => true,
			       ));
$request = $facebook->getSignedRequest();

if($request['page']['liked'] )
  {
echo "<span align='right' style='font-size:18pt;'>".$codes[$r]."</span>";
  }else{

echo ' <img src="begenkazan.jpg" width="800" height="140"> ';

  }
?>
</body>
</html>
