  <table style="border:1px solid">
  <tr><td>
Ziyaretçi Sayısı:
</td>
<td align="center">
<?php

 if(!isset($_SESSION["newVisit"])){
 	//print_r($_SESSION);
    $counter = "visitors.txt";
    $fd = fopen($counter, "r"); 
    $num =  fread($fd, filesize( $counter )); 
    fclose($fd); 
    $fd = fopen($counter, "w"); 
    $users = $num + 1; 
    echo "<h1>$users</h1>"; 
    fwrite($fd, $users); 
    fclose($fd); 
	$_SESSION["newVisit"]=$users;
 }
 else{
 	echo "<h2>$_SESSION[newVisit]</h2>";
 }
 	
?>
</td>
</tr>
</table>