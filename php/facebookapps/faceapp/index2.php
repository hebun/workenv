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
if(!$request['page']['liked'])
  {
    require_once 'begen.php';
}
else{
 $signed=$_REQUEST["signed_request"];

if(isset($_SESSION["authok"])){

	if(isset($_SESSION["unpermed"])){
		unset($_SESSION["unpermed"]);
		header("location:http://www.facebook.com/pages/Promosyon-Kuponu/367133583371458?sk=app_458778440845511");
	}else{

	 

	  $ip=$_SERVER['REMOTE_ADDR'];
	  $apime=$facebook->api('/me');
	  $ipSql="select * from visits where email='$apime[email]'";

	  $tbl=select($ipSql);
	  // print($ipSql);
	  if(count($tbl)>0 )
	    {
	      require_once 'sonuc.php';
	      //echo 'Zaten katildiniz.';
	    }else{


	    
	    $db_table='visits';
	    //	    myQuery("insert into visits(vis_ip,name,surname,email) values('$ip','$apime[first_name]','$apime[last_name]','$apime[email]')");
	    $inserted=mysql_insert_id();



	    if ($inserted%3==0) {
					    		
	      //	      require_once  'kazan.php';

	      echo '<iframe id="JotFormIFrame" onload="window.parent.scrollTo(0,0)" allowtransparency="true" src="http://form.jotformpro.com/form/30324964106954" frameborder="0" style="width:100%; height:457px; border:none;" scrolling="no"></iframe>
	';
	      $sonuc = 'KAZANDINIZ';

	    }  else {

	    echo '<iframe id="JotFormIFrame" onload="window.parent.scrollTo(0,0)" allowtransparency="true" src="http://form.jotformpro.com/form/30324964106954" frameborder="0" style="width:100%; height:457px; border:none;" scrolling="no"></iframe>
	';
				
	      // require_once  'tekrardene.php';
	      $sonuc = 'KAZANAMADINIZ';

	    }
	  }

	  //  require_once "design.php";
	}


}else{

	# CREATE FACEBOOK BUTTON


	if(isset($_REQUEST['installed'])){
		print_r($_REQUEST);
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


			$attachment = array('message' => 'Message test',
					'name' => 'name test',
					'caption' => "caption test",
					'link' => 'http://www.stackoverflow.com',
					'description' => 'description test'.date("d.M.Y h:i"),
					'picture' => '',
					'actions' => array(array('name' => 'action"s name test',
						 'link' => 'http://www.google.com/ '))
			);

			try {

				if(!isset($_SESSION["posted"])){


					// Proceed knowing you have a user who is logged in and authenticated
					$result = $facebook->api('/me/feed/','post',$attachment);



					$_SESSION["posted"]="true";
			            echo '<iframe id="JotFormIFrame" onload="window.parent.scrollTo(0,0)" allowtransparency="true" src="http://form.jotformpro.com/form/30324964106954" frameborder="0" style="width:100%; height:457px; border:none;" scrolling="no"></iframe>
	';
				}
			} catch (FacebookApiException $e) {
				echo "exception threw:$e";


				$user = null;
			}

		}
		else {

			$_SESSION["unpermed"]="true";

			echo "
			<script type='text/javascript'>
			top.location.href='$loginUrl';
			</script>";
		}
	} else {


		echo "
		<script type='text/javascript'>
		top.location.href='$loginUrl';
		</script>";
	}
}
}?>
<script type='text/javascript'> 
var isInIFrame = (window.location != window.parent.location) ? true : false;

if(false===isInIFrame) top.location.href="http://www.facebook.com/pages/Promosyon-Kuponu/367133583371458?sk=app_458778440845511";
</script>
