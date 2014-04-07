<?php
require_once 'config.php';
require_once 'Dbtool.php';
$pid=$_GET["pid"];
$name="";
$price="";
$img="";

if($pid!=="0"){
	$table=select("select * from products where id=$pid");

	$name=$table[0]["name"];
	$price=$table[0]["price"];
	$img=$table[0]["img"];

}

?>
<script type="text/javascript" src="client.js">

</script>
<style type="text/css">
.errormessage {
	background-color: #FFEBE8;
	border-color: #DD3C10;
	border-style: solid;
	border-width: 1px;
	padding: 10px;
	text-align: center;
}

.label {
	color: #666666;
	cursor: pointer;
	font-weight: bold;
	vertical-align: middle;
}

.desc {
	color: #666666;
	cursor: pointer;
	font-weight: normal;
	vertical-align: middle;
}

.adminnote {
	width: 420px;
}

.payvmentSearchNotice,.payvmentMessageBox,.adminnote {
	background: none repeat scroll 0 0 #FFF9D7;
	border: 1px solid #E2C822;
	clear: both;
	color: #333333;
	font-weight: bold;
	margin: 8px 0;
	padding: 10px 20px;
	text-align: center;
}

.cartShippingAddressViewNotification {
	border-style: solid;
	font-size: 11px;
	margin-bottom: 12px;
	padding-left: 30px;
	text-align: left;
	width: 300px;
}

.error {
	background-color: #FFEBE8;
	border-color: #DD3C10;
}
/* ui-dialog checkout stuff */
</style>


<form method="POST" id="orderForm" action="editProComp.php"
	enctype="multipart/form-data">

	<div id="checkoutflowshippingDiv" style="width: 380px;">

		<div align="center" style="width: 380px;" id="checkoutInner">

			<div style="clear: both;"></div>

			<table align="left" cellspacing="0" cellpadding="4" border="0"
				id="shippingAddress">
				<tbody>
					<tr>
						<td colspan="3">
							<div id="checkouttext1"
								class="adminnote cartShippingAddressViewNotification">Ürün
								Ekleme/Değiştirme</div>
								<input type="hidden" name="pid"
							value="<?php echo  $_GET['pid'];?>">
						</td>
					</tr>
					<tr id="fieldError" class="UIMessage error" style="display: none">
						<td style="text-align: center; font-weight: bold;" colspan="3">
							Aşağıdaki alanlar boş geçilemez.<br> <span id="errorArea"> </span>
						</td>
					</tr>
					<?php if($pid!=="0"){ ?>
					<tr>
						<td></td>
						<td><span class="label">Ürün</span></td>
						<td><span class="desc"><?php echo Dbtool::selectOne("products","name","id",$_GET["pid"]); ?>
						</span>
						</td>
					</tr>
					<?php }?>
					<tr>
						<td><span class="redText">*</span></td>
						<td><span class="label" id="lname" for="name">Ürün Adı</span></td>
						<td><input type="text" label="Ad ve Soyad" class="inputtext"
							size="35" value="<?php echo $name;?>" required="true" id="name"
							name="name"></td>
					</tr>

					<tr>
						<td><span class="redText">*</span></td>
						<td><label class="label" id="lprice" for="price">Fiyatı</label></td>
						<td><input type="text" class="inputtext" size="35"
							value="<?php echo $price;?>" required="true" id="price"
							name="price"></td>
					</tr>
						<?php if($pid!=="0"){
						echo "<tr><td></td><td></td><td><img src='../../$img' /></td></tr>";
						}
						?>
					<tr>
						<td>*</td>
						<td><label class="label" id="limg" for="img">Resim</label></td>
						<td><input type="file" class="inputtext" required="true" size="25"
							value="" id="img" name="img"></td>
					</tr>

					<tr>
						<td></td>
						<td><input type='button' style="width: 100px;"  onclick='parent.TINY.box.hide()' value='Kapat' /></td>
						<td align="right"><input style="width: 100px;" type="button"
							value="Gönder" name="submitBut" onclick="submitEditPro(<?php echo $pid==="0"?"false":"true";?>)" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</form>
<div style="clear: both"></div>
<br />
