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
	
}
?>