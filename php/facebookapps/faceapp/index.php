<html>
<head>
<title>Admin</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
require_once "face/facebook.php";
require_once "config.php";

@session_start();

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
//unset($_SESSION["authok"]);
//die();
$facebook = new Facebook(array(
			       'appId'  => $config->appid,
			       'secret' => $config->secret,
			       'cookie' => true,
			       ));
$request = $facebook->getSignedRequest();
if($request['page']['id'])
  myQuery("update curpage set page='".$request['page']['id']."' where id=1");

if(!$request['page']['liked'])
  {
    //echo 'www';
    require_once 'begen.php';
  }

else{
  //echo 'eee';
  $signed=$_REQUEST["signed_request"];

  if(isset($_SESSION["authok"])){
    //echo 'rrr';
    if(isset($_SESSION["unpermed"])){
      unset($_SESSION["unpermed"]);
      //      header("location:http://www.facebook.com/$request[page][id]?sk=app_458778440845511");
    }else{
      // echo 'ttt';

      $ip=$_SERVER['REMOTE_ADDR'];
      $apime=$facebook->api('/me');
    myQuery("insert ignore into fmail(email,name,surname) values ('$apime[email]','$apime[first_name]','$apime[last_name]')");
      $day=date('z');
      $ipSql="select * from visits where email='$apime[email]' and comp=$day";

      $tbl=select($ipSql);
      // print($ipSql);
      if(count($tbl)>0 )
	{
	  echo '<script type=\'text/javascript\'> 

    top.location.href="https://www.facebook.com/Uzmandoktorum/app_148382711979856";

</script>';
	  require_once 'sonuc.php';
	  //echo 'Zaten katildiniz.';
	}else{
	    
	$curuser=array($apime);	    

	$inserted=8;//iptal

	require_once 'fbform.php';
      }
    }

  }else{

    if(isset($_REQUEST['installed'])){
      // print_r($_REQUEST);
    die();
  }
    
    $user = $facebook->getUser();
    $par = array();

    $par['scope'] = "publish_stream,email";

    $loginUrl = $facebook->getLoginUrl($par);

    if ($user) {

    $permissions = $facebook->api("/me/permissions");
    if( array_key_exists('publish_stream', $permissions['data'][0]) ){


    $_SESSION["authok"]="true";
    /*
    $attachment = array('message' => 'Ücretsiz Ozon Kremi Kampanyasından Faydalandı',
      'name' => 'Sağlık Sorunlarınızı Uzmanlarıyla Görüşün',
      'caption' => "Mustafa Eraslan Bitkisel Destek Ürünleri",
      'link' => 'https://www.facebook.com/Uzmandoktorum/app_458778440845511',
      'description' => 'Sağlık Sorunlarınızı Uzmanlarımızla Paylaşın, 79TL Değerindeki Ozon Kremine Ücretsiz Sahip Olun. '.date("d.M.Y h:i"),
      'picture' => 'http://www.bitkiblog.com/bb/ozonkremi.jpg',
      'actions' => array('name' => 'Kampayaya KATIL',
			       'link' => 'https://www.facebook.com/Uzmandoktorum/app_458778440845511 ')
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
    $apime=$facebook->api('/me');
    $days=date('z');
    myQuery("insert ignore into fmail(email,name,surname,days) values ('$apime[email]','$apime[first_name]','$apime[last_name]',$days)");
    if(!isset($_SESSION["posted"])){


    // Proceed knowing you have a user who is logged in and authenticated
    $result = $facebook->api('/me/feed/','post',$attachment);	  	  

    $_SESSION["posted"]="true";

    /*	echo "<script type='text/javascript'>
	top.location.href='https://www.facebook.com/Uzmandoktorum/app_148382711979856';
	</script>";    */

    require_once 'fbform.php';
  }
  } catch (FacebookApiException $e) {
    echo "exception threw:$e";
    $user = null;
  }

  }
    else {

    $_SESSION["unpermed"]="true";

    echo "	<script type='text/javascript'>
		top.location.href='$loginUrl';
	</script>";
  }
  } else {
    echo "<script type='text/javascript'>
		top.location.href='$loginUrl';
		</script>";
  }
  }
  }
    $curpage=selectOne('curpage','page','id','1');

// echo "curpage=$curpage";

 ?>
    <script type='text/javascript'> 
      var isInIFrame = (window.location != window.parent.location) ? true : false;

    if(false===isInIFrame) top.location.href="http://www.facebook.com/<?php echo $curpage?>?sk=app_458778440845511";
    </script>
</body>
</html>
