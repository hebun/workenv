<?php
require_once 'config.php';
require_once 'Page.php';
require_once 'Dbtool.php';



$error="Ürün Eklendi";

$isup=$_POST["pid"]==="0"?false:true;

$fileError=false;

$continue=true;


if ($_FILES["img"]["error"] > 0)
{
	if($isup===false){
		$continue=false;
		$error= "Resim yüklenemedi.";
	}
	$fileError=true;

}

if($continue===true){
	$price=$_POST["price"];
	$name=$_POST["name"];

	if($isup and $fileError){
		require_once 'Dbtool.php';
		$arr=array("name"=>"$name","price"=>$price);
		$sql=Dbtool::getUpdate("products",$arr,"id",$_POST["pid"]);

		myQuery($sql);

	}else{
         $upfolder="../../";
		$target = "proimg/";
		$bigTarget="bigImg/";
		$newname=uniqid();

		$info=pathinfo( $_FILES['img']['name']);

		$orgname=$info["filename"];

		$target = $target.$newname.".".$info["extension"] ;
		$bigTarget= $bigTarget.$newname.".".$info["extension"] ;
		$ok=1;
		if(copy($_FILES['img']['tmp_name'],  $upfolder.$bigTarget))
		{
			require_once 'config.php';
			require_once 'Dbtool.php';
			require_once 'src/SimpleImage.php';
			$image;
			try {
				$image = new SimpleImage();
				$image->load( $upfolder.$bigTarget);
				$image->scale(40);
				$image->save( $upfolder.$target);


				$arr=array("img"=>$target,"bigimg"=>$bigTarget,"name"=>"$name",
			 			"pageid"=>$config->pageid,"price"=>$price,"consprice"=>$price);

				if($_POST["pid"]==="0"){
					$sql=Dbtool::getInsert("products",$arr);

				}else{
					$sql=Dbtool::getUpdate("products",$arr,"id",$_POST["pid"]);
				}

				//echo $sql;
				myQuery($sql);


			} catch (Exception $e) {
				$error= "Resim yüklenemedi.";
			}
		}
		else {
			$error=	 "Yükleme yapılırken hata oluştu.";
		}
	}

}



?>
<style>
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
	font-size: 14px;
	margin-bottom: 12px;
	padding-left: 30px;
	text-align: left;
	width: 300px;
}
</style>
<div style="vertical-align: center; margin-top: 100px; width: 300px;"
	align="center" id="checkouttext1"
	class="adminnote cartShippingAddressViewNotification">


	<?php  echo "$error";?></div>
<div style="width: 300px; text-align: center">
	<input type="button" onclick="parent.closeTiny()"
		style="width: 100px" value="Kapat">
</div>
