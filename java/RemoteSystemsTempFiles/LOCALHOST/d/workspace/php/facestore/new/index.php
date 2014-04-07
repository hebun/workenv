<?php
//CURRENT: lightbox relativ to parent
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="src/tiny/tinybox.js">
</script>
<script type="text/javascript" src="ajax.js">
</script>
<script type="text/javascript" src="client.js">
</script>
<link rel="stylesheet" href="src/tiny/style.css">
<link rel="stylesheet" href="style/style.css">
<style type="text/css">
.adminnote {
	width: 450px;
}
.payvmentSearchNotice,.payvmentMessageBox,.adminnote {
	background: none repeat scroll 0 0 #529fd7;
	border: 1px solid #b4a95f;
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
	width: 700px;
}
body {
	background-color: #FFF;
	background-image: url(img/b800x1.jpg);
	margin-top: 0px;
}
td {
	font-size: 13px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style>
</head>
<body onLoad="reloadList(<?php echo $selectedGroup;?>)">
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
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><img src="img/b800.jpg" width="800" height="151" border="0" usemap="#Map"></td>
  </tr>
  <tr>
    <td width="36">&nbsp;</td>
    <td><div id="listDiv"></div>
      <div id="fb-root" ></div>
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
      </script></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div id="checkouttext1" align="left" class="adminnote cartShippingAddressViewNotification"> Listele: &nbsp;&nbsp;&nbsp;
      <table width="698">
        <tr>
          <td width="186"><select name="groupid" id="groupid" onChange="reloadList(this.value)">
            <option value="0">Hepsi</option>
            <option value="1" selected="Çok Satanlar">Çok Satanlar</option>
          </select></td>
          <td width="500">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><a name="fb_share" share_url="<?php echo $page->pageurl;?>">Paylaş</a></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><img src="img/b800xA.jpg" width="800" height="25"></td>
  </tr>
</table>


<map name="Map">
  <area shape="rect" coords="18,95,139,115" href="#" alt="fiyata göre sırala">
  <area shape="rect" coords="153,96,243,116" href="#" alt="tüm ürünler">
  <area shape="rect" coords="257,97,347,115" href="#" alt="çok satanlar">
</map>
</body>
</html>