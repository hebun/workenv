<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
//
@session_start();
error_reporting(E_ERROR);
require_once "../db.php";
if(isset($_POST["submit"])){
	if($_SESSION["type"]=="add"){
		$arr=array();
		$arr["name"]=$_POST["name"];
		$arr["hasFile"]=0;
		myQuery( insert($arr,"menu"));
		
		$id=mysql_insert_id();
		
		$arrc=array();
		$arrc["menuId"]=$id;
		$arrc["content"]=mysql_real_escape_string(ereg_replace("\n","<br>", $_POST["content"]));
		
		myQuery( insert($arrc,"content"));
	}
	elseif($_SESSION["type"]=="edit"){
		
		myQuery("update content set content='".mysql_real_escape_string(ereg_replace("\n","<br>", $_POST["content"]))."' where menuId=$_SESSION[menuId]");
			myQuery("update menu set name='$_POST[name]' where id=$_SESSION[menuId]");
	}
	echo "<script type=\"text/javascript\">".
		"window.opener.location.reload(); window.close();".
		"</script>";
}else{



$type=$_GET["type"];
$_SESSION["type"]=$type;
$name="";
$content="";
$buttonName="";

if($type=="edit"){
	$buttonName="Değiştir";
	$contentArr=select("select menu.name as name,content.content as content from menu join content on content.menuId=menu.id where menu.id=$_GET[id]");
	$_SESSION["menuId"]=$_GET["id"];
	$name=$contentArr[0]["name"];
	$content=ereg_replace("<br>","\n",$contentArr[0]["content"]);	
}else{
	$buttonName="Ekle";
}

?>
Normal metin veya HTML tabanlı içerik ekleyebilirsiniz. <br><br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">	

<table>
	<tr>
		<td>Menü Adı:</td>
		<td><input type="text" class="text" name="name" value="<?php echo $name;?>" size="size" maxlength="21" />
		En çok 21 karakter
		</td>

	</tr>
	<tr>
		<td>Menü İçeriği:<br></td>
		<td><textarea name="content" rows="18" cols="50" wrap="off"><?php echo $content;?></textarea> </td>
		
	</tr>
	<tr>
	<td></td>
		<td><input type="submit"  name="submit" value="<?php echo $buttonName; ?> " /> </td>
		
		
	</tr>
</table>
</form>
<?php

}
?>
</body>
</html>