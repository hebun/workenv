<style>
.imgname {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14;
	line-height:150%;
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

$table="<table cellspacing=5, border=1>";


@session_start();

/**
 *
 * explorer bug...
 * @var unknown_type
 */
$pageid="285723924817479";

//$_SESSION["pageid"]
$page=new Page($pageid);



$sql="select * from products where pageid='$page->id'";

if ($id!=="0"){
	$sql.=" and groupid=$id";
}

if($_POST["tip"]!='H') 
   $sql.=" and name like '%$_POST[tip]%' COLLATE utf8_bin";

$sql.=" order by $_POST[order]";

//echo $sql;

$nr=mysql_num_rows(mysql_query($sql));
if($isPaging)
$sql.=" limit ".($pno*$ppp).",".($ppp);

$res=mysql_query($sql);
$k=0;
//echo $sql;
$table.="<tr>";
$rc=0;
while ($row = mysql_fetch_assoc($res)) {


		$table.="<td bgcolor='#ffffff' align=left><span class='imgname'>$row[name]<br><img width='134' style='cursor:pointer;' onclick='popBigImg($row[id],$rc,this)' height='154' src='$row[img]'".
	        "/><br>$row[price] TL</span><br>";

	if($page->orderButton){
//		$table.= " <input type='button' onclick='poppaypal($row[id],$rc)' value='Satın Al' /><br>".
		$table.= " <img src=img/satinal.gif align=absmiddle style='cursor:pointer' onclick='poppaypal($row[price],\"$row[name]\",\"$row[img]\",this)' border=0 alt='Satın Al'><br>".
		
	
		""
		;
		
	}

	$table.="</td>\n";

	if(++$k%5==0){
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

	$table="<div> Ürün bulunamadı.</div>";
}
echo $table;

?>
