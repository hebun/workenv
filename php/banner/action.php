<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php 

if(isset($_GET["adid"])&&isset($_GET["pid"])){

	require_once 'config.php';
	$arr=array();
	$arr["siteid"]=$_GET["adid"];
	$arr["publisherid"]=$_GET["pid"];
	$arr["ip"]=$_SERVER["REMOTE_ADDR"];
	$arr["days"]=date("z");
	myQuery(getInsert("action",$arr));
	
	$ad=selectOne("sites","targeturl","id",$_GET["adid"]);
	
	echo "
	<script type='text/javascript'>
	var a=document.createElement('a');
	a.href='$ad';
	
	document.body.appendChild(a);
	
	a.click();
	</script>
	";
	
}

?>
</body>
</html>