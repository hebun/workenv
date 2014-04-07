<?php

if(isset($_POST["ajax"])){
	require_once "db.php";
	if($_POST["out"]=="1"){	
		$sql="delete from mailsubscribe where email='$_POST[email]'";
		myQuery($sql);
		//echo $sql."-res=";
		if(mysql_affected_rows()>0){
				die("1");	
			}else{
				die("0");
			}
		
	}else{
		
		$sel=select("select count(id) as say from mailsubscribe where email='$_POST[email]'");
		if($sel[0]["say"]>0){
			die("0");
		}
		//print_r($sel);
		$arr=array();
		$arr["email"]=$_POST["email"];
		$arr["subscribe"]="1";
		myQuery(insert($arr,"mailsubscribe"));
	 
		die("1");
	}
}

?>
<table style="border:1px solid">
	<tr>
		<td><span style="font:bold italic 18px;font-size: 1em;color:#236bac;"><b>Duyuru ve Kampanyala- rımızdan haberdar olun.</b></span></td>	
	</tr>
	<tr>
		<td>E-Mail:<br><input type="text" id='mailId' class="text" name="email" value="" />
		<input type="button" id="subsBut" onclick="postData('subscribe')", class="button" name="postmail" value="Ekle" />
		<input type="button" id="outBut" onclick="postData('outSub')", class="button" name="postmail" value="Çıkar" />
		
		</td>
		
	</tr>
	
</table>
<br>