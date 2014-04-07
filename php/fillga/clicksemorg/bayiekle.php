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
$dapi->insert("insert into users(account,customerId,type) values ('$_POST[account]','$_POST[customerId]',2)");

echo '<div style="padding-top:100px;">Bayi Eklendi. Pencereyi kapatın ve listeyi güncelleyin</div>';
}
else {
//print_r($_POST);
//

?>

<h2>Bayi Ekle</h2>

<form action='bayiekle.php' method='post'>
<table cellpadding='5'>

<tr><td>
Kullanıcı Adı:
</td>
<td>

<input type='text'  name='account'/>
</td>

</tr>

<tr><td>
Şifre:

</td>
<td>
<input type='text' onkeypress="return isNumberKey(event)" name='customerId'/>

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
