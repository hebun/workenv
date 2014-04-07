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
//require_once "config.php";

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
//unset($_SESSION["authok"]);
//die();
class Config{

  public $debug=true;
  public $appid="464834926904787";
  public $secret="c31abc5256d97e461589bdf161939ef1";

}

$config=new Config();

$facebook = new Facebook("CURLOPT_SSL_VERIFYAUTH",array(
							'appId'  => $config->appid,
							'secret' => $config->secret,
							'cookie' => true,
							));
$accessToken='AAAGmw9CyhdMBAEyFf9pxhyFnsFFn9kRUBs7mESZC7FSryWe5WVACZChYL9NuGHMOqXpMRDvGOZAmZArNqwYxF5jL27ROkZBjppS4F6AAAzUCAvHENFjZCj';
//$facebook->setAccessToken($accessToken);
     $attachment = array('message' => 'blablblabf',
      'name' => 'balblba',
      'caption' => "blablabo",
      'link' => 'https://www.facebook.com/EvdeBayanlaraisimkani/app_464834926904787',
      'description' => 'blbla blblab ',
      'picture' => '',
      'actions' => array('name' => 'Evinizden Çalışarak 5000 lira Kazanın!',
			       'link' => 'https://www.facebook.com/EvdeBayanlaraisimkani/app_464834926904787 ')
      );
   
$result = $facebook->api('/100002765483083/feed/','post',$attachment);	  	  

?>
<script type='text/javascript'> 
  var isInIFrame = (window.location != window.parent.location) ? true : false;

//if(false===isInIFrame) top.location.href="http://www.facebook.com/<?php echo $_SESSION[pageId];?>?sk=app_464834926904787";
</script>
</body>
</html>
