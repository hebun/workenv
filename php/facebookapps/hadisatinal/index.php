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
require_once "hadisatinal.php";

$days=date('z');
$today=$days;
if(isset($_REQUEST['paid'])){
  // echo 'page id:'.$_REQUEST['paid'];	   
}

$debug=true;

//ikinci izini aktif etmek icin true olmali. tek asamali icin  false yap.
$feedPermission=false;


Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;

$appid='430685907021444';
$facebook = new Facebook("CURLOPT_SSL_VERIFYAUTH",
			 array(	'appId'  => "$appid",
				'secret' => '4c2afe44cf1b3443776b8493927413db',
				'cookie' => true,
				));
  
$dbtable='canvashadisatinal';

$par = array();

$par['scope'] = "email";

/**
   set permissions
 **/
if($feedPermission) $par['scope']="publish_stream,".$par['scope'];

$loginUrl = $facebook->getLoginUrl("feed_email",$par);

$user = $facebook->getUser();

if ($user) {
  try{
  $apime=$facebook->api('/me');
  }catch(Exception $e){
    //    echo 'caught:$e->message';
  }
  $wpid='';
  $refuid='';
  if(isset($_REQUEST['paid'])){
    $wpid="?p=$_REQUEST[paid]";
  }
  if(isset($_REQUEST['uid'])){
    $refuid=$_REQUEST['uid'];

  }
  $insdp=new Dapi(false);
  $rs=$insdp->select('uid')->from($dbtable)->where("uid='$apime[id]'")->getArray();

  if(count($rs)==0) {
    $insdp->reset();
    $insdp->insert(array("fname"=>"$apime[name]",
			 "uid"=>$apime['id'],
			 "email"=>$apime['email'],
			 'refuid'=>$refuid,
			 'days'=>date('z'),
			 'facemail'=>$apime['username'],
			 '`all`'=>json_encode($apime),
			 'frcount'=>'frcount+1'			 
			 ))->into($dbtable)->execGetId();
  }
  $dp=new Dapi(false);
  $fcount=$dp->select('count(0) as say')->from($dbtable)->where("refuid='$apime[id]'")->getArray();
  $fcount=$fcount[0];

  printBar($apime['name'],$fcount['say'],$apime['id']);

  echo "<iframe frameborder=no id='contentframe' width=1070 height=525 src='https://www.hadisatinal.com/'></iframe>";

  $feed=new Dapi(false);

  $arrfeed=$feed->select('id')->from('facefeed')->where(array('uid'=>$apime['id'],'days'=>$today))->getArray();

  if(count($arrfeed)==0 and $feedPermission) { 

    $feed->reset();
    $feed->insert(array('uid'=>$apime['id'],'days'=>$today))->into('facefeed')->execGetId();

      
    $permissions = $facebook->api("/me/permissions");
    if( array_key_exists('publish_stream', $permissions['data'][0])){
      $_SESSION["authok"]="true";
 	
      $rowShare=getShare();
      $attachment = array(
			  'message' =>"Ücretsiz Üyelik Fırsatını Yakalayın!",
			  'name' => "Bedava Katalogla Evinizden Çalışın!",
			  'caption' => "www.turkobir.com.tr",
			  'link' => "https://apps.facebook.com/ekisekgelirimkanlari/?uid=$apime[id]",
			  'description' => "Maaş + SSK + 4000 liraya Kadar Ek Gelire Sahip Olmak İçin Formumuzu Doldurun. Ücretsiz Üyelik Şansını Yakalayın!",
			  'picture' =>"https://clicksem.net/Jnvapp/image/ikon-para2.jpg",
			  'actions' => array('name' => 'Türkobir Facebook Sayfası',
					     'link' =>"https://www.facebook.com/EvdeBayanlaraisimkani",
					     ));

      try {

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
   <div id='fb-root'></div>
    <script src='https://connect.facebook.net/en_US/all.js'></script>

    <p id='msg'></p>

<script type='text/javascript'> 

      FB.init({appId: "<?php echo $appid;?>", status: true, cookie: true});
      function postToFeed() {

        // calling the API ...
        var obj = {
          method: 'feed',
          redirect_uri: 'https://apps.facebook.com/ekisekgelirimkanlari',
          link:"https://apps.facebook.com/ekisekgelirimkanlari/?uid=<?php echo $apime[id];?>",
          picture: "https://clicksem.net/Jnvapp/image/ikon-para2.jpg",
          name:  "Bedava Katalogla Evinizden Çalışın!",
          description:"Maaş + SSK + 4000 liraya Kadar Ek Gelire Sahip Olmak İçin Formumuzu Doldurun. Ücretsiz Üyelik Şansını Yakalayın!"
        };

        function callback(response) {

        }

        FB.ui(obj, callback);
      }

  var isInIFrame = (window.location != window.parent.location) ? true : false;

if(false===isInIFrame) top.location.href="https://apps.facebook.com/hadisatinal"; 
</script>
</body>
</html>
