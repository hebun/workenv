<?php
$isLocal=0;
$con;
if($isLocal===0){
	 $con=mysqli_connect("clicksem.db.9629000.hostedresource.com","clicksem","Shedower83!");
	mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = " .
	"'utf8', character_set_connection = 'utf8', character_set_database = " .
	"'utf8', character_set_server = 'utf8'");
	mysqli_select_db($con,"clicks_adwords");

}else{
	$con=mysqli_connect("localhost","root","2882");
	mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = " .
			"'utf8', character_set_connection = 'utf8', character_set_database = " .
			"'utf8', character_set_server = 'utf8'");
	mysqli_select_db($con,"adwords");
}

mysqli_query($con,"SET NAMES 'utf8'");
date_default_timezone_set('Europe/Istanbul'); 

function getDateFromDay($dayOfYear, $year) {
  $date = DateTime::createFromFormat('z', strval($dayOfYear));
  return $date;
}
function commentAllowed($ip)
{
	$lastTime=strtotime(selectOne('commentip','tarih','ip',$ip,false,'order by id desc '));
	return time()-$lastTime;
}
function myQuery($query){

	global $con;
	mysqli_query($con,$query) or die("<b>Veritaban Hatas:</b>.\n<br />Query: " .
	$query . "<br />\nError: (" . mysqli_errno($con) . ") " . mysqli_error($con));
}

function getInsert($table,$arr){

	global $con;
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

	global $con;
	//	var_dump($table);
	$sql="update $table set ";

	foreach ($arr as $key => $value) {
		$sql.="$key='$value',";
	}
	

	$sql=substr($sql,0,strlen($sql)-1)." where $where";
	return $sql;
}

function selectOne($table,$field,$keyfield,$value,$debug=false,$order="") {
	global $con;
	$sql="select $field from $table where $keyfield='$value' $order limit 1";
	if($debug)
	echo $sql;

	$res=mysqli_query($con,$sql) or die("<b>Veritaban Hatas:</b>.\n<br />sorgu: " .
	$sql . "<br />\nError: (" . mysqli_errno() . ") " . mysqli_error());;
	if($debug)
	print_r( $res);
	$row = mysqli_fetch_assoc($res);

	return $row[$field];
}

function select($sql){
	global $con;
	$query=mysqli_query($con,"select ".$sql) or die("<b>Veritaban Hatas</b>.\n<br />sorgu: " .
	$sql . "<br />\nError: (" . mysqli_errno($con) . ") " . mysqli_error($con));
	$table=array();
	while($row=mysqli_fetch_assoc($query)){
		$table[]=$row;
	}
	return $table;
}

class Dapi{
	public $mysqli;
	public static $isOpen=false;
	public function Dapi()
	{
		if(Dapi::$isOpen){
			return;
		}
		global $isLocal;
		if($isLocal==1){
			$this->mysqli=new mysqli("localhost","root","2882","adwords");
		}
		else {
			$this->mysqli = new mysqli("clicksem.db.9629000.hostedresource.com","clicksem","Shedower83!","clicksem");
	
		}
		if ($this->mysqli->connect_errno) {
			echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
			die();
		}
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		Dapi::$isOpen=true;
	}

	/**
	 *select with prepared statements
	 **/
	public function pselect($sql,$types,$params)
	{
		if($stmt=$this->mysqli->prepare($sql)){
			
		call_user_func_array('mysqli_stmt_bind_param', array_merge (array($stmt, $types), $this->refValues($params)));
		
		$stmt->execute();
		
		$result=$stmt->get_result();
		
		$ret=array();
		while($row=$result->fetch_assoc())	{

			$ret[]=$row;
		}
		}else{
			
			die( "here".$this->mysqli->error);
		}
		return $ret;

	}
	public function pinsertFromTable($arr,$types,$dbtable)
	{
		$sql="insert into $dbtable(";

		foreach ($arr as $key => $value) {
			$sql.="$key,";
		}
		$sql=substr($sql,0,strlen($sql)-1).") values(";

		for ($i = 0; $i < count($arr); $i++) {
			
			$sql.="?,";
		}
		$sql=substr($sql,0,strlen($sql)-1).")";
		$params=array();
		foreach ($arr as $key => $value) {
			$params[]=$value;
		}
		$this->pinsert($sql,$types,$params);

	}
	public function pinsert($sql,$types,$params)
	{
		if($stmt=$this->mysqli->prepare($sql)){

			call_user_func_array('mysqli_stmt_bind_param', array_merge (array($stmt, $types), $this->refValues($params)));

			$stmt->execute();

			
		}else{

			die( "here".$this->mysqli->error);
		}
		return $this->mysqli->insert_id;

	}
	public function insert($insertSql)
	{
		if($this->mysqli->query($insertSql)){
		}
		else
		{
			die( "here".$this->mysqli->error);
		}
		return $this->mysqli->insert_id;

	
	}
	public function select($sql)
	{
		$res=$this->mysqli->query($sql);
		$ret=array();
		while($row=$res->fetch_assoc())	{

			$ret[]=$row;
		}
		return $ret;
	}
	public function fillgaPrepare()
	{
		
		$call="call `addkeyword` (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
		$this->fillgaStmt=$this->mysqli->prepare($call);
		print_r($this-fillgaStmt);
	}
	public function fillgaPrepareGorsel()
	{
//		echo __FUNCTION__." Called<br>";
		$call="call `addGorsel` (?,?,?,?,?,?,?,?,?);";
		$this->fillgaStmt=$this->mysqli->prepare($call);
	}
	public function fillgaPrepareHesap()
	{
//		echo __FUNCTION__." Called<br>";
		$call="call `addHesap` (?,?,?,?,?,?,?,?);";
		$this->fillgaStmt=$this->mysqli->prepare($call);
	}
	public function fillgaCallSpWithArrayHesap($arr)
	{
//		echo __FUNCTION__." Called<br>";
		$this->fillgaStmt->bind_param('isiisiii',
			$arr["tarih"],
			$arr["account"] ,
			$arr["clicks"],
			$arr["impressions"],
			$arr["ctr"], 
			$arr["avgCPC"],
			$arr["cost"], 
			$arr["customerId"]
		); 	
	$hold=	$this->fillgaStmt->execute();
		//echo ($this->fillgaStmt->affected_rows);

	}
	public function fillgaCallSpWithArrayGorsel($arr)
	{
//		echo __FUNCTION__." Called<br>";
		$this->fillgaStmt->bind_param('isiisiiis',
			$arr["tarih"],
			$arr["account"] ,
			$arr["clicks"],
			$arr["impressions"],
			$arr["ctr"], 
			$arr["avgCPC"],
			$arr["cost"], 
			$arr["customerId"],
			$arr["placement"]
		); 	
	$hold=	$this->fillgaStmt->execute();
		//echo ($this->fillgaStmt->affected_rows);

	}
	private $fillgaStmt;
	public function fillgaCallSpWithArray($arr)
	{
		$this->fillgaStmt->bind_param('issssssiiisdddsi',
			$arr->tarih,
			$arr->campaign,
			$arr["account"], 
			$arr["keywordState"],
			$arr["keyword"],
			$arr["adGroup"],
			$arr["status"],
			$arr["maxCPC"], 
			$arr["clicks"],
			$arr["impressions"],
			$arr["ctr"], 
			$arr["avgCPC"],
			$arr["cost"], 
			$arr["avgPosition"],  
			$arr["labels"],
			$arr["customerId"]
		); 	
		$this->fillgaStmt->execute();
//		print_r($arr);

	}
	private function refValues($arr){ 
		if (strnatcmp(phpversion(),'5.3') >= 0) 
		{ 
			$refs = array(); 
			foreach($arr as $key => $value) 
				$refs[$key] = &$arr[$key]; 
			return $refs; 
		} 
		return $arr; 
	}
	public static function getTwoDigit($no){
		if(intval($no)<10)	
			return "0$no"	;
		return $no	;

	}
}

?>
