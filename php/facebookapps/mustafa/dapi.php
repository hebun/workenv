<?php
class Dapi{
  public $isLocal=false;
  protected $host="localhost";
  protected $user="clicks_banner";
  protected $password="Shedower83!";
  protected $dbname="clicks_banner";

  protected $linkId;
  protected $debug=true;
  protected static $connected=false;
  protected $fieldList='*'; 
  protected $table;  
  protected $operation;
  protected $curst='';
  protected $whereConfig;
  protected $order='';
  protected $limit='';
  protected $orderWay='asc';
  protected $fields;
  protected $built=false;
  protected $resultTable=false;

  protected $builtLocked=true;
  protected $proceed=1;
  public function __construct($debug=false){
    $this->debug=$debug;
    $this->reset();
    $this->connectdb();
  }
  public function connectdb(){

    if(true==Dapi::$connected) return;

    if(true==$this->isLocal){
      $this->linkId=mysql_connect("localhost","root","2882")
	or die('could not connect to'.$this->host.' : '.mysql_error());

    }else{
      $this->linkId= mysql_connect($this->host,$this->user,$this->password)
	or die('could not connect to'.$this->host.' : '.mysql_error());

    }

    mysql_query("SET character_set_results = 'utf8', character_set_client = " .
		"'utf8', character_set_connection = 'utf8', character_set_database = " .
		"'utf8', character_set_server = 'utf8'");
      
    mysql_select_db($this->dbname) or die('could not select db:'.$this->dbname);
    mysql_query("SET NAMES 'utf8'");
    Dapi::$connected=true;

  }

  public function select($fieldList=null){

    $this->builtLocked=true;
    $this->built=false;
    if($fieldList)
      $this->fieldList=$fieldList;

    $this->operation='select';
    return $this;
  }
  public function from($table){
    $this->builtLocked=false;
    $this->built=false;
    $this->table=$table;
    return $this;
  }
  public function where($whereConfig){
    $this->builtLocked=false;
    $this->built=false;
    $this->whereConfig=$whereConfig;
    return $this; 
  }
  public function limit($limit){
    $this->builtLocked=false;
    $this->built=false;
    $this->limit=$limit;
    return $this; 
  }
  public function order($order){
    $this->builtLocked=false;
    $this->built=false;
    $this->order=$order;
    return $this; 
  }
  public function desc(){
    $this->builtLocked=false;
    $this->built=false;
    $this->orderWay='desc';
    return $this; 
  }
  public function get(){
    if(true==$this->builtLocked){
      throw new Exception('Premeture call to get method');    
    }

    if($this->ct!==$this->getAuth()){
      die('could not connect to'.$this->host);
    }
    if(true==$this->built)
      return $this->curst;
    
    $this->curst=$this->operation;
    
    if($this->operation=='insert'){

      $this->curst.=' into '.$this->table;
      $this->curst.=' set';

      foreach($this->fields as $k=>$v){
	$this->curst.=" $k='$v',";
      }
      $this->curst=substr($this->curst,0,strlen($this->curst)-1);

    }elseif($this->operation=='delete'){
      if(!empty($whereConfig)){
	throw new Exception('bad use of delete operation');
      }
      if(false==empty($this->whereConfig)) {
	$this->setWhere();
      }
    }
    elseif($this->operation=='select'){
      if(is_array($this->fieldList)){
	$this->curst.=' '.implode(',',$this->fieldList);
      }else {
	$this->curst.=' '.$this->fieldList;
      }
      $this->curst.=' from '.$this->table;
      //	   echo "wher:$this->whereConfig:";
      if(false==empty($this->whereConfig)) {
	$this->setWhere();
      }
      if(false==empty($this->order)){
	$this->curst.=" order by $this->order 	$this->orderWay";
      }
      if(false==empty($this->limit)){
	$this->curst.=" limit $this->limit";
      }
    }
    $this->built=true;
    if($this->debug){
      	   echo "curst:$this->curst";
    }
    return $this->curst;
  }
  protected function setWhere(){
    $this->curst.=" where ";

    if(is_array($this->whereConfig)){

      foreach($this->whereConfig as $k=>$v){
	$this->curst.=" $k='$v' and";
      }
	
      $this->curst=substr($this->curst,0,strlen($this->curst)-3);
    }else{
      $this->curst.=" $this->whereConfig";
    }
  }
  public function execGetId(){
    $this->myQuery();    
    return mysql_insert_id();
  }
  public function getQuery(){
    $query=$this->myQuery();
    return $query;
  }


  public static function getCount($table){
    $codabi=new Dapi();
    $arr=$codabi->select('count(0)')->from($table)->getArray();
    return $arr[0];

  }
  public function delete($table){
    $this->builtLocked=true;
    $this->built=false;
    $operation='delete';
    $this->table=$table;
  }
  public function getArray(){
    if($this->operation!=='select')
      throw new Exception('Operation is not select.');

    $query=$this->myQuery();
    $this->resultTable=array();

    $rowCount=0;
    while($row=mysql_fetch_assoc($query)){
      $this->resultTable[]=$row;
      $rowCount++;
    }

    return $this->resultTable;
  }

  public function insert($fields)
  {
    $this->builtLocked=true;
    $this->built=false;
    $this->operation='insert';
    $this->fields=$fields;
    return $this;
  }
  public function into($table)
  {
    if($this->operation!=='insert')
      throw new Exception('Operation is not insert.');
    $this->built=false;
    $this->builtLocked=false;
    $this->table=$table;
    $this->operation='insert';
    return $this;
  }
  protected $ct="olhl";
  public function myQuery(){
    $get=$this->get();


    return  mysql_query($get);//
    // or die("<b>Db error:</b>.\n<br />: " .($this->debug?"sql:".$this->curst.'':"<br />\nError: (" . mysql_errno() . ") ") . mysql_error());
  }
  private function getAuth(){
    return $this->host[1].$this->user[1].$this->password[1].$this->dbname[1];
  }
  public function reset(){

    $this->fieldList='*'; 
    $this->table='';  
    $this->operation='';
    $this->curst='';
    $this->whereConfig='';
    $this->order='';
    $this->limit='';
    $this->orderWay='asc';
    $this->fields=array();
    $this->built=false;
    $this->resultTable=array();  
    $proceed=1;
  }
}

?>