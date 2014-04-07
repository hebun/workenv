<?php
//CURRENT: multi design support.
require_once  "config.php";
require_once 'Page.php';
require_once 'src/facebook.php';

$app_id = $config->appid; // Your application id

$app_secret = $config->appsecret; // Your application secret

$facebook = new Facebook(array(
'appId' => $app_id,
'secret' => $app_secret,
'cookie' => true
));

/**
 * 
 * initial select product group.. should be depended on page
 * @var int
 */
$selectedGroup=1;

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="src/tiny/tinybox.js">
</script>
<script type="text/javascript" src="ajax.js">
</script>
<script type="text/javascript" src="client.js">
</script>
<link rel="stylesheet" href="src/tiny/style.css" />
<link rel="stylesheet" href="style/style.css" />
<style type="text/css">
.adminnote {
	width: 450px;
}
.payvmentSearchNotice,.payvmentMessageBox,.adminnote {
	background: none repeat scroll 0 0 #EFF9D7;
	border: 1px solid #E2C822;
	clear: both;
	color: #333333;
	font-weight: bold;
	margin: 8px 0;
	padding: 10px 20px;
	text-align: left;
}
.cartShippingAddressViewNotification {
	border-style: solid;
	font-size: 11px;
	margin-bottom: 12px;
	padding-left: 5px;
	text-align: left;
	width: 760px;
}
</style>
</head>
<body onload="reloadList(<?php echo $selectedGroup;?>)">
<?php 
error_reporting(E_ERROR);

$signedrequest = $facebook->getSignedRequest();

$pageid=$signedrequest["page"]["id"];

if(empty($pageid)){//outside of facebook
	$pageid="285723924817479";
	//die("executing localy...");
}

$pageid="285723924817479";
$page=new Page($pageid);
session_start();
$_SESSION["pageid"]=$pageid;
if($page->installed===false){
	
	die("the page is not installed");
}

?>
<div id="checkouttext1" align="left" class="adminnote cartShippingAddressViewNotification">
	Listele: &nbsp;&nbsp;&nbsp;
<table>
<tr><td>
	<select id="groupid" onchange="reloadList(this.value)" align="left">
	<option value="0">Hepsi</option>
	<option value="1" selected="true">Çok Satanlar</option>
	
	</select>
</td></tr>

<tr><td>
Resimlere tıklayarak büyük hallerini görebilirsiniz.
</td></tr><tr><td>
<a name="fb_share" type="button" share_url="<?php echo $page->pageurl;?>">Paylaş</a>
</td></tr>
</table>
</div>
							
<div id="listDiv">

</div>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>

  FB.init({
    appId  : '<?php echo $config->appid;?>',
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
</script>
</body>
</html>