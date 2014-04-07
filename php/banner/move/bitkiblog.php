<?php
function isAdmin(){

  return $_SESSION['userid']=='1' or $_SESSION['userid']=='15';
}

require_once 'dapi.php';

@session_start();

//var_dump($_SESSION);
$dbtable="faceuser";

if(!($_SESSION['userid']=='54' or isAdmin())){
	header("location:login.php");
}
 $del=new Dapi(false);
if(isset($_POST["del"])){

  $del->delete($dbtable)->where("id=$_POST[id]");
  //  myQuery("delete from   ".$dbtable." where id=$_POST[id]");
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
$table=$del->select('email,fname,('.
		    $sub->select('count(id) as  altuye')->from($dbtable)->
		    where("refuid=parent.uid")->get().
		    ') as altuye ')->
  from($dbtable." as parent ")->where("")->getArray();


?>
<div id="center-column">
	<div class="top-bar">

		<h1>Mailler</h1>

	</div>
	<div class="select-bar">

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

    echo "<tr><td >$row[email] </td><td>$row[fname] </td><td>$row[altuye] </td></tr>";

  }
echo "</table>";

?>
	</div>

</div>
	
</div>


<?php

require_once 'bottom.php';

?>
