<style>
.imgname {
	font-size: 12;
}
</style>
<?php
require_once 'config.php';
require_once 'Dbtool.php';
require_once 'Page.php';

$isPaging=false;

$ppp=$config->debug?16:16;

$id=$_POST["id"];
$pno=$_POST["pno"];
$moves=array("ip"=>$_SERVER["REMOTE_ADDR"],"move"=>"getlist->$pno","moveid"=>"0");

Dbtool::myQuery(Dbtool::getInsert("moves",$moves));

$table="<table cellspace=10>";

@session_start();

/**
 *
 * explorer bug...

 */
$pageid="285723924817479";

//$_SESSION["pageid"]
$page=new Page($pageid);



$sql="select * from products where pageid='$page->id'";

if ($id!=="0"){
	$sql.=" and groupid=$id";
}


$nr=mysql_num_rows(mysql_query($sql));
if($isPaging)
$sql.=" limit ".($pno*$ppp).",".($ppp);

$res=mysql_query($sql);
$k=0;
//echo $sql;
$table.="<tr>";
$rc=0;
while ($row = mysql_fetch_assoc($res)) {


	$table.="<td><img width='120' style='cursor:pointer;' onclick='popBigImg($row[id],$rc)' height='120' src='$row[img]'".
	        "/><br><br><span class='imgname'>$row[name]<br>$row[price] TL</span><br>";

	if($page->orderButton){
		$table.= " <input type='button' onclick='poppaypal($row[id],$rc)' value='Satın Al' />".
		""
		;
	}

	$table.="</td>\n";

	if(++$k%6==0){
		$rc++;
		$table.="</tr>\n<tr>";
	}
}
if($isPaging){
	$table.="<tr><td></td><td colspan='2' align='right'>";

	if($nr>$ppp){
		//if more than one page

		for ($i = 0; $i < $nr/$ppp; $i++) {

			if($i==$pno)//if current page, dont make it link
			$table.="&nbsp;".($i+1);
			else
			$table.="&nbsp;<a href='#' onclick='reloadList($id,$i)'>".($i+1)."</a>";
		}
	}

	$table.="</td></tr>";
}

$table.="</table>";
if($k==0){

	$table="<div> Ürün bulunamdı.</div>";
}
echo $table;

?>
