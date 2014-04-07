<?php

require_once  "config.php";



$appid="0";

$app_id = "115913018564165"; 

$app_secret = "c66240e1b3d16b2737b51d4c00ef6fe9"; 

function getCode(){
	global $appid;
	global $config;
	$ret=select("select id from cip where ip='".$_SERVER["REMOTE_ADDR"]."'");

	if(count($ret)>0 and $config->debug==false)
	  die("Sadece bir kere indirim kuponu alabilirsiniz.");
	
	$sql="select id,code from ccodes where appid='$appid' and state=0 order by rand() limit 0,1";
	$ret=select($sql);
		
	if(count($ret)==0){
		
		die("Şuanda indirim kuponu bulunmuyor.");
	}
	//print_r($ret);
	myQuery(getInsert("cip",array("ip"=>$_SERVER["REMOTE_ADDR"])));
	myQuery(getUpdate("ccodes",array("state"=>"1")," id=".$ret[0]["id"]));
	echo "İndirim kodunuz: <b>".$ret[0]["code"]."</b>";
	
}

if(isset($_POST["getCode"])){
	
	getCode();
	die();

}


require_once 'facebook.php';


$facebook = new Facebook(array(
'appId' => $app_id,
'secret' => $app_secret,
'cookie' => true
));

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="ajax.js">
</script>
<script type="text/javascript" src="client.js">
</script>

</head>
<body >
<?php 
error_reporting(E_ERROR);

$signedrequest = $facebook->getSignedRequest();

//print_r($signedrequest);

 // print_r(parsePageSignedRequest());
//  echo "ip:".$_SERVER['REMOTE_ADDR'];
 //$fbme = $facebook->api('/me');

 //print_r($fbme);

$pageid=$signedrequest["page"]["id"];

$liked=$signedrequest["page"]["liked"];

if($liked)
echo "<input type='button' value='İndirim Kodu Al' onclick='getCode()'/> ";
 else{
     if($config->debug)
     echo "<input type='button' value='İndirim Kodu Al' onclick='getCode()'/> ";
	echo "İndirim kuponu alabilmek için sayfayı beğenin.";
	
 }


session_start();
$_SESSION["pageid"]=$pageid;


?>
<div id="resHolder">

</div>
      <div id="fb-root" ></div>
      <script src="http://connect.facebook.net/en_US/all.js"></script>
      <script>

function getCode(){
    Ajax.call({
        url: currentUrl + 'index'+<?php echo $appid;?>+'.php',
        params: {
        		
        	getCode:true
           
        },
        load: function () {

        	document.getElementById("resHolder").innerHTML="<img src='ajax_wait.gif'/>";
        },
        success: function (res) {
           
        	document.getElementById("resHolder").innerHTML=res;

        }
    });
}

  FB.init({
    appId  : '<?php echo $app_id;?>',
    status : true, // check login status
    cookie : true, // enable cookies to allow the server to access the session
    oauth  : true // enable OAuth 2.0
  });
  FB.Canvas.setAutoResize();
  FB.Canvas.getPageInfo(
		    function(info) {
		     //  console.info(info)
		    }
		);
      </script>
    <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
        type="text/javascript">
      </script></td>

</body>
</html>