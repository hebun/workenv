<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body  style="padding:0px;margin:0px" > 
<?php 
// php ile doviz kuru 
// e : bugrakaan@gmail.com 
 function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'ISO-8859-9', true));
}
echo'<table width="100%" border="1" cellpadding="0" cellspacing="0"><tr><td>'; 
 
$currency = array( 
"USD" => "", 
"EUR" => "", 
 
); 
 
 
$convert = array( 
"isim" => "İsim", 
"forexbuying" => "Alış", 
"forexselling" => "Satış", 
 
); 
 
 
$content = file_get_contents_utf8("http://www.tcmb.gov.tr/kurlar/today.xml"); 

foreach($currency as $code => $arr){ 
preg_match("'<currency Kod=\"(".$code.")\".*>(.*)</currency>'Uis",$content,$crst); 
foreach($convert as $field => $value){ 
preg_match("'<".$field.">(.*)</".$field.">'Uis",$crst[2],$frst); 
$currency[$code][$value] = $frst[1]; 
} 
} 
 
 
$sen="<pre>".print_r($currency,true)."</pre>"; 
 
$sen1=str_replace('(','',$sen); 
$sen2=str_replace(')','',$sen1); 
$sen3=str_replace('Array','',$sen2); 
$sen4=str_replace('[USD] =>','',$sen3); 
$sen5=str_replace('[EUR] =>','',$sen4); 
$sen6=str_replace(' ','',$sen5); 
$sen7=str_replace('<pre>','',$sen6); 
$sen8=str_replace('</pre>','',$sen7); 
$sen9=str_replace('[İsim]=>','',$sen8); 
$sen10=str_replace('AMERİKANDOLARI','<tr><td rowspan=2 bgcolor=f0f0f0><font size=2>USD</font></td><td bgcolor=f0f0f0>',$sen9); 
$sen11=str_replace('[Alış]=>','<font size=2>Alış</font></td><td bgcolor=f0f0f0><font size=2>',$sen10); 
$sen12=str_replace('[Satış]=>','</font></td></tr><tr><td bgcolor=f0f0f0><font size=2>Satış</font></td><td bgcolor=f0f0f0><font size=2>',$sen11); 
$sen13=str_replace('EURO','</td><tr><td rowspan=2 bgcolor=f0f0f0><font size=2>EURO</font></td><td bgcolor=f0f0f0>',$sen12); 
 
echo"<table width='100%' border='0' > 
<tr bgcolor='c0c0c0'> 
<td colspan='2'><div align='center'><b>TCMB Döviz Kuru</b> </div></td> 
</tr> 
<tr> 
<td width='80%' rowspan='4'> 
 
<table width='100%' border='0' cellpadding='2' cellspacing='2'> 
 
$sen13"; 
 
echo"</td></tr></table></td> 
<td width='20%' bgcolor=#f0f0f0><font size=2>TL</font></td> 
</tr> 
<tr> 
<td bgcolor=f0f0f0><font size=2>TL</font></td> 
</tr> 
<tr> 
<td bgcolor=f0f0f0><font size=2>TL</font></td> 
</tr> 
<tr> 
<td bgcolor=f0f0f0><font size=2>TL</font></td> 
</tr> 
</table></td></tr></table>"; 
 
?>
</body>
</html>