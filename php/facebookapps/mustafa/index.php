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
require_once "mustafa.php";

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

$appid='366175060162507';
$facebook = new Facebook("CURLOPT_SSL_VERIFYAUTH",
			 array(	'appId'  => "$appid",
				'secret' => '36fe8ccf07f2811bb005271b9af04953',
				'cookie' => true,
				));
  
$dbtable='canvasmustafa';

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

  echo "<iframe frameborder=no id='contentframe' width=1070 height=525 src='https://www.mustafaeraslan.info.tr/'></iframe>";

  
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
          redirect_uri: 'https://apps.facebook.com/drmustafaerarslan',
          link:"https://apps.facebook.com/drmustafaerarslan/?uid=<?php echo $apime['id'];?>",
          picture: "https://clicksem.net/Jnvapp/image/ikon-para2.jpg",
          name:  "Bedava Katalogla Evinizden Çalışın!",
          description:"Maaş + SSK + 4000 liraya Kadar Ek Gelire Sahip Olmak İçin Formumuzu Doldurun. Ücretsiz Üyelik Şansını Yakalayın!"
        };

        function callback(response) {

        }

        FB.ui(obj, callback);
      }

  var isInIFrame = (window.location != window.parent.location) ? true : false;

if(false===isInIFrame) top.location.href="https://apps.facebook.com/drmustafaerarslan"; 
</script>
</body>
</html>
