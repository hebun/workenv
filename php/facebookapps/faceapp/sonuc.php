<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facebook Promosyon Çekiliş Sonuçları</title>
<style type="text/css">
<!--
.kazanan {
	font-size: 12px;
	color: #FFF;
	font-family: Arial, Helvetica, sans-serif;
	top: 0px;
	vertical-align: top;
}
body {
	background-image: url(image/m4.jpg);
}
-->
</style>
</head>

<body>
<?php
require_once "face/facebook.php";
require_once "config.php";

@session_start();

//Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
//Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
//unset($_SESSION["authok"]);
//die();
$facebook = new Facebook(array(
			       'appId'  => '148382711979856',
			       'secret' => '750a8917cc72cf99c8f9bd86e0fd6bbe',
			       'cookie' => true,
			       ));
$request = $facebook->getSignedRequest();

if(!$request['page']['liked'])
  {
    //echo 'www';

	echo "<script type='text/javascript'>
			location.href='begen1.php';
			</script>";

	//    header('location:begen1.php');
  }
else{

?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="114" colspan="3">&nbsp;</td>
  </tr>
  <tr class="kazanan">
    <td width="212" height="348">&nbsp;</td>
    <td width="250"><?php


$sqlall="select * from visits order by id desc limit 10";
$tableAll=select($sqlall);

$toplam=selectOne('visits',"count(0)",'1','1');

//print_r($tableAll);
//echo "Cekilise katilan son 6 kisi<br>";
$list='';
$ksay=$toplam;
$coall=$ksay;
$list.='<table>';
foreach($tableAll as $row)
  {
    $list.='<tr>';
    $uno=intval(intval($row['id'])-intval(173));
    $ksay--;
    $list.="<td style='width:40px;height:26px;color:yellow' align='center' >$ksay </td>";    
    $list.= "<td style='color:black'> $row[name] $row[surname]";
    if($row['vis_sonuc']=="KAZANDINIZ"){
      $list.= "<span style='color:red'> <strong>KAZANDI</strong></span>";
    }
    $list.=" </td>";
    $list.= "</tr>";

  }
$list.='</table>';
$ksay--;
$ip=$_SERVER['REMOTE_ADDR'];
$ipSql="select * from visits where vis_ip='$ip'";

$tbl=select($ipSql);
/*
if(count($tbl)){
  $inserted=$tbl[count($tbl)-1]['id'];	

	    if ($ksay%3==0) {
		echo " Çekilişe katılan $coall. kişisiniz  <br> ve KAZANDINIZ... <br>";		
	    }  else {
	      echo " Çekilişe katılan $coall. kişisiniz  <br> ancak KAZANAMADINIZ yarın yine deneyin... <br>";			
	    }

	    }*/
	    echo $list;
   ?></td>
    <td width="338" height="348">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
		  }
?>
</body>
</html>