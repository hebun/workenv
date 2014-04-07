<?php ob_start(); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Kullanici Girişi</title>

</head>
<body bgcolor="#ffffff">


<?php
$warn=false;
if(isset($_POST["txtKulad"])){

	//sql injection controle
	if (!preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $_POST["txtKulad"])){

		//sql injection controle
		if (!preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $_POST["txtSifre"])){

			require_once 'config.php';
			$dapi=new Dapi()			;
			$lsql="select * from users where account='$_POST[txtKulad]' and customerId='$_POST[txtSifre]' and del=0";
			//echo $lsql;
			$table=$dapi->select($lsql);

			var_dump($table);			

			if(count($table)>0){

				session_start();
				$_SESSION["userid"]=$table[0]["id"];
				$_SESSION["username"]=$table[0]["account"];
				$_SESSION["customerId"]=$table[0]["customerId"];
				header("location:campaigns.php");
			}

		}
	}
	$warn=true;

}
?>
	<form id="form1" action="login.php" method="post" name="form1">
	<br><br><br><br><br><br><br><br><br><br><br>
		<table  border="0" align="center" valign="center" 	 style="border:1px black solid;width:400px;">
		<tr >
		<td colspan="2" align="center"><b>ClickSEM Adwords Panel Girisi</b>
		</td>

		</tr>
		<tr>
		<td>Kullanıcı Adı:
		</td>
		<td>
		<input type="text" name="txtKulad"/>
		</td>
		</tr>
		<tr>
		<td>
		Şifre
		</td>
		<td>
		<input  type="password" name="txtSifre"/>
		</td>
		</tr>
		<tr>
		<td>
		</td>
		<td align="left">
		<input type="submit" value="Giriş" name="ok"/>
		</td>
		</tr>
		</table>
	</form>
<?php 
if($warn){
	echo "<script type='text/javascript'>alert('Kullanıcı adı ve/veya şifre yanlış');</script>";
}
?>
</body>
</html>
<?php ob_end_flush(); ?> 
