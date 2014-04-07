<?php
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                   // send via SMTP
$mail->Host     = "mail.redriverhostel.com"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "info@redriverhostel.com";  // SMTP username
$mail->Password = "in12RRH34fo"; // SMTP password

$mail->From     = "info@redriverhostel.com"; // smtp kullanýcý adýnýz ile ayný olmalý
$mail->Fromname = "giden ismi";
$mail->AddAddress("ismettung@gmail.com","Ornek Isim");
$mail->Subject  =  "baþlýk";
$mail->Body     =  implode("    ",$_POST);

if(!$mail->Send())
{
   echo "Mesaj Gönderilemedi <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Mesaj Gönderildi";


?>
