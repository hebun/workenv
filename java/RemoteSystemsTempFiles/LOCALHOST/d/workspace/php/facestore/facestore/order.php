<?php
require_once 'config.php';
require_once 'Dbtool.php';
$moves=array("ip"=>$_SERVER["REMOTE_ADDR"],"move"=>"order->$_GET[pid]","moveid"=>"2");

Dbtool::myQuery(Dbtool::getInsert("moves",$moves));
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
	width: 430px;
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


<form method="POST" id="orderForm" action="orderComplete.php">

	<div id="checkoutflowshippingDiv" style="width: 380px;">

		<div align="center" style="width: 380px;" id="checkoutInner">

			<div style="clear: both;"></div>

			<table align="left" cellspacing="0" cellpadding="4" border="0"
				id="shippingAddress">
				<tbody>
					<tr>
						<td colspan="3">
							<div id="checkouttext1"
								class="adminnote cartShippingAddressViewNotification">
								Siparişinizi tamamlamak için aşğıdaki formu doldurun.</div>
						</td>
					</tr>
					<tr id="fieldError" class="UIMessage error" style="display:none">
						<td  style="text-align: center; font-weight: bold;" colspan="3">
						Aşağıdaki alanlar boş geçilemez.<br>
						<span id="errorArea"> </span>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><span class="label">Ürün</span></td>
						<td><span class="desc"><?php echo Dbtool::selectOne("products","name","id",$_GET["pid"]); ?>
						</span><input type="hidden" name="pid" value="<?php echo  $_GET['pid'];?>" > </td>
					</tr>
					<tr>
						<td><span class="redText">*</span></td>
						<td><span class="label" id="lnamesurname" for="firstName">Ad ve Soyad</span></td>
						<td><input type="text" label="Ad ve Soyad" class="inputtext" size="35" value=""
							required="true" id="namesurname" name="namesurname"></td>
					</tr>

					<tr>
						<td><span class="redText">*</span></td>
						<td><label class="label" id="lemail" for="email">Email</label></td>
						<td><input type="text" class="inputtext" size="35" value=""
							required="true" id="email" name="email"></td>
					</tr>

					<tr>
						<td>*</td>
						<td><label class="label" id="ltelephone" for="telephone">Telefon</label></td>
						<td><input type="text" class="inputtext" required="true" size="35"
							value="" id="telephone" name="telephone"></td>
					</tr>

					<tr>
						<td><span class="redText">*</span></td>
						<td><label class="label" id="laddress" for="address">Adres</label></td>
						<td><input type="text" size="35" required="true" id="address"
							name="address" />
						</td>
					</tr>

					<tr>
						<td><span class="redText">*</span></td>
						<td><label class="label" id="lcity" for="city">Şehir</label></td>
						<td><input type="text" class="inputtext" size="35" required="true"
							value="" id="city" name="city" />
						</td>
					</tr>

					<tr>
						<td><span class="redText">*</span></td>
						<td><label class="label" id="lpaymenttype" for="paymenttype">Ödeme Tipi</label></td>
						<td><select style="width: 240px;" id="paymenttype"
							name="paymenttype">
								<option value="0">Seçiniz..</option>
								<option value="1">Kapıda Ödeme</option>
								<option value="2">Kapıda Kredi Kartı İle Ödeme</option>							
						</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td></td>
						<td><input type='button' style="width: 100px;"  onclick='parent.TINY.box.hide()' value='Kapat' /></td>
						<td align="right"><input style="width: 100px;" type="button"
							value="Gönder" name="submitBut" onclick="submitOrder()" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</form>
<div style="clear: both"></div>
<br />
