<script type="text/javascript" src="Ajax.js"></script>
<script type="text/javascript">

function showDiv(){
	document.getElementById("auth").style.visibility="visible";
}
function send(){
	Ajax.call({
		url: 'delete.php',
		params: {
			pass:document.getElementById("authp").value
		},
		load: function () {

			document.getElementById("auth").innerHTML = "<img src='ajax_wait.gif' />";

		},
		success: function (res) {
			document.getElementById("auth").innerHTML ="<br>"+ res;

			if (callback !== "undefined") {
				eval("callback();");

			}
		}
	})

	document.getElementById("auth").style.visibility="visible";
}
</script>
<?php

require_once "db.php";
$tableName="liket";
$days=date("z");
$dun=$days-1;
$onceki=$days-2;
echo "<table width='80%' border='0'><tr><td><div style='width:100%'>";
showTable("select name as siteismi,".
		 "(select count from liket as l where l.name=li.name and days=$days) as 'Bugün',".
		
		 "(select count from liket as l where l.name=li.name and days=$dun) as 'Dün'".
		 ",(select sum(count) from liket as l where l.name=li.name and days=$onceki) as 'Önceki Gün',".
		 "(select sum(count) from liket as l where l.name=li.name ) as toplam from liket as li".
		 " where name<>'' group by li.name");


echo "</div></td><td valign='top' width='30%'>";



?>

<input type="button" value="Temizle" onclick="showDiv()" />

<div id="auth" style="visibility:hidden"> <br>
�ifre? <input type="password" id="authp" /><input type="button" value="Temizle" onclick="send()" />
</div>

</td></tr></table>