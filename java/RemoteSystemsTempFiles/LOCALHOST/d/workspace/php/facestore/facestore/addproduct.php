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
		 $bigTarget="bigImg/";
		 $newname=uniqid();
		 
		 $info=pathinfo( $_FILES['file']['name']);
		 
		 $orgname=$info["filename"];
		 
		 preg_match_all("#\((.*?)\)#",$orgname,$matches);
		 $price=$matches[1][0];
		 
		 preg_match_all("# (.*?)\(#",$orgname,$matches);
	
		 $name="İpek Vera ".$matches[1][0];
		
		 
		 
		 $target = $target.$newname.".".$info["extension"] ;
		 $bigTarget= $bigTarget.$newname.".".$info["extension"] ;
		 $ok=1; 
		 if(copy($_FILES['file']['tmp_name'],  $bigTarget)) 
		 {
		 	require_once 'config.php';
		 	require_once 'Dbtool.php';
		 	require_once 'src/SimpleImage.php';
		 	
		 //	$last=Dbtool::selectOne("products","name","name",$name);
		 	
		 //	echo $last;
		 	
		 	$image = new SimpleImage();
		 	$image->load( $bigTarget);
		 	$image->scale(40);
		 	$image->save( $target);
		 	
		 	$arr=array("img"=>$target,"bigimg"=>$bigTarget,"name"=>"$name",
		 			"pageid"=>$_GET["page"],"price"=>$price,"consprice"=>$price);
		 	
		 	$sql=Dbtool::getInsert("products",$arr);
		 	echo $sql;
		 	mysql_query($sql);
		 	
		 	echo "Resim başarıyla yüklendi. Başka resim yüklemek için <a href='addproduct.php?page=$_GET[page]'>buraya</a> tıklayın.";
		 
		 header("location:addproduct.php?page=$_GET[page]&last=".$matches[1][0]);
		 } 
		 else {
			 echo "Yükleme yapılırken hata oluştu.";
		 }
	
		
		
	}
}else{

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form action="addproduct.php?page=<?php echo $_GET['page'];?>" method="post"
enctype="multipart/form-data">
<label for="file">File:</label>
<input type="file" name="file" value="" id="file" />
<br />
<label for="name">name:</label>
<input type="text" name="name" id="name" />
<br />
<label for="name">price:</label>
<input type="text" name="price" id="price" />
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html> 
<?php }

?>