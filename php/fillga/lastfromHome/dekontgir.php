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
	$dapi->insert("update users set bakiye=bakiye-$_POST[bakiye] where customerId=$_POST[account]");
	$dapi->insert("insert into muhasebe set customerId=$_POST[account],aciklama='$_POST[aciklama]' type='dekont',tutar=$_POST[bakiye],tarih='".date('Y-m-d H:i:s')."'");

	echo '<div style="padding-top:100px;">Dekont Eklendi. Pencereyi kapatin ve listeyi guncelleyin</div>';
	
}else{
?>

<h2>Dekont Gir</h2>

<form action='dekontgir.php' method='post'>
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
Dekont Tutari:


</td>
<td>
<input type='text' onkeypress="return isNumberKey(event)" name='bakiye'/>


</td>
</tr>
<td>Açıklama:
<td>
<textarea type='text'  name='aciklama'></textarea>


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
