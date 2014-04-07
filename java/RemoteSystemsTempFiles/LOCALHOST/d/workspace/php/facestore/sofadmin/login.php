<?php ob_start(); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Yönetici Girişi</title>
<link href="style1.css" rel="stylesheet" type="text/css" />
<style type="text/css">
td img {
	display: block;
}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/back.jpg);
	background-color: #013157;
	background-repeat: repeat-x;
}
</style>

</head>
<body bgcolor="#ffffff">


<?php
$warn=false;
if(isset($_POST["txtKulad"])){
	
	//sql injection controle
	if (!preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $_POST["txtKulad"])){

		//sql injection controle
		if (!preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $_POST["txtSifre"])){

		if($_POST["txtKulad"]=="ipekvera" and $_POST["txtSifre"]=="sofadmiv")
		@session_start();
		$_SESSION["userId"]="1";
		header("location:products.php");
		}
	}
	$warn=true;
	
}
?>
	<form id="form1" action="login.php" method="post" name="form1">
		<div>
			<table border="0" cellpadding="0" cellspacing="0" width="650">
				<!-- fwtable fwsrc="adminlogin.png" fwbase="adminlogin.jpg" fwstyle="Dreamweaver" fwdocid = "131683008" fwnested="0" -->
				<tr>
					<td><img src="images/spacer.gif" width="80" height="1" border="0"
						alt="" /></td>
					<td><img src="images/spacer.gif" width="110" height="1" border="0"
						alt="" /></td>
					<td><img src="images/spacer.gif" width="82" height="1" border="0"
						alt="" /></td>
					<td><img src="images/spacer.gif" width="72" height="1" border="0"
						alt="" /></td>
					<td><img src="images/spacer.gif" width="23" height="1" border="0"
						alt="" /></td>
					<td><img src="images/spacer.gif" width="279" height="1" border="0"
						alt="" /></td>
					<td><img src="images/spacer.gif" width="4" height="1" border="0"
						alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="1" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td colspan="6">
						<div id="uyarisistemi" style="width: 450px;" runat="server"></div>

					</td>
					<td rowspan="10"><img name="adminlogin_r1_c7"
						src="images/adminlogin_r1_c7.jpg" width="4" height="468"
						border="0" id="adminlogin_r1_c7" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="91" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td rowspan="8"><img name="adminlogin_r2_c1"
						src="images/adminlogin_r2_c1.jpg" width="80" height="235"
						border="0" id="adminlogin_r2_c1" alt="" /></td>
					<td colspan="4"><img name="adminlogin_r2_c2"
						src="images/adminlogin_r2_c2.jpg" width="287" height="51"
						border="0" id="adminlogin_r2_c2" alt="" /></td>
					<td rowspan="8"><img name="adminlogin_r2_c6"
						src="images/adminlogin_r2_c6.jpg" width="279" height="235"
						border="0" id="adminlogin_r2_c6" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="51" border="0"
						alt="" /></td>
				</tr>
			
				<tr>
					<td colspan="4"><img name="adminlogin_r3_c2"
						src="images/adminlogin_r3_c2.jpg" width="287" height="7"
						border="0" id="adminlogin_r3_c2" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="7" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td><img name="adminlogin_r4_c2" src="images/adminlogin_r4_c2.jpg"
						width="110" height="20" border="0" id="adminlogin_r4_c2" alt="" />
					</td>
					<td colspan="2" bgcolor="#FFFFFF"><input type="text" id="txtKulad"
						name="txtKulad" class="form_ana" /></td>
					<td><img name="adminlogin_r4_c5" src="images/adminlogin_r4_c5.jpg"
						width="23" height="20" border="0" id="adminlogin_r4_c5" alt="" />
					</td>
					<td><img src="images/spacer.gif" width="1" height="20" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td colspan="4"><img name="adminlogin_r5_c2"
						src="images/adminlogin_r5_c2.jpg" width="287" height="17"
						border="0" id="adminlogin_r5_c2" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="17" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td><img name="adminlogin_r6_c2" src="images/adminlogin_r6_c2.jpg"
						width="110" height="19" border="0" id="adminlogin_r6_c2" alt="" />
					</td>
					<td colspan="2" bgcolor="#FFFFFF"><input type="password"
						id="txtSifre" name="txtSifre" class="form_ana" /></td>
					</td>
					<td><img name="adminlogin_r6_c5" src="images/adminlogin_r6_c5.jpg"
						width="23" height="19" border="0" id="adminlogin_r6_c5" alt="" />
					</td>
					<td><img src="images/spacer.gif" width="1" height="19" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td colspan="4"><img name="adminlogin_r7_c2"
						src="images/adminlogin_r7_c2.jpg" width="287" height="11"
						border="0" id="adminlogin_r7_c2" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="11" border="0"
						alt="" /></td>
				</tr>
				
				<tr>
					<td><img name="adminlogin_r8_c2" src="images/adminlogin_r8_c2.jpg"
						width="110" height="26" border="0" id="adminlogin_r8_c2" alt="" />
					</td>
					<td><input id="ImageButton1" type="image" border="0"
						style="height: 26px; width: 82px; border-width: 0px;"
						src="images/adminlogin_r8_c3.jpg" name="ImageButton1" /></td>
					<td colspan="2"><img name="adminlogin_r8_c4"
						src="images/adminlogin_r8_c4.jpg" width="95" height="26"
						border="0" id="adminlogin_r8_c4" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="26" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td><img name="adminlogin_r9_c2" src="images/adminlogin_r9_c2.jpg"
						width="110" height="84" border="0" id="adminlogin_r9_c2" alt="" />
					</td>
					<td><img name="adminlogin_r9_c3" src="images/adminlogin_r9_c3.jpg"
						width="82" height="84" border="0" id="adminlogin_r9_c3" alt="" />
					</td>
					<td colspan="2"><img name="adminlogin_r9_c4"
						src="images/adminlogin_r9_c4.jpg" width="95" height="84"
						border="0" id="adminlogin_r9_c4" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="84" border="0"
						alt="" /></td>
				</tr>
				<tr>
					<td><img name="adminlogin_r10_c1"
						src="images/adminlogin_r10_c1.jpg" width="80" height="142"
						border="0" id="adminlogin_r10_c1" alt="" /></td>
					<td colspan="4"><img name="adminlogin_r10_c2"
						src="images/adminlogin_r10_c2.jpg" width="287" height="142"
						border="0" id="adminlogin_r10_c2" alt="" /></td>
					<td><img name="adminlogin_r10_c6"
						src="images/adminlogin_r10_c6.jpg" width="279" height="142"
						border="0" id="adminlogin_r10_c6" alt="" /></td>
					<td><img src="images/spacer.gif" width="1" height="142" border="0"
						alt="" /></td>
				</tr>
				
			</table>
		</div>
	</form>
	<?php 
	if($warn){
		echo "<script type='text/javascript'>alert('Kullanıcı adı ve/veya şifre yanlış');</script>";
	}
	?>
</body>
</html>
<?php ob_end_flush(); ?> 
