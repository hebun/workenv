<?php
require_once "config.php";
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
<a href="bayiekle.php?iframe=true&width=377&height=248" rel="prettyPhoto[iframes]" class='inputButon wordButon'>Bayi Ekle</a>
<a href='cusekle.php?iframe=true&width=377&height=248' rel='prettyPhoto[iframes]' class='inputButon wordButon'>Bayiye Müşteri Ekle</a>

<?php
}
?>
			</div>
		    <div id="ctl00_ContentPlaceHolder1_divAnahtarKelimeIcerik" style="background-color: #f9f9f9;">
			<table width="100%" style='padding-left=10px;' cellpadding="3" cellspacing="0">
			    <thead class="tabloBaslik">
				<tr>
				    <th class="sol">
Bayi Ismi
				    </th>
				    <th class="sol">
Müsterileri
				    </th>
				    <th class="sol">
İşlemler
				    </th>

				</tr>
			    </thead>
			    <tbody class="tabloIcerik">
<?php 
$sql='';
if($usertype==1)
$sql="select * from users where del=0 and type=2";
elseif($usertype==2){

}
//echo $sql;
$res=$dapi->select($sql);
//printjj_r($res);
foreach ($res as $row) {
	// <a href='kupongir.php?iframe=true&width=377&height=288&cid=$row[customerId]' rel='prettyPhoto[iframes]'>Kupon Gir</a>
	//
	$sqlcus="select * from users as u inner join bayi as b on u.id=b.clientid where b.userid=$row[id]";
	$rescus=$dapi->select($sqlcus);
	$customers='';
	foreach ($rescus as $rowcus) {

		$customers.=$rowcus['account'].' , ';
	}
	echo "<tr>
		<td style='width:100px;'>
		$row[account]
		</td>
		<td style='width:800px;'>
		$customers
		</td>
";
if($usertype==1){
	echo "
		<td class='sol'>
<button onclick='deleteBayi($row[id])' >Sil</button>
		</td>
		";
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

