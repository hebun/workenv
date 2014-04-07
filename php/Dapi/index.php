<?php

?>
<?php 

 ?> <?php 

?> <?php echo $myvar;?> 
//require_once '';
<?php echo $myvar;?>


require_once 'Dapi.php';
$dapi=new Dapi();



//echo $dapi->select()->from('user')->get();
echo $dapi->insert(array('username'=>'blbla','password'=>'zirtvir'))->into('user')->get();
?>