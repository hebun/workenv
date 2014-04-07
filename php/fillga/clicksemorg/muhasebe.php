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
$curCus=$_SESSION['customerId'];
if(isset($_GET['cusid']))
{

	$curCus=$_GET['cusid'];
}
?>
	<table width="100%" cellpadding="0" cellspacing="0">
	    <tbody><tr>
		<td style="width: 95%; vertical-align: top">

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
		
?>
				    <th class="sol">
Tarih
				    </th>
				    <th class="sol" style='width=300px'>
Açıklama
				    </th>
				    <th class="sol">
Borç
				    </th>
				    <th class="sol">
Alacak
				    </th>
				    <th class="sol">
Bakiye
				    </th>

				</tr>
			    </thead>
			    <tbody class="tabloIcerik">
<?php 
		$sql='';
		$sql="select * from muhasebe where customerId=$curCus  order by id desc";
	//echo $sql;
	$res=$dapi->select($sql);
	//print_r($res);
	foreach ($res as $row) {
		// <a href='kupongir.php?iframe=true&width=377&height=288&cid=$row[customerId]' rel='prettyPhoto[iframes]'>Kupon Gir</a>
		echo "<tr>";
		echo "<td style='width:100px;'>
			$row[tarih]
			</td>
			<td style='width:400px;'>
			$row[type]
			</td>
			<td class='sag' style='width:100px;'>

			$row[borc]  
			</td>
			<td class='sag' style='width:100px;'>

			$row[alacak]  
			</td>
			<td class='sag' style='width:100px;'>

			$row[curbak]  
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

