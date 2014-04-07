<?php
function isAdmin(){

  return $_SESSION['userid']=='1' or $_SESSION['userid']=='15';
}

require_once 'dapibblog.php';

@session_start();

//var_dump($_SESSION);
$dbtable="faceuser";

if(!($_SESSION['userid']=='54' or isAdmin())){
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
//$del->debug=true;
$sub=new Dapi(false);
$having='';

if(isset($_GET['friend'])){
  $having="altuye>$_GET[friend]";
}
$table=$del->select('id,email,fname,('.
		    $sub->select('count(id) as  altuye')->from($dbtable)->
		    where("refuid=parent.uid")->get().
		    ') as altuye ')->
  from($dbtable." as parent ")->having($having)->order('altuye')->desc()->getArray();


?>
<div id="center-column">
	<div class="top-bar">

		<h1>Mailler</h1>

	</div>
	<div class="select-bar">
  <a href='bitkiblog.php?friend=100'>Arkadas sayisi yuzu gecenler</a>
&nbsp; Toplam Kayit: <?php 
echo count($table);
?> 
</div>
	<div style="width:1070px;height:600px;overflow:scroll">

		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>

	 <th>E-mail</th>

	 <th>Soyad</th>		
<th>Alt Uyeler</th>		
	 <th>Sil?</th>
	 </tr>
			
<?php 

foreach($table as $row)
  {
    echo "<tr><td >$row[email] </td><td>$row[fname] </td><td>$row[altuye] </td>
 <td><img src='img/hr.gif' width='16' style='cursor:pointer' height='16' alt='Sil' onclick='dynaDelete($row[id],\"bitkiblog\")' /></td>		
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
