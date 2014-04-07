<?php

require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/settings.inc.php");
require_once("../inc/functions.inc.php");

include_once('../inc/class.phpmailer.php');

function sendMail($points)
{


	$mail             = new PHPMailer();

	$body             = "Aşağıdaki satış noktaları son 10 gün içinde kontrol edilmedi.<br><br>$points";

	$mail->IsSMTP(); 
	$mail->Host       = "mail.clicksem.net"; 
	$mail->From       = "1181@clicksem.net";
	$mail->FromName   = "Admin Panel";

	$mail->Subject    = "Kontrol edilmemiş satış noktaları var.";


	$mail->MsgHTML($body);

	$mail->AddAddress("ismettung@gmail.com");
	$mail->AddAddress("takip@dermasan.com.tr");


	if(!$mail->Send()) {
		echo "HATA GONDERMEDİ: " . $mail->ErrorInfo;
	} else {
		echo "Mail Gİtti!";
	}
}
function isSentToday()
{
	$sql="select * from mailday where days=".date('z');


	$db=new Database();	

	if($db->open()){
		$db->query($sql);
		//echo $sql."   ";
		return $db->fetchAssoc();
	}

}
function checkInactive(){

	$sql="select id,warnday,name,b.name as bname,
	(select DATEDIFF(now(),tarih) from control where pointId=p.id order by tarih desc limit 1)
as lasttarih from point as p inner join bolge as b on b.id=p.bolgeId having lasttarih> warnday
";

	$db=new Database();	
	if($db->open()){
		$db->query($sql);
		$points="";
		while($row=$db->fetchAssoc()){
			$points.="<br>$row[bname]->$row[name]  ";

		}
		return $points;
	}
}
function insertToday()
{

	$sql="insert into mailday set days=".date('z');


	$db=new Database();	

	if($db->open()){
		$db->query($sql);
	}
}
if(!isSentToday()){

	$points=checkInactive();

	if(!empty($points)){

		sendMail($points);
		insertToday();
	}

}
?>
