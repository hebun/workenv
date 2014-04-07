<?php
/**
 * security issue about deleting
 */
 if(isset($_POST["send"]))
	{
		$error;
		if(empty($_POST["message"]))
		{
			$error=" Mesaj boş  girilemez.";
		}else{
		
			require_once "../db.php";
			$arr=array();
			$arr["title"]=$_POST["title"];			
			$arr["message"]=$_POST["message"];
			
			$query =insert($arr,"news");
		  	myQuery($query);
		  	echo "<span style='color:black'> Duyuru başarıyla eklendi.</span> ";
		}	
	}
	
  	if(!empty($error)){
		echo "<span style='color:red'> $error </span> ";
	}
 
 
 $sql="select * from news";
 
 $query=mysql_query($sql);
 
  echo "<table  style='width: 100%; border-collapse: collapse;' border='0' width = '100%'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	  $color=$k%2===1?"#FDEEF4":"white";	
  	  $k++;
  	echo "<tr>"; 
  	
  	
	echo "<td style='background:$color'>
	<table style='width: 100%; border-collapse: collapse;' width='100%' border='1'>
	  <tr> <td colspan='2' align='left'> <a href='adminMain.php?page=delete&ref=addNews&table=news&id=".$row["id"]."'>Bu Duyuruyu Sil</a> </td> </tr>
	  		<tr>
		<td width='20%' align='right'>Başlık:</td>
		<td width='80%'>$row[title]</td>
		
	  </tr>
	 <tr>
		<td width='20%' align='right'>Duyuru:</td>
		<td width='80%' >$row[message]</td>
		
	</tr>	
</table>" .
		
		"</td>";
	
  	
  	
  	 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
 

?>
 <h1>Duyuru Ekle</h1>
<form action="adminMain.php?page=addNews" method="post">
	

<table style="border: 1px solid Black;" width="90%" >
    <tbody><tr>
    <td align="right" width="15%">
    Başlık:
    </td>    
    <td>
        <input name="title" id="title" style="width: 200px;" type="text">
    </td>    
    </tr>  
    </tr>
    <tr>
    <td align="right">
    Mesajınız:*
    </td>
  
    <td>
        <textarea name="message" rows="2" cols="20" id="message" style="height: 150px; width:200px;"></textarea>
    </td>
    </tr>
      <tr>
      <td colspan="1"></td>

    <td colspan="1">
        <input name="send" class="button" value="Kaydet" id="send" type="submit">
    </td>
    </tr>  

    </tbody></table>
    </td>
      </tr>
</tbody></table>
</form> 