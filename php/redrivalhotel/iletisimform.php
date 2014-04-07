<?php if ($_POST['gonder'])
{
require("mailphp/class.phpmailer.php");
$icerik="<style>
td{
font-family: tahoma;
	font-size: 11px;
	color: #333333;
}
</style><table  border='0' cellpadding='3' cellspacing='3'>
        <tr align='center'>
          <td height='13' colspan='2' bgcolor='#f3f3f3'> Iletisim Formu </td>
        </tr>
        <tr>
          <td width='80' height='13' bgcolor='#f3f3f3'>Ad Soyad: </td>
          <td width='467'>$_POST[ad]</td>
        </tr>
	<tr>
          <td height='13' bgcolor='#f3f3f3'>E-mail :</td>
          <td>$_POST[email]</td>
        </tr>
	 <tr>
          <td height='13' bgcolor='#f3f3f3'>Telefon : </td>
          <td>$_POST[telefon]</td>
        </tr>  
		
        <tr>
          <td height='13' bgcolor='#f3f3f3'>Mesaj : </td>
          <td>$_POST[mesaj]</td>
        </tr>
        <tr>
          <td height='13' colspan='2' bgcolor='#f3f3f3'>ip adresi = $_SERVER[REMOTE_ADDR];&nbsp;</td>
        </tr>
      </table>
";
$mail = new PHPMailer();

$mail->IsSMTP();                                   // send via SMTP
$mail->IsHTML(true);
$mail->Host     = "mail.redriverhostel.com"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "info@redriverhostel.com";  // SMTP username
$mail->Password = "in12RRH34fo"; // SMTP password

$mail->From     = "info@redriverhostel.com"; // smtp kullanýcý adýnýz ile ayný olmalý
$mail->Fromname = "retriverhostel";
$mail->AddAddress("info@redriverhostel.com","retriverhostel");
$mail->Subject  =  "Iletisim Formu";
$mail->Body     =  $icerik;

if(!$mail->Send())
{
   echo "Mesaj Gönderilemedi <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}


}
?>
<link href="alikirman/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {
	color: #AA0000;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 14px;
	font-style: normal;
	font-weight: normal;
}
-->
</style>
<table width="450" align="center" valign="top" cellpadding="0" cellspacing="5">
  <tr> </tr>
  <tr>
    <td height="60" align="center"><p class="style3"><strong>Mesaj&#305;n&#305;z iletilmi&#351;tir !</strong><br />
    <span class="style3">G&ouml;stermi&#351; oldu&#287;unuz ilgiye te&#351;ekk&uuml;r ederiz.</span></span></p></td>
  </tr>
</table>
