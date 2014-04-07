<style type="text/css">
<!--
.merhaba {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	font-style: italic;
	font-weight: bolder;
	color: #FFF;
	clip: rect(auto,auto,auto,auto);
	position: static;
	height: 25px;
}



-->
</style>

<?php 
function printBar($name,$fcount,$uid){
  $fcount++;
  echo "<table width='1070' heigth:'50' border='0' cellspacing='0' cellpadding='0' background='img/bar-bg.png'>
  <tr>
    <td width='125' class='merhaba'>&nbsp;</td>
    <td width='192' class='merhaba'> $name </td>
	<td width='190' class='merhaba'> </td>
	<td width='69' class='merhaba'> $fcount </td>
	<td width='212' class='merhaba'><a href='#' onclick='postToFeed()'><img src='img/davet.png'  alt='ARKADAŞINI DAVET ET' /></a></td>
	<td width='208' class='merhaba'><a href='https://www.facebook.com/evdenekgelirekisimkanlari' target='_parent'><img src='img/facebook.png'  alt='FACEBOOK SAYFASI' /></a></td>
	<td width='74' class='merhaba'>&nbsp;</td>
  </tr>
</table>";

}

function getShare(){
  $dapi =new Dapi();
  $shares=$dapi->select()->from('jshare')->where('pid=1')->order('RAND()')->limit(1)->getArray();

  return $shares[0];


}
function getRefLink($uid){
  return "https://apps.facebook.com/ekisekgelirimkanlari/?uid=$uid";
}
?> 