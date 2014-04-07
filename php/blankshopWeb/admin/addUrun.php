<html>
<body>

<?php 

 $sql="select * from urun";
 
 $query=mysql_query($sql);
 
  echo "<table border='1' width = '80%'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	echo "<tr>"; 
  	
  	
	echo "<td><img src='../urun/$row[photoUrl]'</td>";
	echo "<td>$row[text]</td>";
	echo "<td><a href='adminMain.php?page=delete&table=urun&ref=addUrun&id=".$row["id"]."' > Bu Ürünü Sil </a></td>";
  	
  	 	?>
  	 	 
  	 	 <?php
  	 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
?>

 <h1>Ürün Ekle</h1>
<form action="adminMain.php?page=addUrun" method="post"
enctype="multipart/form-data">
<table border=1>
<tr>
<td>
<label for="file">Ürün detayı:</label>
</td>
<td>
<label for="file">Ürün resmi:</label>
</td>
</tr>
<tr><td>

<textarea name="text" rows="10" cols="20" wrap="on"></textarea>
</td>
<td>

Yükleyeceğiniz resim; JPEG formatında ve boyutları 80X80 piksel olmalıdır.<br><br><br>
<label for="file">Ürün Resmi:</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit"  name="submit" value="Tamam" />
</td>
</tr>
</table>
</form>

</body>
</html> 
<?php

if(isset($_FILES["file"]["type"])){
	
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
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
    if($size[0]!=80 or $size[1]!=80){
    	echo "Resmin boyutları uygun değil. Resim 80-80 boyutunda bir jpg olmalı.";
    	
    }else{
    $orgName=$_FILES["file"]["name"];
    

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../urun/$orgName");
	
	  require_once "../db.php";
    
      $query=" insert into urun(photoUrl,text) values('$orgName','$_POST[text]')";
      
   	  $result = mysql_query($query) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " .
   		  $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());


       echo "Kaydedildi: /urun/$orgName <br>" ;
       echo "Dosya: " . $orgName . "<br />";
       echo "Tip: " . $_FILES["file"]["type"] . "<br />";
       echo "Hacim: " . (round($_FILES["file"]["size"] / 1024)) . " Kb<br />";
      
      }
    }
    }
  }
else
  {
  echo "Dosya uygun değil.";
  }
}
?> 