<?php
if(!isset($_GET["id"])){
	echo "Duyur bulunamadý.";	
}
else{
	$query=mysql_query("select * from news where id=$_GET[id]");
	if(mysql_num_rows($query)==0){
		echo "Duyur bulunamadý.";
	}else{
		
		$row=mysql_fetch_assoc($query);
		
		echo "<h1>$row[title]</h1>";
		echo "$row[message]";
		
	}
}
//$arr=select("select * from urun");
//print_r($arr);
?>