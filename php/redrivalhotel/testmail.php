<?php
error_reporting(E_ALL);
	$message = "
	<html>
	<head>
	  <title></title>
	</head>
	<body>
	<p><b>�pek vera alyans facebook sayfas�nda sipari� verildi.</b></p>
	  <p>Sipari� Veren Ki�inin;</p>
	  <table>
	  
	    <tr>
	      <td><b>Ad� Soyad�:</b></td>sdfsdf </td>
	    </tr>
	    <tr>
	      <td><b>E-maili:</b></td>asdfsadf</td>
	    </tr>
	    <tr>
	      <td><b>Telefonu:</b></td><td>asdfasdf</td>
	    </tr>
	     <tr>
	      <td><b>�r�n:</b></td>asdasd </td>
	      
	    </tr>
	    <tr>
	      <td><b>�deme Tipi:</b></td><td>asdasd</td>
	    </tr>
	  </table>
	</body>
	</html>
	";

	$headers = '';
	$headers .= "From:test@test.com\n";
	$headers .= "Reply-To: test@test.com\n";
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
	
	//$headers .= 'From: Facebook Sayfas� <facestore@gmail.com>' . "\r\n";


	// Mail it
	try{
	mail("ismettung@gmail.com", "subject", $message, $headers);
	
	}
	catch(Exception $e){
	echo "here";
	print_r($e->getMeesage());
	}
	?>