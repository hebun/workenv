 <h1>Ürünlerimiz</h1>
 <?php
 
 $sql="select * from urun";
 
 $query=mysql_query($sql);
 
  echo "<table width = '80%'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	echo "<tr>"; 
  	
  	
	echo "<td><img src='urun/$row[photoUrl]'</td>";
	echo "<td>$row[text]</td>";
  	
  	 	?>
  	 	 
  	 	 <?php
  	 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
 
 ?>