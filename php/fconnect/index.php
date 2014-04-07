<?php 
@session_start();
?><html>
<head>
<title>Facebook app</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="style.css" rel="stylesheet" type="text/css" />
  </head>  
  <body>
  <?php
  require_once "face/facebook.php";
if(isset($_REQUEST['paid'])){
  // echo 'page id:'.$_REQUEST['paid'];	   
}

$debug=true;

//ikinci izin aktif etmek icin true olmali. obur turlu false.
$feedPermission=false;

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;

$appid="493987610649482";
$facebook = new Facebook("CURLOPT_SSL_VERIFYAUTH",
			 array(	'appId'  => "$appid",
				'secret' => 'a8a594be2ed5abafb4918f4c3b567372',
				'cookie' => true,
				));
  

$par = array();
   
$par['scope'] = "email";

/**
   set permissions
 **/
if($feedPermission) $par['scope']="publish_stream,".$par['scope'];


$loginUrl = $facebook->getLoginUrl("feed_email",$par);

$user = $facebook->getUser();

/**
check if user already  granted app. if not loginurl is called
**/
if ($user) {
  $apime=$facebook->api('/me');
  $logouturl=$facebook->getLogoutUrl();
  echo "hosgeldiniz $apime[name] <a href='$logouturl'>Logout</a>";
    $today=date('z');

   $permissions = $facebook->api("/me/permissions");
    
  }
 else {
  echo "<a href='$loginUrl'>Facebook ile baglan</a>";
}
   


?>
   <div id='fb-root'></div>
    <script src='https://connect.facebook.net/en_US/all.js'></script>

    <p id='msg'></p>

</body>
</html>
