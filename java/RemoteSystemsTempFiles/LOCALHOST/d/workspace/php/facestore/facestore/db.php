<?php
mysql_connect("deni2029.db.7658978.hostedresource.com","deni2029","De123456");
mysql_query("SET character_set_results = 'utf8', character_set_client = " .
		"'utf8', character_set_connection = 'utf8', character_set_database = " .
		"'utf8', character_set_server = 'utf8'");
mysql_select_db("deni2029");

function insert($array,$table){
	$query=" insert into $table set ";
	foreach ( $array as $key => $value ) {
       $query.="$key='$value',";   
	}
	
	
	$query=substr($query,0,strlen($query)-1);
	
	return $query;
}
function myQuery($query){
	
 	mysql_query($query) or die("<b>Veritabanı Hatası:</b>.\n<br />Query: " .
   		  $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
}
function select($sql){
	$query=mysql_query($sql) or die("<b>Veritabanı Hatası:</b>.\n<br />sorgu: " .
   		  $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
	$table=array();		
		while($row=mysql_fetch_assoc($query)){
			$table[]=$row;
		}
		return $table;
}
function showTable($sql,$showHead=true){
	
	$arr=select($sql);
   
 

  echo "<table width = '100%'  border='1'>";
  $k=0;   
  foreach ( $arr as $row ) {   

  {	
  	if($k===0 and $showHead)  	
  	{ 
  		$headers=array_keys($row);
  		echo "<tr>";  	
  		foreach($headers as $head){
  			echo "<td><b>$head</b></td>";
  		}
  		
  		$k++;  		
  	}  	
  	echo "<tr>"; 
  	
  	foreach($row as $r){
  			echo "<td>$r</td>";
  		}	
	echo "</tr>";
		 
  }
 
  } echo "</table>";
}
?>