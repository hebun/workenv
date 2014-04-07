<?php 
require_once 'dapi.php';

$dapi=new Dapi(true);

$sub=new Dapi(true);
$dbtable='canvasturkobir';

function myQuery($query){

	mysql_query($query) or die("<b>Veritabanı Hatası:</b>.\n<br />Query: " .
	$query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
}

$table=$dapi->select('id,('.
		    $sub->select('count(id) as  altuye')->from($dbtable)->
		    where("refuid=parent.uid")->get().
		     ') as altuye ')->from($dbtable." as parent ")->limit("0,1000")->getArray();

foreach($table as $row){
  myQuery("update canvasturkobir set frcount=$row[altuye] where id=$row[id]");
}


?>