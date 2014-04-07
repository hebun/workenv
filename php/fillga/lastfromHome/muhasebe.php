<?php
require_once "config.php";
@session_start();

if(!isset($_SESSION['username']) ){
	header("location:login.php");
}
if(isset($_POST['del'])){
	$dapidel=new Dapi();
	$dapidel->insert("update  users set del=1 where id=$_POST[id]");
	die('success');
}
require_once "top.php";
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
<?php

$sql="select distinct campaign from adwords where customerId='$_SESSION[customerId]' group by campaign";
$res=$dapi->select($sql);
if($_SESSION['username']!='admin'){
	$defaultC=isset($_GET['campaign'])?$_GET['campaign']:$res[0]['campaign'];
	foreach ($res as $r) {
		//	echo $r['campaigns'];
		echo '<a style="color: #0066cc" href="campaigns.php?campaign='.$r['campaign'].'">'.$r['campaign'].'</a>';
	}}
?>

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
				</td>
			    </tr>
			</tbody></table>
		    </div>
			<div id="basic-modal">
			</div>
		    <div id="ctl00_ContentPlaceHolder1_divAnahtarKelimeIcerik" style="background-color: #f9f9f9;">
			<table width="100%" cellpadding="3" cellspacing="0">
	    		    <thead class="tabloBaslik">
		 		<tr>
		<?php
		
		if($_SESSION['username']=='admin'){

			echo "<th>Hesap</th>";
		}
?>
				    <th class="sol">
İşlem Tipi
				    </th>
				    <th class="sol">
Tutar
				    </th>
				    <th class="sol">
Tarih
				    </th>
				    <th class="sol">
Açıklama
				    </th>

				</tr>
			    </thead>
			    <tbody class="tabloIcerik">
<?php 
		$sql='';
	if($_SESSION['username']=='admin'){

		$sql="select * from muhasebe as m inner join users as u on u.customerId=m.customerId ";

	}else
		$sql="select * from muhasebe where customerId=$_SESSION[customerId] ";
	//echo $sql;
	$res=$dapi->select($sql);
	//print_r($res);
	foreach ($res as $row) {
		// <a href='kupongir.php?iframe=true&width=377&height=288&cid=$row[customerId]' rel='prettyPhoto[iframes]'>Kupon Gir</a>
		echo "<tr>";
		if($_SESSION['username']=='admin'){

			echo "<td>$row[account]</td>";
		}
		echo "<td style='width:100px;'>
			$row[type]
			</td>
			<td style='width:100px;'>
			$row[tutar]
			</td>
			<td class='sag'>

			$row[tarih]  
			</td>
			<td class='sol'>
			<span style='vertical-align: middle; color: #0066cc' class='sol'>$row[aciklama]</span>
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

