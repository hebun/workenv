<?php

$time=time();


@session_start();

echo time()-$time;
if(isset($_SESSION["userid"])){
}
else{

header("location:login.php");
}
echo time()-$time;
//require_once 'top.php';

if($_SESSION["usertype"]==0){

	header("location:forms.php");
}
elseif($_SESSION["usertype"]==1){

	header("location:publisher.php");
}elseif($_SESSION["usertype"]==2)
{
	header("location:gosterim.php");

}
//require_once 'bottom.php';

?>



