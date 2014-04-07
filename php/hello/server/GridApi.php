<?php 
class GridApi{
	public $sql="";
	public $gridId;
	public function __construct($gridId,$sql=""){
		
		$this->gridId=$gridId;
		$this->sql=$sql;
	}
	
	public function getJson(){

		$field=select("select *  from gridfield where gridid=$this->gridId");

		$fields=array();
		$columns=array();

/**
 * twice looping through db resource issue. Once in config .
 */
		foreach ($field as $f)
		{ 
			$fields[]=array("name"=>$f["cname"]);
			$columns[]=array("dataIndex"=>$f["cname"],"text"=>$f["ctext"]);
		}

		$data=select($this->sql);

		$out=array(	"columns"=>$columns,
					"fields"=>$fields,
					"data"=>$data);
		
		
		return json_encode($out);
	}
}

?>