<?php
if ($islem == "giris") {
  $sifre = $_POST['password'];
  $kripto = md5(sha1(md5(sha1(md5(sha1("$sifre")))))); 
  @ $benitani = intval($_POST['benitani']);
  $us = $_POST['username'];



  $sorgu = @mysql_query("select * from admin where username = '".$us."' and password = '".$kripto."' limit 1");
  if (@mysql_num_rows($sorgu) == "1" ) {
    $x = mysql_fetch_array($sorgu);
    echo "<center>Giriþ iþlemi tamamlandý";

  if ($benitani == 1)
  {

    setcookie("admin_username", $x['username'], time()+2592000);
    setcookie("admin_password", $x['password'], time()+2592000);
  } else {
    setcookie("admin_username", $x['username'], time()+900);
    setcookie("admin_password", $x['password']);
  }

    Header("Location: index.php");

  } else {
    echo "<center><br>Kullanýcý Adý Yada Þifresi Hatalý<br>Lütfen geri dönerek tekrar deneyiniz...";
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"3;URL=?file=login\">";

  }
} else {

?>
<form method="POST" action="?file=login">

<TABLE height="100%" cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD align=middle>
      <TABLE borderColor=#010207 cellSpacing=0 cellPadding=1 width=500 
      align=center border=1>
        <TBODY>
        <TR>
          <TD width=250><IMG height=149 
            src="ana_resim.gif" width=250 
          border=0></TD>
          <TD width=250><table width="100%" border="0">
            <tr>
              <td><b>&nbsp;Yönetici</b></td>
              <td><input type="text" name="username" size="22"  /></td>
            </tr>
            <tr>
              <td><b>&nbsp;Þifre</b></td>
              <td><input type="password" name="password" size="22" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="checkbox" id="benitani" name="benitani" value="1" />
<FONT face="Tahoma" size="2">Beni Hatýrla</FONT> </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="submit" type="submit" value="Giriþ" style="width: 114px; background-color: #5fccff"/></td>
            </tr>
          </table></TD>
        </TR></TABLE></TD>
  </TR></TBODY></TABLE>

	<input type="hidden" name="islem" value="giris">
</form>

<?
}
?>