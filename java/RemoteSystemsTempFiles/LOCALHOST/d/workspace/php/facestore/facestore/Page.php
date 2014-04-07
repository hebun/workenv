<?php 
class Page{
	public $id;
	public $pageid;
	public $orderButton;
	public $buyButton;
    public $installed;
	public $email;
	public $pageurl;
	public function __construct($pageid) {
		
		$sql="select * from pages  where pageid=$pageid";
		
		$res=mysql_query($sql)  or die("<b>Veritabanı Hatası:</b>.\n<br />Query: " .
		$sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		
		if(mysql_num_rows($res)===0){
			$this->installed=false;
			return;
		}
		$this->installed=true;
		$row= mysql_fetch_assoc($res);
		
		$this->pageurl=$row["pageurl"];
		$this->id=$row["id"];
		$this->email=$row["email"];
		$this->pageid=$row["pageid"];
		$this->orderButton=$row["order"]!=0;
		$this->buyButton=$row["buy"]!=0;
	}
	
}
?>