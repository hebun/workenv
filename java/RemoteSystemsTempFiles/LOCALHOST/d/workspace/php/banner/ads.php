<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php 

require_once 'config.php';

$sites=select("select * from sites");

foreach ($sites as $row) {
	
echo "
	<div class='table'  style='width:200px;height:80px;'>
	
	<div style='color:blue;font-weight: bold;font-size:14px;' id='ptitle$row[id]'>
  <a target='_blank' href='action.php?adid=$row[id]&pid=$_GET[pid]'>	$row[title]</a>
		</div>
		
		<div style='font-size:14px;' id='pcontent$row[id]'>
		$row[content]
		</div>
		
		<div style='color:orange;font-weight: bold' id='pshowurl$row[id]'>
		$row[showurl]
		</div>	
		
		</div>
		";
}

?>
</body>
</html>