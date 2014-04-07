<?php
@session_start();
?>
<html>
<head>
<title>Admin</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
   </head>
   <body>
<?php
require_once "face/facebook.php";
require_once "config.php";

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
//unset($_SESSION["authok"]);
//die();
$facebook = new Facebook("CURLOPT_SSL_VERIFYAUTH",array(
	'appId'  => $config->appid,
	'secret' => $config->secret,
	'cookie' => true,
));
echo 'xxx';
$request = $facebook->getSignedRequest();
$loginUrl=$facebook->getLoginUrl("feed_email");

if(!$request['page']['liked'] and false)
{
	////echo 'bbb';
	require_once 'begen.php';
}

else{

	echo 'ccc';
	if(isset($_REQUEST['installed'])){
		// print_r($_REQUEST);
		die();
	}
	echo 'dddn';
	$user = $facebook->getUser();
	$par = array();
	echo 'eee';
	$par['scope'] = "";

	echo 'fff';
	if ($user) {

		echo 'ggg';
		$_SESSION["authok"]="true";

		try {
			$code=rand(0,999999);
			$userInfo=$facebook->api('/me');
			$sels=select("select code from faceuser where uid=$user");
			if(count($sels)>0)
			{
				echo "kodunuz: ".$sels[0]['code'];
			}
			else {
				myQuery(getInsert('faceuser',array("uid"=>$user,"code"=>$code,"name"=>$userInfo['name'])));

				echo "kodunuz : ".$sels[0]['code'];
			}
			}
				catch (FacebookApiException $e) {
					echo "exception threw:$e";
					$user = null;
				}
				echo 'mmm';
			}
			else {
				echo 'nnn';

				echo "	<script type='text/javascript'>
					top.location.href='$loginUrl';
	</script>";

    }
  echo 'vvv';
}

?>
<script type='text/javascript'> 

</script>
</body>
</html>
