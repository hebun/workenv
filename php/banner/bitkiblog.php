<?php
function isAdmin(){

  return $_SESSION['userid']=='1' or $_SESSION['userid']=='15';
}

require_once 'dapibblog.php';



@session_start();

//var_dump($_SESSION);
$dbtable="faceuser";

if(!($_SESSION['userid']=='55' or isAdmin())){
	header("location:login.php");
}
 $del=new Dapi(false);
if(isset($_POST["del"])){

  $del->delete($dbtable)->where("id=$_POST[id]")->exec();


  die("success");
}

require_once 'top.php';

if(isset($_POST["add"])){

  $user=$_POST;

  unset($user["add"]);

  $user["pid"]=1;
  $del->reset();
  $del->insert($user)->into($dbtable)->execGetId();	
  //  myQuery(getInsert($dbtable,$user));
	
}else {

}
date_default_timezone_set('Europe/Istanbul');
$selectedDay=isset($_GET['day'])?$_GET['day']:date('z');
$del->reset();

$sub=new Dapi(false);
$having='';

if(isset($_GET['friend'])){
  $having="altuye>$_GET[friend]";
}
$start=0;
$recordPerPage=500;
if(isset($_GET['page'])){

    $start=$recordPerPage*$_GET['page'];
    //    $finish=$start+1000;
}
$table=$del->select('id,uid,email,`all`,fname,days,('.
		    $sub->select('count(id) as  altuye')->from($dbtable)->
		    where("refuid=parent.uid")->get().
		    ') as altuye ')->
  from($dbtable." as parent ")->having($having)->order(isset($_GET['order'])?$_GET['order']:'id')->desc()->limit("$start,$recordPerPage")->getArray();



$allcount=((int)Dapi::getCount($dbtable))/$recordPerPage;

?>
<div id="center-column">
	<div class="top-bar">

		<h1>Mailler</h1>

	</div>
	<div class="select-bar">
 

  <a href='<?php 
echo $dbtable;?>.php?friend=100'>Arkadas sayisi yuzu gecenler</a>
&nbsp; Toplam Kayit: <?php 
echo count($table);

echo "<br>Sayfa:";

for($ind=0;$ind<$allcount;$ind++){
  $isSelect=$ind==$_GET['page'];
  if($isSelect)
  echo $ind+1;
else
  echo "<a style='color:blue;' href='bitkiblog.php?page=$ind'> ".($ind+1)." </a>";
} 
?>
</div>
	<div style="width:1070px;height:600px;overflow:scroll">

		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
	 <th>No</th>
	 <th>Tarih</th>
	 <th>E-mail</th>
	 <th>Face Mail</th>


	 <th>Soyad</th>		
<th><a href='bitkiblog.php?order=altuye'>Alt Uyeler</a></th>		
	 <th>Sil?</th>
	 </tr>
			
<?php 

foreach($table as $row)
  {
    $fmail='';

    $tarih=Dapi::getDateFromDay($row['days'],2013);
    if(strlen($row['email'])>40) $row['email']='';
  $all=json_decode($row['all']);
  //  print_r($all);
    if(empty($all->username))     $fmail=$row['uid'].'@facebook.com';else $fmail=$all->username.'@facebook.com';
    echo "<tr><td>$row[id]</td>
        <td >$tarih </td>
        <td >$row[email] </td>
        <td >$fmail </td>
        <td>$row[fname] </td>
        <td>$row[altuye] </td>
 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='dynaDelete($row[id],\"$dbtable\")' /></td>		
</tr>";
}
echo "</table>";

?>
	</div>

</div>
	
</div>


<?php

require_once 'bottom.php';

?>
