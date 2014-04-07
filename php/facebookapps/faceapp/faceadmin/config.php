<?php
$isLocal=0;

if($isLocal===0){
	 mysql_connect("localhost","clicks_banner","Shedower83!");
	mysql_query("SET character_set_results = 'utf8', character_set_client = " .
	"'utf8', character_set_connection = 'utf8', character_set_database = " .
	"'utf8', character_set_server = 'utf8'");
	mysql_select_db("clicks_banner");

}else{
	mysql_connect("localhost","root","");
	mysql_query("SET character_set_results = 'utf8', character_set_client = " .
			"'utf8', character_set_connection = 'utf8', character_set_database = " .
			"'utf8', character_set_server = 'utf8'");
	mysql_select_db("baner");
}

mysql_query("SET NAMES 'utf8'");


function getDateFromDay($dayOfYear, $year) {
  //  echo $dayOfYear.'-'.$year;
  $date = DateTime::createFromFormat('z', strval($dayOfYear));
  return $date;
}

function getCode($id,$width,$height){
global $isLocal;
  if($isLocal===0){
		$bcode='<iframe frameborder="no" scrolling="no"  src="http://www.clicksem.net/banner/ads'.$width.'.php?pid=#pid#" width="'.$width.'" height="'.$height.'"></iframe>';
	}
	else{
		$bcode='<iframe frameborder="no" scrolling="no"  src="http://localhost/banner/ads.php?pid=#pid#" width="300" height="250"></iframe>';
	}
	return str_replace("#pid#",$id,htmlspecialchars($bcode));
}
function myQuery($query){

	mysql_query($query) or die("<b>Veritabanı Hatası:</b>.\n<br />Query: " .
	$query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
}

function getInsert($table,$arr){

	//	var_dump($table);
	$sql="insert into $table(";

	foreach ($arr as $key => $value) {
		$sql.="$key,";
	}
	$sql=substr($sql,0,strlen($sql)-1).") values(";

	foreach ($arr as $key => $value) {
		$sql.="'$value',";
	}
	$sql=substr($sql,0,strlen($sql)-1).")";
	return $sql;
}
function getUpdate($table,$arr,$where){

	//	var_dump($table);
	$sql="update $table set ";

	foreach ($arr as $key => $value) {
		$sql.="$key='$value',";
	}
	

	$sql=substr($sql,0,strlen($sql)-1)." where $where";
	return $sql;
}
function selectOne($table,$field,$keyfield,$value,$debug=false) {

	$sql="select $field from $table where $keyfield=$value limit 1";
	if($debug)
	echo $sql;

	$res=mysql_query($sql) or die("<b>Veritabanı Hatası:</b>.\n<br />sorgu: " .
	$sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());;
	if($debug)
	print_r( $res);
	$row = mysql_fetch_assoc($res);

	return $row[$field];
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
class Config{

	public $debug=true;

}

$config=new Config();

?>
