<?php
/**
 * current: field format(cost ., trans, avg's to string), fieldt types(table,sp)
 * */
$string = "<?xml version='1.0'?> 
<document> 
<cmd>login</cmd> 
<login>Richard</login> 
</document> 
"; 


$xml = simplexml_load_string($string); 
print_r($xml); 
$login = $xml->login; 
print_r($login); 
$login = (string) $xml->login; 
print_r($login); 

if(isset($_POST['submit'])){

	$allowedExts = array("xml","gif", "jpeg", "jpg", "png");

	$extension = end(explode(".", $_FILES["file"]["name"]));

	if (($_FILES["file"]["size"] < 20000000)
		&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			if (file_exists("upload/" . $_FILES["file"]["name"]))
			{
				echo $_FILES["file"]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],
					"upload/report.xml");
				echo "Stored in: " . "upload/report.xml";
			}
		}
	}
	else
	{
		echo $_FILES["file"]["size"]; 
		echo $extension; 
		echo "Invalid file";
	}
}
?>
<html>
<body>

<form action="index.php" method="post"
enctype="multipart/form-data">
<label for="file">Dosya adi:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
