<?php
require_once "config.php";

@session_start();


//echo 'form fields:<br>';
//print_r($_POST);


$ip=$_SERVER['REMOTE_ADDR'];
$day=date('z');
$currows=select("select * from visits where email='$_POST[femail]' and comp=$day");
if(count($currows)!=0){

}else{

$allt=select("select * from visits");
$co=count($allt);
$sonuc='';
if($co%10==0)
	$sonuc="KAZANDINIZ";
else 
     $sonuc="KAZANMADINIZ";

myQuery("insert into visits(vis_ip,name,surname,email,fname,fsurname,ftel,fadres,fref,fsoru,femail,vis_sonuc,comp) 
		    values ('$ip','$_POST[name]','$_POST[surname]','$_POST[femail]','$_POST[ad]','$_POST[soyad]','$_POST[telefon]','$_POST[adres]','$_POST[referans]','$_POST[soru]','$_POST[email]','$sonuc',$day)");
}

?>
<script type='text/javascript'> 

top.location.href="https://www.facebook.com/d.mustafaeraslan/app_148382711979856";

</script>