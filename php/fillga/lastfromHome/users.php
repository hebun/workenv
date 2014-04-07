<?php
require_once "config.php";
@session_start();

if(!isset($_SESSION['username']) or $_SESSION['username']!='admin'){
	header("location:login.php");
}
if(isset($_POST['del'])){
	$dapidel=new Dapi();
	$dapidel->insert("update  users set del=1 where id=$_POST[id]");
	die('success');
}
require_once "top.php";


if(isset($_POST['updateUsers'])){
	$dapi->insert(' INSERT INTO users (customerId,account,bakiye,kbakiye,kupontype)
		SELECT distinct customerId,account,0,0,0
		FROM hesap as h
		WHERE NOT EXISTS (SELECT customerId
		FROM users as u
		WHERE u.customerId=h.customerId)
		');
}
?>
	<table width="100%" cellpadding="0" cellspacing="0">
	    <tbody><tr>
		<td style="padding: 10px 0px 10px 5px; width: 12%; min-width: 200px" valign="top">
		    <div style="border: 1px solid #b0b0b0; background-color: White; padding: 10px; -moz-border-radius: 4px;
			border-radius: 4px;">
			<h1 class="anasayfa_baslik" style="margin: 0px; padding-bottom: 4px">
			    Tüm Kampanyalar</h1>
			<table style="border-collapse: collapse; border: none; width: 100%" cellpadding="3" cellspacing="3">

				    <tbody><tr>
					<td style="width: 14px">
					    <img src="gareport_files/klasor.gif">
					</td>
					<td>
<!-- menu entry -->
					</td>
				    </tr>

			</tbody></table>
		    </div>
		</td>
		<td style="width: 85%; vertical-align: top">

    <table width="100%">
	<tbody><tr>
	    <td style="padding: 10px 5px 10px 5px;" valign="top">
		<div style="border: 1px solid #b0b0b0; background-color: White; padding: 10px; -moz-border-radius: 4px;
		    border-radius: 4px;">
		    <div style="height: 50px">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			    <tbody><tr>
				<td style="vertical-align: top">
				    <span class="anasayfa_baslik">Kullanicilar</span><br>
				    <strong id="ctl00_ContentPlaceHolder1_stTarihBilgisi" style="color: Red; font-weight: bold">
				    </strong>
				</td>
				<td class='sag'>
<form method='post' action="users.php">
<input type='submit' name='updateUsers' value='Listeyi Güncelle'/>
</form>
				</td>
			    </tr>
			</tbody></table>
		    </div>
			<div id="basic-modal">
<br>
<a href="kupongir.php?iframe=true&width=377&height=248" rel="prettyPhoto[iframes]" class='inputButon wordButon'>Kupon Gir</a>

<a href="odemegir.php?iframe=true&width=377&height=248" rel="prettyPhoto[iframes]" class='inputButon wordButon'>Ödeme Gir</a>

<a href="dekontgir.php?iframe=true&width=377&height=248" rel="prettyPhoto[iframes]" class='inputButon wordButon'>Dekont Gir</a>

			</div>
		    <div id="ctl00_ContentPlaceHolder1_divAnahtarKelimeIcerik" style="background-color: #f9f9f9;">
			<table width="100%" cellpadding="3" cellspacing="0">
			    <thead class="tabloBaslik">
				<tr>
				    <th class="sol">
Hesap Adi
				    </th>
				    <th class="sol">
Musteri Id
				    </th>
				    <th class="sol">
bakiye
				    </th>
				    <th class="sol">
     Kupon bakiyesi
				    </th>

				    <th class="sol">
     Kupon Tipi
				    </th>

				    <th class="sol">
İşlemler
				    </th>

				</tr>
			    </thead>
			    <tbody class="tabloIcerik">
<?php 
$sql="select * from users where account<>'admin' and del=0";
//echo $sql;
$res=$dapi->select($sql);
//print_r($res);
foreach ($res as $row) {
	// <a href='kupongir.php?iframe=true&width=377&height=288&cid=$row[customerId]' rel='prettyPhoto[iframes]'>Kupon Gir</a>
	echo "<tr>
		<td style='width:100px;'>
		$row[account]
		</td>
		<td style='width:100px;'>
		$row[customerId]
		</td>
		<td class='sag'>
		<span style='vertical-align: middle; color: #0066cc' class='sol'>$row[bakiye]</span>
		</td>
		<td class='sag'>

		$row[kbakiye]  
		</td>

		<td class='sag'>

		%$row[kupontype]00
		</td>

		<td class='sol'>
<button onclick='deleteAccount($row[id])' >Sil</button>
		</td>
		</tr>

		";
}
?>

			    </tbody>
			</table>
		    </div>
		    <div style="width: 99%">
		    </div>
		</div>
	    </td>
	</tr>
    </tbody></table>
    <hr>

    <div style="clear: both; height: 2px; width: 100%">
    </div>
    <div id="footer">
	<a href="http:///" target="_blank"></a>
	<br>
	All Right Reserved 2013
    </div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto();
	console.log('blbblba');
});
</script>
    </body>
    </html>

