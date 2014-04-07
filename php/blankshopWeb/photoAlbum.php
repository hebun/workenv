 <h1>Fotoğraf Albümü</h1>
 <?php
 
 $sql="select * from photo";
 
 $query=mysql_query($sql);
 
  echo "<table width = '100%'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	echo "<tr>"; 
  	echo "<td>$row[text]<br>";
	echo "<img src='urun/$row[photoUrl]'</td>";
	

  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
 
 ?>