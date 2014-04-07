<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

   <title>Sonuc</title>

   </head>

   <body>
   <?php
   require_once "face/facebook.php";
require_once "config.php";
@session_start();

$ip=$_SERVER['REMOTE_ADDR'];
$sqlT=select("select * from vistemp where vis_ip='$ip'");
if(count($sqlT)){
  $apime=$sqlT[0];
  $sqlC=select("select * from visits");
  $sc=count($sqlC)+1;

  $sonuct='';
  if($sc%3==0)
    $sonuct='KAZANDINIZ';
  else 
    $sonuct='KAZANMADINIZ';
  $sqlV=select("select * from visits where vis_ip='$ip'");
  if(count($sqlV)==0 ){
    myQuery("insert into visits(vis_ip,name,surname,email,vis_sonuc) values('$ip','$apime[name]','$apime[surname]','$apime[email]','$sonuct')");
  }
}

?>

<script type='text/javascript'> 

top.location.href="http://www.facebook.com/pages/Promosyon-Kuponu/367133583371458?sk=app_148382711979856";
   </script>


   </body>
   </html>
