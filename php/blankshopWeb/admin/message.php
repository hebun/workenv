 <h1>Mesajlar</h1>
 <?php
 
 $sql="select * from message";
 
 $query=mysql_query($sql);
 
  echo "<table style='width: 100%; border-collapse: collapse;' border='0' width = '100%'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	  $color=$k%2===1?"#FDEEF4":"white";	
  	  $k++;
  	echo "<tr>"; 
  	
  	
	echo "<td style='background:$color'>
			 <table style='width: 100%; border-collapse: collapse;' width='100%' border='1'>
	<tr>
		<td width='20%' align='right'>Adı Soyadı:</td>
		<td width='80%'>$row[name]</td>
		
	</tr>
	<tr>
		<td width='20%' align='right'>E-mail:</td>
		<td width='80%' >$row[email]</td>
		
	</tr>
	<tr>
		<td align='right'>Başlık:</td>
		<td>$row[title]</td>
		
	</tr>
	
			<tr>
		<td align='right'>Mesaj:</td>
		<td>$row[message]</td>
		
	</tr>" .
			"<tr>
		<td align='left' colspan='2'><a href='adminMain.php?page=delete&ref=message&table=message&id=".$row["id"]."'>Bu Mesajı Sil</a></td>
		
		
	</tr>
</table>
		</td>";
	
  	
  	
  	 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
 
 ?>

