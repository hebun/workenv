<?php
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                   // send via SMTP
$mail->Host     = "mail.redriverhostel.com"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "info@redriverhostel.com";  // SMTP username
$mail->Password = "in12RRH34fo"; // SMTP password

$mail->From     = "info@redriverhostel.com"; // smtp kullan�c� ad�n�z ile ayn� olmal�
$mail->Fromname = "giden ismi";
$mail->AddAddress("ismettung@gmail.com","Ornek Isim");
$mail->Subject  =  "ba�l�k";
$mail->Body     =  implode("    ",$_POST);

if(!$mail->Send())
{
   echo "Mesaj G�nderilemedi <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Mesaj G�nderildi";


?>
