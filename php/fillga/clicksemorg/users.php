<?php
require_once "config.php";
function getMonthTotal($ay,$currentcus)
{
	global $dapi;
	$sqlay="select sum(borc) as toplam  from muhasebe where month(tarih)=$ay and customerId=$currentcus";

	$buayres=$dapi->select($sqlay);
	$buayrow=$buayres[0]['toplam'];
	return $buayrow;
}
@session_start();
$usertype=$_SESSION['type'];
$userid=$_SESSION['userid'];
if(!isset($_SESSION['username']) or $usertype==0){
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
	<table width="90%" cellpadding="0" cellspacing="0">
	    <tbody><tr><td>
				</td>
			    </tr>
			</tbody></table>
		    </div>
			<div id="basic-modal">
<br>
<?php
if($_SESSION['type']==1){
?>
<a href="kupongir.php?iframe=true&width=377&height=248" rel="prettyPhoto[iframes]" class='inputButon wordButon'>Kupon Gir</a>

<a href="odemegir.php?iframe=true&width=377&height=248" rel="prettyPhoto[iframes]" class='inputButon wordButon'>Ödeme Gir</a>

<a href="dekontgir.php?iframe=true&width=377&height=248" rel="prettyPhoto[iframes]" class='inputButon wordButon'>Dekont Gir</a>

<?php
}
?>
			</div>
		    <div id="ctl00_ContentPlaceHolder1_divAnahtarKelimeIcerik" style="background-color: #f9f9f9;">
			<table width="100%" style='padding-left=10px;' cellpadding="3" cellspacing="0">
			    <thead class="tabloBaslik">
				<tr>
				    <th class="sol">
Hesap Adı
				    </th>
				    <th class="sol">
Müsteri Id
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
<?php
if($usertype==2){
?>
				    <th class="sol">
Son Ay
				    </th>
				    <th class="sol">
Geçen Ay
				    </th>
				    <th class="sol">
Önceki Ay
				    </th>

<?php
}else{
	echo '

		<th class="sol">
		İşlemler
		</th>
		';

}
?>
				</tr>
			    </thead>
			    <tbody class="tabloIcerik">
<?php 
$sql='';
if($usertype==1)
	$sql="select * from users where account<>'admin' and del=0 and type=0";
elseif($usertype==2){

	$sql="select * from users as u inner join bayi as b on b.clientid=u.id where b.userid=$userid";
}
//echo $sql;
$res=$dapi->select($sql);
//printjj_r($res);
foreach ($res as $row) {
	// <a href='kupongir.php?iframe=true&width=377&height=288&cid=$row[customerId]' rel='prettyPhoto[iframes]'>Kupon Gir</a>
	echo "<tr>
		<td style='width:100px;'>";
		if($usertype==1)
		{
			echo "
		<a href='muhasebe.php?cusid=$row[customerId]'>	$row[account]</a>
		";
		}elseif($usertype==2){
		
			echo "
$row[account]
		";
		
		}
		echo "
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
		";
	if($usertype==1){
		echo "
			<td class='sol'>
			<button onclick='deleteAccount($row[id])' >Sil</button>
			</td>
			";
	}	
	elseif($usertype==2){
		$buay=date('m');
		$sqlay="select sum(borc) as toplam  from muhasebe where month(tarih)=$buay and customerId=$row[customerId] ";

		$buayres=$dapi->select($sqlay);
		$buayrow=$buayres[0]['toplam'];

		echo "
			<td class='sol'>".
			getMonthTotal($buay,$row['customerId'])."
			</td> 	<td class='sol'>".
			getMonthTotal($buay-1,$row['customerId'])."
			</td> 	<td class='sol'>".
			getMonthTotal($buay-2,$row['customerId'])."
			</td> ";

	}
	echo "
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

