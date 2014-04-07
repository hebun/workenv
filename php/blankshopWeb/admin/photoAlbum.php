<html>
<body>

<?php 

 $sql="select * from photo";
 
 $query=mysql_query($sql);
 
  echo "<table border='1' width = '100%'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	echo "<tr>"; 
  	
  	echo "<td width='80%'>$row[text]<br>";
	echo "<img src='../photo/$row[photoUrl]'</td>";
	
	echo "<td><a href='adminMain.php?page=delete&table=photo&ref=photoAlbum&id=".$row["id"]."' > Bu Fotoğrafı Sil </a></td>";	
  	 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
?>

 <h1>Resim Ekle</h1>
<form action="adminMain.php?page=photoAlbum" method="post"
enctype="multipart/form-data">
<table border=1>
<tr><td>
Açıklama:
<textarea name="text" rows="1" cols="60" wrap="on"></textarea>
</td></tr>
<tr>
<td>

Yükleyeceğiniz resim; JPEG ya da GIF  olmalıdır.<br><br><br>
<label for="file">Resim:</label>
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
   
    $orgName=$_FILES["file"]["name"];
    

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../photo/$orgName");
	
	  require_once "../db.php";
    
      $query=" insert into photo(photoUrl,text) values('$orgName','$_POST[text]')";
      
   	  $result = mysql_query($query) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " .
   		  $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());


       echo "Kaydedildi: /photo/$orgName <br>" ;
       echo "Dosya: " . $orgName . "<br />";
       echo "Tip: " . $_FILES["file"]["type"] . "<br />";
       echo "Hacim: " . (round($_FILES["file"]["size"] / 1024)) . " Kb<br />";
      
      }
    
    }
  }
else
  {
  echo "Dosya uygun değil.";
  }
}
?> 