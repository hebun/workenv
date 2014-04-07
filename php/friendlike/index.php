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
require_once "dapi.php";
require_once "bblog.php";
if(isset($_REQUEST['paid'])){
  // echo 'page id:'.$_REQUEST['paid'];	   
}

$debug=true;

//ikinci izin aktif etmek icin true olmali. obur turlu false.
$feedPermission=true;

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;


$facebook = new Facebook("CURLOPT_SSL_VERIFYAUTH",
			 array(	'appId'  => '348286278614680',
				'secret' => 'bd270d3c38e902642034fd9ddc961297',
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
  $wpid='';
  $refuid='';

  /**
     get app paremeters: paid:page id. uid:user facebook id
   **/
  if(isset($_REQUEST['paid'])){
    $wpid="?p=$_REQUEST[paid]";
  }
  if(isset($_REQUEST['uid'])){
    $refuid=$_REQUEST['uid'];

  }

  $today=date('z');

  $insdp=new Dapi(false);
  /**
     insert unique user..
   **/
  $rs=$insdp->select('uid')->from('faceuser')->where("uid='$apime[id]'")->getArray();
  
  if(count($rs)==0) {
    $insdp->reset();
    $insdp->insert(array("fname"=>"$apime[name]",
			 "uid"=>$apime['id'],
			 "email"=>$apime['email'],
			 'refuid'=>$refuid,
			 'days'=>$today,
			 'facemail'=>$apime['username'],
			 '`all`'=>json_encode($apime),
			 ))->into('faceuser')->execGetId();
  }

  
  /**
     get friend count and print top bar.
  **/
  $dp=new Dapi(false);
  $fcount=$dp->select('count(0) as say')->from('faceuser')->where("refuid='$apime[id]'")->getArray();

  printBar($apime['name'],$fcount['say'],$apime['id']);

  /* iframe content */
  echo "<iframe frameborder=no id='contentframe' width=1070 height=525 src='http://www.bitkiblog.com/$wpid'></iframe>";
      
  
  /* get user feed count */
  $feed=new Dapi(false);
  
  $arrfeed=$feed->select('id')->from('facefeed')->where(array('uid'=>$apime['id'],'days'=>$today))->getArray();

  /* if user hasnt already feeded and feedpermission is set*/
  if(count($arrfeed)==0 and $feedPermission){ 

    $feed->reset();
    $feed->insert(array('uid'=>$apime['id'],'days'=>$today))->into('facefeed')->execGetId();


    $permissions = $facebook->api("/me/permissions");
    $feed=new Dapi(false);

    if( array_key_exists('publish_stream', $permissions['data'][0])) {
      $_SESSION["authok"]="true";

      $dapi=new Dapi(false);
 
      /* get random share content*/
      $arr=$dapi->select()->from('wp_posts')->where('post_type=\'post\'')->order('RAND()')->limit(1)->getArray();


      $pictb=new Dapi(false);
      $parr=$pictb->select('guid')->from("wp_posts")->where(array('post_parent'=>$arr['ID'],'post_type'=>'attachment'))->getArray();

      //    print_r($parr);

      $attachment = array(
			  'message' =>"bitkiblog.com'dan sağlıklı yaşam önerileri",
			  'name' => "$arr[post_title]",
			  'caption' => 'Bitkiblog',
			  'link' => "https://apps.facebook.com/bitkiblog?paid=$arr[ID]&uid=$apime[id]",
			  'picture'=>"$parr[guid]",
			  'description' => "$arr[post_content]",
			  'actions' => array('name' => 'Dr. Mustafa Eraslan Ürünleri',
					     'link' =>"https://www.facebook.com/d.mustafaeraslan/app_309779485811186",
					     ));
 	

      try {
		 
	$days=date('z');
  

	if(!isset($_SESSION["posted"]) or $debug){
	   
	  $result = $facebook->api('/me/feed/','post',$attachment);	  	  
	  $_SESSION["posted"]="true";
	  $friends=$facebook->api('/me/friends');	  	  
	  //print_r($friends);
	}


      } catch (FacebookApiException $e) {
	echo "exception threwx:$e";
	$user = null;
      }
       
    }


    else {
       
      echo "	<script type='text/javascript'>
		top.location.href='$loginUrl';
	</script>";
    }
  }
} else {
  echo "<script type='text/javascript'>
		top.location.href='$loginUrl';
		</script>";
}
   


?>
<script type='text/javascript'> 
  var isInIFrame = (window.location != window.parent.location) ? true : false;

if(false===isInIFrame) top.location.href="http://apps.facebook.com/bitkiblog"; 
</script>
</body>
</html>
