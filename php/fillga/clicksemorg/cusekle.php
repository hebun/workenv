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
$dapi->insert("insert into bayi(clientid,userid) values ('$_POST[clientid]','$_POST[userid]')");

echo '<div style="padding-top:100px;">Müşteri Eklendi. Pencereyi kapatın ve listeyi güncelleyin</div>';
}
else {
//print_r($_POST);
//

?>

<h2>Bayiye Müşteri Ekle</h2>

<form action='cusekle.php' method='post'>
<table cellpadding='5'>

<tr><td>
Bayi:
</td>
<td>

<select style="width:200px" name='userid'>
<?php
$users=$dapi->select("select * from users where type=2");
foreach ($users as $us) {
	echo "<option value='$us[id]'>$us[account]</option>";
}
?>
</select>

</td>
</tr>

<tr><td>
Eklenecek Hesap:
</td>
<td>

<select style="width:200px" name='clientid'>
<?php
$users=$dapi->select("select * from users where type=0");
foreach ($users as $us) {
	echo "<option value='$us[id]'>$us[account]</option>";
}
?>
</select>

</td>
</tr>


<tr><td>


</td>
<td valign='bottom'>
<input name='submit' type='submit' value='Ekle' style="width:150px" />


</td>
</tr>

</table>
<?php
}
?>
