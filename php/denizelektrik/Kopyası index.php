<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Shop Web project</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<script type="text/javascript" src="ajax.js"></script>
<?php
 require_once "constant.php";
 require_once "db.php";
 @session_start();
 
?>
</head>
<body>
<div id="container">
  <div class="clear"></div>
  <div id="banner">
    
  </div>
  <div class="clear"></div>
  <div id="sidebar">
    <div class="menu">
      <ul>
        <h1>Menu</h1>
        
        <?php
         $xml=simplexml_load_file("option.xml");
   		$opt= $xml->option;
        $query= mysql_query("select * from menu");
    
        while($row=mysql_fetch_assoc($query))
        {
        	if($row["hasFile"]=="1"){
        		echo "<li><a href='index.php?page=$row[url]'>$row[name]</a></li>";
        	}else{
        		echo "<li><a href='index.php?page=textContent&content=$row[id]'>$row[name]</a></li>";
        	}
        }
		   if(substr($opt,1,1)==="1"){
		   	echo "<br><br><br><iframe height='250' src='anket.php' width='100%' frameborder='0' ></iframe>";
		   }
        ?>   
      </ul>
    </div>
  </div>
  <div id="sidebar-b">
    <div class="clear"></div>
    <br>
  <?php
  
   if(substr($opt,0,1)==="1"){
    require_once "news.php";
   }
   require_once "subscribe.php";
   if(substr($opt,2,1)==="1"){
   	echo "<iframe  src='doviz.php' width='100%' frameborder='0' ></iframe>";
   }
   if(substr($opt,3,1)==="1"){
  	require_once "visitor.php";
   }

  ?>

</div>
  <div id="content">
    <div id="Content">
    <?php
    if(isset($_GET["page"])){
        	
		    if(file_exists("$_GET[page].php"))
		    	require_once "$_GET[page].php";
		    else {
		    	require_once "notImplement.php";	    	
		    }
	    }	 
    else{	    	
    	require_once "main.php";
    }
    
    ?>
 </div>
 <div id="footer"><p>Site Tasarım: <a href="http://www.dicleeseryazilim.com">Dicle Eser Yazılım</a> </p></div>
</div>
</div>

  

</body>
</html>
