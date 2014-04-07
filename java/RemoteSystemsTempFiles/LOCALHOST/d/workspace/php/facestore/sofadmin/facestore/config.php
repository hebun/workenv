<?php
/*
mysql_connect("sofgenag.db.9103021.hostedresource.com","sofgenag","Shedower83+");
mysql_query("SET character_set_results = 'utf8', character_set_client = " .
		"'utf8', character_set_connection = 'utf8', character_set_database = " .
		"'utf8', character_set_server = 'utf8'");
mysql_select_db("sofgenag");

*/
mysql_connect("localhost","root","");
mysql_query("SET character_set_results = 'utf8', character_set_client = " .
		"'utf8', character_set_connection = 'utf8', character_set_database = " .
		"'utf8', character_set_server = 'utf8'");
mysql_select_db("face");




mysql_query("SET NAMES 'utf8'");
class Config{

	public 	$appid="280547468668043";
	public $appsecret="9609a47a851470164985910067825f7c";
	
	public $debug=false;
	public $pageid="1";

}

$config=new Config();
function select($sql){
	$query=mysql_query($sql) or die("<b>Veritabanı Hatası:</b>.\n<br />sorgu: " .
	$sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
	$table=array();
	while($row=mysql_fetch_assoc($query)){
		$table[]=$row;
	}
	return $table;
}
function myQuery($query){

	mysql_query($query) or die("<b>Veritabanı Hatası:</b>.\n<br />Query: " .
	$query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
}
?>