<?php

$xml=simplexml_load_file("../option.xml");
$opt= $xml->option;

if(isset($_POST["send"])){
//	print_r($_POST);
$option="";
$option.=isset($_POST["duyuru"])?"1":"0";
$option.=isset($_POST["anket"])?"1":"0";
$option.=isset($_POST["doviz"])?"1":"0";
$option.=isset($_POST["visitor"])?"1":"0";
$xml->option=$option;
$opt=$option;
$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());
$dom->save("../option.xml");
}
?>
<form name="option" action="adminMain.php?page=option" method="POST">
<div align="left"><br>
<input type="checkbox" name="duyuru" value="1" <?php  echo substr($opt,0,1)==="1"? "checked":""; ?>> Duyurular<br>
<input type="checkbox" name="anket" value="1" <?php  echo substr($opt,1,1)==="1"? "checked":""; ?>> Anket<br>
<input type="checkbox" name="doviz" value="1" <?php  echo substr($opt,2,1)==="1"? "checked":""; ?>> Döviz Kuru<br>
<input type="checkbox" name="visitor" value="1" <?php  echo substr($opt,3,1)==="1"? "checked":""; ?>>Ziyaretçi sayısı <br>
<br>
</div>
<input type="submit" class="submit button" name="send" value="Tamam" />
</form>