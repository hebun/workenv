<?php
class Dbtool{

	public static function getInsert($table,$arr){

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
	public static function getUpdate($table,$arr,$wherekey,$wherevalue){
	
		$sql="update $table set ";
	
		foreach ($arr as $key => $value) {
			$sql.="$key='$value',";
		}
		
	
		$sql=substr($sql,0,strlen($sql)-1)."";
		
		$sql.=" where $wherekey='$wherevalue'";
		return $sql;
	}
	public static function selectOne($table,$field,$keyfield,$value,$debug=false) {

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
	function myQuery($query){
	
		mysql_query($query) or die("<b>Veritabanı Hatası:</b>.\n<br />Query: " .
		$query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
	}
}
?>