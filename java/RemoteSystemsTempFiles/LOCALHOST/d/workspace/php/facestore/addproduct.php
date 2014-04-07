<?php 
if(isset($_POST["submit"])){
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
	}
	else
	{
	//	print_r($_FILES);
		 $target = "proimg/"; 
		 
		 $newname=uniqid();
		 
		 $info=pathinfo( $_FILES['file']['name']);
		 
		 $target = $target.$newname.".".$info["extension"] ; 
		 $ok=1; 
		 if(copy($_FILES['file']['tmp_name'], $target)) 
		 {
		 	require_once 'config.php';
		 	require_once 'Dbtool.php';
		 	
		 	$arr=array("img"=>$target,"name"=>"namex","pageid"=>1);
		 	
		 	$sql=Dbtool::getInsert("products",$arr);
		 	echo $sql;
		 	mysql_query($sql);
		 	
		 	echo "Resim başarıyla yüklendi. Başka resim yüklemek için <a href='addproduct.php'>buraya</a> tıklayın.";
		 } 
		 else {
			 echo "Sorry, there was a problem uploading your file.";
		 }
		/*echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
		
		
	}
}else{

?>

<html>
<body>

<form action="addproduct.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html> 
<?php }

?>