<?php
error_reporting(E_ERROR);
require_once "../db.php";

if(isset($_POST["submit"])){

myQuery("update urun set text='".mysql_real_escape_string(ereg_replace("\n","<br>", $_POST["text"]))."' where id=$_GET[id]");
	echo "<script type=\"text/javascript\">".
		"window.opener.location.reload(); window.close();".
		"</script>";

}else{

$contentArr=select("select * from urun where id=$_GET[id]");
$content=ereg_replace("<br>","\n",$contentArr[0]["text"]);


echo "<form action='editUrun.php?id=$_GET[id]' method='post'>";
echo "<textarea cols='20' rows='5'  name='text' >$content</textarea><br>";

echo "<input type='submit' name='submit' value='Kaydet' /></form>";
}
?>

