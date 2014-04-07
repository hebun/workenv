<?php
class Dapi{
  public $isLocal=true;
  protected $host="localhost";
  protected $user="clicks_banner";
  protected $password="Shedower83!";
  protected $dbname="tedzin";

  protected $linkId;
  protected $debug=false;
  protected static $connected=false;
  protected $fieldList='*'; 
  protected $table;  
  protected $operation;
  protected $curst='';
  protected $whereConfig;
  protected $order='';
  protected $orderWay='asc';
  protected $fields;
  protected $built=false;
  protected $debug=false;
  protected $builtLocked=true;
  public function __construct($debug=false){
    $this->debug=$debug;
    $this->connectdb();
  }
  public function connectdb(){

    if(true==Dapi::connected) return;

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
    Dapi::connected=true;
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
    $this->whereConfig=$where;
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
    if(true==$this->builtLocked)
      throw new Exception('Premeture call to get method');    

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

    }elseif($this->operation=='select'){
      if(is_array($this->fieldList)){
	$this->curst.=' '.implode(',',$this->fieldList);
      }else {
	$this->curst.=' '.$this->fieldList;
      }
      $this->curst.=' from '.$this->table;
      if(false==empty($whereConfig)){
	$this->curst.=" where ";

	if(is_array($whereConfig)){

	  foreach($this->whereConfig as $k=$v){
	    $this->curst.=" $k='$v',";
	  }
	
	  $this->curst=substr($this->curst,0,strlen($this->curst)-1);
	}else{
	  $this->curst.=" $this->whereConfig";
	}
      }
    }
    $this->built=true;
    return $this->curst;
  }
  public function execGetId(){
    $this->myQuery();    
    return last_insert_id();
  }
  public function getQuery(){
    $query=$this->myQuery();
    return $query;
  }


  public function getCount($table){
    $codabi=new Dapi();
    $arr=$codabi->select('count(0)')->from($table)->getArray();
    return $arr[0][0];

  }
  public function getArray(){
    if($this->operation!=='select')
      throw new Exception('Operation is not select.');

    $query=$this->myQuery()
    $table=array();

    while($row=mysql_fetch_assoc($query)){
      $table[]=$row;
    }
    return $table;
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
public function myQuery(){
return  mysql_query($this->get()) 
    or die("<b>Db error:</b>.\n<br />: " .($this->debug?"sql:".$this->curst:'')
	   . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
}

}

?>