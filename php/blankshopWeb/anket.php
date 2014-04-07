<?php
ob_start();?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body  style="padding:0px;margin:0px" > 
<?php

@session_start();


if(isset($_SESSION["anket"])){
	header("location:anketResult.php");
}
else{
	if(isset($_POST["send"])){
		require_once "db.php";	
		$arr=array();
		//$arr["ip"]="sdfd";
		if($arr["vote"]==="0"){
			
		}
		$arr["vote"]=$_POST["sonuc"];
		myQuery(insert($arr,"anketDet"));
		$_SESSION["anket"]="ok";
		header("location:anketResult.php");
		//insert
	}
?>

<form action="anket.php" method="post" name="anket">
<table border="1" width="150" cellspacing="0" cellpadding="0" bordercolor="#000000">
<tbody>
<tr>
<td width="100%" colspan="2">
<p align="left">Sitemizi beğendiniz mi?</p>
</td>
</tr>
<tr>
<td><input type="radio" name="sonuc" value="1" checked>
</td>
<td width="96%">Evet</td>
</tr>
<tr>
<td><input type="radio" name="sonuc" value="2"> </td>
<td width="96%">Hayır</td>
</tr>

<tr>
<td colspan="2">
<input  name="send" type="submit" value="Gönder" > </td>
</tr>
</tbody>
</table>
<?php

}
ob_end_flush();
?>
</body>
</html>



