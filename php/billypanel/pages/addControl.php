<html>
<body>
<?php
session_start();
$firstFile="";
function upload($no){
	global $firstFile;
	$newfile="";
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"][$no]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"][$no] == "image/gif")
		|| ($_FILES["file"]["type"][$no] == "image/jpeg")
		|| ($_FILES["file"]["type"][$no] == "image/jpg")
		|| ($_FILES["file"]["type"][$no] == "image/pjpeg")
		|| ($_FILES["file"]["type"][$no] == "image/x-png")
		|| ($_FILES["file"]["type"][$no] == "image/png"))
		&& ($_FILES["file"]["size"][$no] < 50000)
		&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"][$no] > 0)
		{
			echo "Hata: " . $_FILES["file"]["error"][$no] . "<br>";
		}
		else
		{	
			$newfile= uniqid().".".$extension;
			move_uploaded_file($_FILES["file"]["tmp_name"][$no],"../upload/" . $newfile);

			require_once("../inc/config.inc.php");
			require_once("../inc/database.inc.php");

			$db=new Database();
		//	echo date("Y-m-d H:i:s", $_GET['date']);
			if($no==0)
			{
				$sql="insert into control set pointId=$_GET[pid],userId=$_SESSION[adm_user_id],file='$newfile',tarih='".date("Y-m-d H:i:s", $_GET['date'])."'";
				$firstFile=$newfile;
			}
			else{

				$sql="update  control set file1='$newfile' where file='$firstFile'";
			}
			if($db->open()){
				$db->query($sql);
						//		echo $sql;
			}
			return true; 
			if($no==1){
			//	header("location:control.php");
			}
		}
	}
	else
	{
		return false;
	}

}
if(isset($_POST['submit'])){

	if(upload(0))
	{
		if(!upload(1)){
		

			$db=new Database();
			if($db->open()){
				$db->query("delete from control where file='$firstFile'");

			}
			echo "Geçersiz Boş fiş görüntüsü dosyası!";
		
		
		}else{
			header("location:control.php");
		}
	}else{

			echo "Geçersiz Rayon görüntü dosyası!";
	}
}else{

?> 
<form action="addControl.php?<?php echo "pid=$_GET[pid]&date=$_GET[date]"; ?>" method="post"
enctype="multipart/form-data">
<label for="file[]">Rayon görüntüsü:</label>
<input type="file" name="file[]" id="file"><br><br>
<label for="file">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Boş Fiş:</label>
<input type="file" name="file[]" id="file"><br>
<div align='center'><input  type="submit" name="submit" value="Yükle"></div>
</form>
<?php

}

?>
</body>
</html> 
