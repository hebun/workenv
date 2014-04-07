
<style type="text/css">
<!--
.metin {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	color: #CCC;
	vertical-align: bottom;
}
body {
	background-image: url(image/m2.jpg);
}
-->
</style>
<form id="form1" name="form1" method="post" action="formhandle.php">
<table width="460" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20" height="124">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td><table width="440" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="140" height="30">            <span class="metin">
            <input name="ad" type="text"id="input_4" value="Ad: " size="20" maxlength="30"  />            
            </span></td>
          <td height="30">&nbsp;</td>
          <td width="140" height="30">            <span class="metin">
            <input name="soyad" type="text" class="form-textbox"id="input_10" value="Soyad: " size="20" maxlength="30" />            
            </span></td>
          <td height="30">&nbsp;</td>
          <td width="140" height="30">            <span class="metin">
            <input name="telefon" type="text" class="form-textbox"id="input_18" value="Tel: " size="20" maxlength="30" />            
            </span></td>
        </tr>
        <tr>
          <td width="140" height="30">            <span class="metin">
            <input name="email" type="text" class="form-textbox"id="input_19" value="Mail: " size="20" maxlength="30" />            
            </span></td>
          <td height="30">&nbsp;</td>
          <td height="30" colspan="3">
            <span class="metin">
            <select class="form-dropdown" style="width:300px" id="input_21" name="referans">
              <option> </option>
              <option value="Reflü Problemleri" selected="selected"> Reflü Problemleri </option>
              <option value="Gastrit Problemleri"> Gastrit Problemleri </option>
              <option value="Mide Problemleri"> Mide Problemleri </option>
              <option value="Damar Tıkanıklığı Sorunları"> Damar Tıkanıklığı Sorunları </option>
              <option value="Panik Atak Depresyon Sorunları"> Panik Atak Depresyon Sorunları </option>
              <option value="Bağırsak Problemleri"> Bağırsak Problemleri </option>
              <option value="Bağışıklık Sistemi ve Alerji"> Bağışıklık Sistemi ve Alerji </option>
              <option value="Bel Fıtığı Problemleri"> Bel Fıtığı Problemleri </option>
              <option value="Boyun Fıtığı Problemleri"> Boyun Fıtığı Problemleri </option>
              <option value="Kolesterol Sorunları"> Kolesterol Sorunları </option>
              <option value="Kireçlenme Sorunları"> Kireçlenme Sorunları </option>
              <option value="Karaciğer Yetmezliği"> Karaciğer Yetmezliği </option>
              <option value="Tansiyon Problemleri"> Tansiyon Problemleri </option>
              <option value="Romatizmal Sorunlar"> Romatizmal Sorunlar </option>
              <option value="Kanser Problemleri"> Kanser Problemleri </option>
              <option value="Diyabet Şeker Problemleri"> Diyabet Şeker Problemleri </option>
              <option value="MS Sorunları"> MS Sorunları </option>
              <option value="Epilepsi Sorunları"> Epilepsi Sorunları </option>
              <option value="Safra Taşları Problemleri"> Safra Taşları Problemleri </option>
              <option value="Parkinson Sorunları"> Parkinson Sorunları </option>
              <option value="Alzheimer Sorunları"> Alzheimer Sorunları </option>
              <option value="İnme ve Felç Problemleri"> İnme ve Felç Problemleri </option>
              <option value="Kilo Problemleri"> Kilo Problemleri </option>
              <option value="Hepatit Problemleri"> Hepatit Problemleri </option>
              <option value="Varis Problemleri"> Varis Problemleri </option>
              <option value="Basur Sorunu"> Basur Sorunu </option>
              <option value="Kısırlık Problemleri"> Kısırlık Problemleri </option>
              <option value="Azosperm Sorunları"> Azosperm Sorunları </option>
              <option value="Bayan Cinsel Problemleri"> Bayan Cinsel Problemleri </option>
              <option value="Erkek Cinsel Problemleri"> Erkek Cinsel Problemleri </option>
            </select>
            </span></td>
        </tr>
        <tr>
          <td colspan="5"><table width="440" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="220" height="100">
                <span class="metin">
                <textarea id="input_17" class="form-textarea" name="soru" cols="26" rows="5" >Sorunuz: </textarea>
                </span></td>
              <td width="220" height="100">
                <span class="metin">
                <textarea id="input_20" class="form-textarea" name="adres" cols="26" rows="5">Adresiniz: </textarea>
                </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="5"><span class="metin">
            <!--Bu verilerin degismemesi lazim(ismet) -->
            <?php

	     echo "<input type='hidden' name='name' value='$apime[first_name]'/>";
	     echo "<input type='hidden' name='surname' value='$apime[last_name]'/>";
	     echo "<input type='hidden' name='femail' value='$apime[email]'/>";
?>
            <button id="input_2" type="submit" class="form-submit-button"> Sorumu Gönder </button>
          </span></td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
<p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
