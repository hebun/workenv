 <h1>Ürünlerimiz</h1>
 <?php
 $sql="";
 if(key_exists("cat",$_GET))
 {
   	$sql="select * from urun where cat='$_GET[cat]'";
 }else{
 	$sql="select * from urun";
 }
 $query=mysql_query($sql);
 
  echo "<table width = '80%' border='1'  ";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	  	
  	echo "<tr>"; 
  	
  	if(file_exists("urun/$row[photoUrl]")){
	echo "<td width='50%'><img width='60' height'60' src='urun/$row[photoUrl]' /></td>";
	}
	else {
	 echo "<td><img width='60' height'60' src='urun/nophoto.gif' /></td>";
	}
	echo "<td>$row[text]</td>";
  	
  	 
  	 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
 
 ?>