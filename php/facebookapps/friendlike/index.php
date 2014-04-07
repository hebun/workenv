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
$par['scope'] = "read_stream";
$loginUrl=$facebook->getLoginUrl("feed_email",$par);

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
			echo 'iii';
			$days=date('z');
			$fql = "SELECT uid FROM page_fan WHERE page_id = ".$request['page']['id']." AND uid=me()";
			//$fql="SELECT uid2 FROM friend WHERE uid1 = '".$user."')";
			echo "fql:$fql";
			$fql = urlencode($fql);

			try {
				$queryResults = $facebook->api(
					'/fql?q='.$fql
				);
				print_r($queryResults);
			} catch (FacebookApiException $e) {
				print_r($e);
			}

			$apime=$facebook->api('/me/friends');
			foreach($apime['data'] as $fr){

				print_r($fr);
//				$liked=$facebook->api("/".$fr['id']."/likes/".$request['page']['id']);

			
			$likeID = $facebook->api( array( 'method' => 'fql.query', 'query' => "SELECT source_id FROM connection WHERE source_id =$fr[id] AND target_id = ".$request['page']['id']."" ) );
 
if($likeID){
    echo "TRUE<br>";
}else{
    echo "FALSE<br>";
}
			}
/*			$apime=$facebook->api('/me/friends');
			foreach($apime['data'] as $fr){

				//print_r($fr);
				$liked=$facebook->api("/".$fr['id']."/likes/".$request['page']['id']);
				echo "$fr[name] likes: ";
				print_r($liked);

			}
 */
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
