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
$curkbak=$dapi->select("select kbakiye from users where customerId=$_POST[account]")[0]['kbakiye'];
if($curkbak!=='0'){

echo '<div style="padding-top:100px;">Kupon eklenebilmesi  icin mevcut kupon bakiyesinin 0 olmasi lazim.</div>';
}else{

$dapi->insert("update users set kbakiye=$_POST[kbakiye], kupontype=$_POST[kupontype] where customerId=$_POST[account]");
$dapi->insert("insert into muhasebe set customerId=$_POST[account],type='kupon',tutar=$_POST[kbakiye],tarih='".date('Y-m-d H:i:s')."'");
echo '<div style="padding-top:100px;">Kupon Eklendi. Pencereyi kapatin ve listeyi guncelleyin</div>';
}
//print_r($_POST);
//
}else{
?>

<h2>Kupon Gir</h2>

<form action='kupongir.php' method='post'>
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
Kupon Tutari:


</td>
<td>
<input type='text' onkeypress="return isNumberKey(event)" name='kbakiye'/>


</td>
</tr>

<tr><td>
Kupon Tipi:


</td>
<td>
<select name='kupontype'>
<option value='1'>%100</option>
<option value='2'>%200</option>
<option value='3'>%300</option>
<option value='4'>%400</option>
<option value='5'>%500</option>


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
