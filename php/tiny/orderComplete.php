<?php
require_once 'config.php';
require_once 'Page.php';
require_once 'Dbtool.php';
//var_dump($_POST);

if($_POST["paymenttype"]!=="3"){

	$order=$_POST;

	$order["productid"]=$order["pid"];

	unset($order["pid"]);
	$order["tel"]=$order["telephone"];

	unset($order["telephone"]);
	$order["isauth"]="1";
	$order["iscomp"]="0";
	$sql=Dbtool::getInsert("orders",$order);

	mysql_query($sql);

	$insertid=mysql_insert_id();

	$orderno="SOF-$insertid-$order[paymenttype]";

	session_start();

	$page=new Page($_SESSION["pageid"]);

	$paymenttype=array("","Kapıda Ödeme","Kapıda Kredi Kartı ile Ödeme","Paypal");
	
	$to  =$config->debug? 'ismettung@gmail.com':$page->email; 


	// subject
	$subject = 'Siparis-ipekveraalyans sayfasi';

	// message
	$message = "
	<html>
	<head>
	  <title></title>
	</head>
	<body>
	<p><b>İpek vera alyans facebook sayfasında sipariş verildi.</b></p>
	  <p>Sipariş Veren Kişinin;</p>
	  <table>
	  
	    <tr>
	      <td><b>Adı Soyadı:</b></td>$order[namesurname] </td>
	    </tr>
	    <tr>
	      <td><b>E-maili:</b></td>$order[email]</td>
	    </tr>
	    <tr>
	      <td><b>Telefonu:</b></td><td>$order[tel]</td>
	    </tr>
	     <tr>
	      <td><b>Ürün:</b></td>".Dbtool::selectOne("products","name","id",$order["productid"])." </td>
	      
	    </tr>
	    <tr>
	      <td><b>Ödeme Tipi:</b></td><td>".$paymenttype[$order[paymenttype]]."</td>
	    </tr>
	  </table>
	</body>
	</html>
	";

	$headers = '';
	$headers .= "From:facestore@p3nlhg525.shr.prod.phx3.secureserver.net\n";
	$headers .= "Reply-To: facestore@p3nlhg525.shr.prod.phx3.secureserver.net\n";
	$headers .= "Date: ".date("r")."\n";
	$headers .= "Message-ID: \n";
	$headers .= "Return-Path: \n";
	$headers .= "Delivered-to: \n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/html; charset=utf-8\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "Importance: High\n";
	$headers .= "X-MSMail-Priority: High\n";
	$headers .= "X-Mailer: ".phpversion()."\n";
	
	//$headers .= 'From: Facebook Sayfası <facestore@gmail.com>' . "\r\n";


	// Mail it
	mail($to, $subject, $message, $headers);

	?>
<style>
.adminnote {
	width: 430px;
}

.payvmentSearchNotice,.payvmentMessageBox,.adminnote {
	background: none repeat scroll 0 0 #FFF9D7;
	border: 1px solid #E2C822;
	clear: both;
	color: #333333;
	font-weight: bold;
	margin: 8px 0;
	padding: 10px 20px;
	text-align: center;
}

.cartShippingAddressViewNotification {
	border-style: solid;
	font-size: 14px;
	margin-bottom: 12px;
	padding-left: 30px;
	text-align: left;
	width: 300px;
}
</style>
<div style="vertical-align: center; margin-top: 100px; width: 300px;"
	align="center" id="checkouttext1"
	class="adminnote cartShippingAddressViewNotification">
	Siparişiniz tamamlanmıştır. En kısa sürede sizinle iletişime
	geçilecektir.<br> Sipariş numaranız:
	<?php echo $orderno;?>
</div>
<div style="width: 300px; text-align: center">
	<input type="button" onclick="parent.TINY.box.hide()"
		style="width: 100px" value="Kapat">
</div>


<?php
}

?>