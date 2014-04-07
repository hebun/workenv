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

$code='4Gr7843xd';

@session_start();

//Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
//Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
//unset($_SESSION["authok"]);
//die();
$facebook = new Facebook(array(
			       'appId'  => '4737479209612025',
			       'secret' => '8286aea9942394873791eabbe6ac6716',
			       'cookie' => true,
			       ));
$request = $facebook->getSignedRequest();

if(!$request['page']['liked'] )
  {
echo "Kupon Kodunuz: $code";
  }else{

echo ' <img src="banner90.jpg" width="800" height="140"> ';

  }
?>
</body>
</html>
