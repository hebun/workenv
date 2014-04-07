<?php

 require_once "../db.php";
 $tableName="liket";
 echo "<br><br><br><div style='width:30%'>";
 showTable("select name as siteismi,count as sayi from liket");
 echo "</div>";
?>