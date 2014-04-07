<?php 
class Order{
	public $id;

	public $productid;
	public $city;
	public $tel;
	public $isauth;
	public $paymenttype;
	public $namesurname;
	public $email;
	public $iscomp;
	public $address;
	

	public function __construct($column,$value) {
		
		$sql="select * from orders  where $column='$value'";
		
		$res=mysql_query($sql);
		
		$row= mysql_fetch_assoc($res);
		
	    $this->id=$row["id"];
		$this->productid=$row["productid"];
		$this->city=$row["city"];
		$this->tel=$row["tel"];
		$this->isauth=$row["isauth"];
		$this->paymenttype=$row["paymenttype"];
		$this->namesurname=$row["namesurname"];
		$this->email=$row["email"];
		$this->iscomp=$row["iscomp"];
		$this->address=$row["address"];
		
	}
	
}
?>