<style type="text/css">
<!--
.merhaba {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: bold;
	color: #FFF;
}

a {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	color: #FFF;
}
a:visited {
	color: #FFF;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
}
a:hover {
	color: #FF0;
	font-size: 10px;
	font-family: Verdana, Geneva, sans-serif;
}
.referans {
	color: #FFF;
	font-size: 12px;
	font-family: Verdana, Geneva, sans-serif;
}
-->
</style>

<?php 
function printBar($name,$fcount,$uid){
  echo "<table width='1070' height='35' border='0' cellspacing='0' cellpadding='0' background='img/bar-bg.png'>
  <tr>
    <td width='44' class='merhaba'>&nbsp;</td>
    <td width='212' class='merhaba'>Merhaba, $name </td>
	<td width='30' class='merhaba'> </td>
	<td width='242' class='merhaba'>Bitkiblog'a üye $fcount arkadaşın var </td>
	<td width='96' class='merhaba'><a target='_blank' href='http://www.facebook.com/Bitkiblog'>İletişim</a> </td>
	<td width='47' class='merhaba'> </td>
	<td width='399' class='referans'>".getRefLink($uid)."</td>
  </tr>
</table>";

}
function getRefLink($uid){
  return "http://apps.facebook.com/bitkiblog/?uid=$uid";
}
?> 