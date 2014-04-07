<html>
<body>
<script type="text/javascript">

function editUrun(id){
	popup(250,200,"editUrun.php?id="+id);
}
</script>
<?php 
  require_once "../db.php";
 $rpp=20;//records per page
 
 $countT=select("select count(0) as say from urun");
 
 $toplam=$countT[0]["say"];
 
 $pc=$toplam/$rpp;
 
 for ( $index = 1, $max_count = $pc; $index < $max_count+1; $index++ ) {
	echo "<a href='adminMain.php?page=addUrun&sayfa=$index'>$index</a> ";	
 }
 
 
 $sayfa=1; 
 $sql="select * from urun order by id ";
 
 if(key_exists("sayfa",$_GET))
  $sayfa=$_GET["sayfa"];
  
  $alt=$rpp*($sayfa-1);
  
  $ust=$rpp*$sayfa;
  
 $sql.=" limit $alt,$ust ";
 $query=mysql_query($sql);
 
  echo "<table border='1' width = '80%'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	echo "<tr>"; 
  	
  	
	echo "<td><img width='40' height'40' src='../urun/$row[photoUrl]'</td>";
	echo "<td>$row[text]</td>";
	echo "<td><a href='adminMain.php?page=delete&table=urun&ref=addUrun&id=".$row["id"]."' > Bu Ürünü Sil </a><br>
	<input type='button' class='' onclick='editUrun($row[id]);' name='editUrun' value='Düzenle' />
	</td>";
	echo "<td> $row[cat]</td>";
  	
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
Katagori:
<select name="cat">
<option value="hirdavat">Hırdavat</option>
<option value="elektrik">Elektrik</option>
<option value="insaat">İnşaat </option>
<option value="boya">Boya</option>
<option value="fayans">Fayans</option>
<option value="sihhi">Sıhhi Tesisat</option>
</select>
<textarea name="text" rows="10" cols="20" wrap="on"></textarea>
</td>
<td>

Yükleyeceğiniz resim; jpeg,jpg,png veya gif olmalıdır.<br><br><br>
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
	
if ((($_FILES["file"]["type"] == "image/png")
||($_FILES["file"]["type"] == "image/gif")
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
    
    $orgName=$_FILES["file"]["name"];
    

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
		$ext = substr(strrchr($orgName, "."), 1);

		// make the random file name
		$randName = md5(rand() * time());

		// and now we have the unique file name for the upload file
		$orgName =  $randName . '.' . $ext;

      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../urun/$orgName");
	
      $text=str_replace("\n","<br>",$_POST["text"]);
    	
    
      $query=" insert into urun(photoUrl,text,cat) values('$orgName','$text','$_POST[cat]')";
     // print_r($query);
   	  $result = mysql_query($query) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " .
   		  $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());


       echo "Kaydedildi: /urun/$orgName <br>" ;
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