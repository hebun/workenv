<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Example</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="comments/css/stylesheet.css"/>
</head>
<body>

<br/>

<?php
$cmtx_page_id = '1';
$cmtx_reference = 'Page One';
$cmtx_path = 'comments/';
define('IN_COMMENTICS', 'true'); //no need to edit this line
require $cmtx_path . 'includes/commentics.php'; //no need to edit this line
?>

</body>
</html>