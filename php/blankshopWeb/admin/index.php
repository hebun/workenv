<?php ob_start(); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Yönetim Sayfası</title>
</head>
<body>
<?php    
@session_start();
require_once "../constant.php";
error_reporting(E_ALL);
$wrongPass=false;
if(isset($_POST["pass"]))
{
	if($_POST["pass"]===$adminPass){	

    $_SESSION["admin"]="true";   
    
	header("location:adminMain.php");	
				
	}else{
		$wrongPass=true;
	}	
	
}

echo "<table border='1' align='center'>  ";
if($wrongPass){
	echo "<tr><td align='center'>Yanlş şifre </td></tr>";
}
echo 		"<tr><td align='center'>Yönetici Oturumu Aç</td></tr> <tr><td><form method='post' action='index.php'> Şifre:";

echo "<input name='pass' type='password' />";

echo "<input  type='submit' Value='Giriş' /></form></td></tr></table>";

?>

</body>
</html>