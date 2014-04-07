<h1>Duyurular</h1>
<div style=" width: 160px; height: 320px; overflow: auto;">

<!-- HTML Codes by Quackit.com -->
<style type="text/css">
.html-marquee {height:300px;width:158px;background-color:#ffffff;font-family:Cursive;font-size:10pt;color:#000000;border-width:1px;border-style:solid;border-color:#000000;}
</style>
<marquee onmouseover="this.stop();" onmouseout="this.start();" class="html-marquee" 
direction="up" behavior="scroll" scrollamount="4" >

 <?php
 
 $sql="select * from news";
 
 $query=mysql_query($sql);
 
    
  while($row=mysql_fetch_assoc($query))
  {	
  	echo "<div><b>$row[title]</b><br>";
  	
  	$short=substr($row["message"],0,50)."...";
  	//echo "<a  href='index.php?page=newsDetail&id=$row[id]'>$short</a>";
  	echo "$short<br><a href='index.php?page=newsDetail&id=$row[id]' >Devamı</a> ";
  		
	echo "</div><br>";
		 
  }
  
 
 ?>


</marquee>

</div>
