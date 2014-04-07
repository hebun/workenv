<?php

 require_once "../constant.php";
 require_once "../db.php";
 
 function table($tableName){
 $table=$tableName;
 $query= mysql_query("select * from $table");

  echo "<table width = '100%'  border='1'>";
  $k=0;   
  while($row=mysql_fetch_assoc($query))
  {	
  	if($k===0)  	
  	{ 
  		$headers=array_keys($row);
  		echo "<tr>";  	
  		foreach($headers as $head){
  			echo "<td><b>$head</b></td>";
  		}
  		echo "<td><b>İşlem</b></td></tr>";
  		$k++;  		
  	}  	
  	echo "<tr>"; 
  	
  	foreach($row as $r){
  			echo "<td>$r</td>";
  		}
  	 	?><td>
  	 	 <input type="button" onclick="popup(400,300,'');" class="" id="<?=$row['id']?>" name="name" value="Değiştir" />
  	 	 <input type="button" onclick="popup();" class="" id="<?=$row['id']?>" name="name" value="Sil" />
  	 	 </td>
  	 	 
  	 	 <?php
  	 	
  	 	
	echo "</tr>";
		 
  }
  echo "</table>";
 }
?>