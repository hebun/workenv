<SCRIPT language=Javascript>
<!--
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode != 46 && charCode > 31 
		&& (charCode < 48 || charCode > 57))
		return false;

	return true;
}
//-->
</SCRIPT>
<?php
require_once 'config.php';

$dapi=new Dapi();

//

if(isset($_POST['submit'])){
	$user=$dapi->select("select kbakiye,bakiye,kupontype from users where customerId=$_POST[account]");
	$user=$user[0];

	$ktype=$user['kupontype'];
	$reelKupon=($ktype*$_POST['bakiye']);
	$newkbak=$user['kbakiye']-$reelKupon;
	if($newkbak<0){
		$reelKupon=$user['kbakiye'];
		$newkbak=0;
	}
	
	$newbak=$_POST['bakiye']+$reelKupon;
$curbak=$user['bakiye']+$newbak;
	$dapi->insert("update users set bakiye=bakiye+$newbak,kbakiye=$newkbak where customerId=$_POST[account]");
$dapi->insert("insert into muhasebe set customerId=$_POST[account],type='ödeme',alacak=$_POST[bakiye],curbak=$curbak, tarih='".date('Y-m-d H:i:s')."'");

	echo '<div style="padding-top:100px;">Ödeme Eklendi. Pencereyi kapatin ve listeyi guncelleyin</div>';
	
}else{
?>

<h2>Ödeme Gir</h2>

<form action='odemegir.php' method='post'>
<table cellpadding='5'>

<tr><td>
Hesap:

</td>
<td>

<select name='account'>
<?php
	$users=$dapi->select("select * from users where account<>'admin'");
	foreach ($users as $us) {
		echo "<option value='$us[customerId]'>$us[account]</option>";
	}
?>
</select>
</td>

</tr>

<tr><td>
Ödeme Tutari:


</td>
<td>
<input type='text' onkeypress="return isNumberKey(event)" name='bakiye'/>


</td>
</tr>

<tr><td>


</td>
<td valign='bottom'>
<input name='submit' type='submit' value='Kaydet' style="width:150px" />


</td>
</tr>

</table>
<?php
}
?>
