
 <h1>Logo Ekle</h1>
<form action="adminMain.php?page=addLogo" method="post"
enctype="multipart/form-data">
Yükleyeceğiniz resmin boyutları 750-180 olan bir JPEG olması gerekir.<br><br><br>
<label for="file">Dosyayı Seçin:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit"  name="submit" value="Tamam" />
</form>

<?php
if(isset($_FILES["file"]["type"])){
	
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 100000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {   
    $size=getimagesize($_FILES["file"]["tmp_name"]);
    if($size[0]!=750 or $size[1]!=180){
    	echo "Resmin boyutları uygun değil. Logo 750-180 boyutunda bir jpg olmalı.";
    	
    }	else{    	
    


    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../img/banner.jpg");
      echo "Kaydedildi: /img/banner.jpg <br>" ;
      echo "Dosya: " . $_FILES["file"]["name"] . "<br />";
      echo "Tip: " . $_FILES["file"]["type"] . "<br />";
      echo "Hacim: " . (round($_FILES["file"]["size"] / 1024)) . " Kb<br />";
      }
    }
   }
  }
else
  {
  echo "Dosya uygun değil.".$_FILES["file"]["size"];
  }
}
?> 