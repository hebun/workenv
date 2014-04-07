<?php ob_start(); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Yönetim Sayfası</title>
<link rel="stylesheet" type="text/css" href="adminStyle.css"/>
   
<script type="text/javascript">
function addUrun(){
	popup(500,300,"addUrun.php");
}
function addLogo(){
	popup(400,300,"addLogo.php");
}
function popup(width,height,url){	
    var left = parseInt((screen.availWidth/2) - (width/2));
    var top = parseInt((screen.availHeight/2) - (height/2));
	window.open (url,
		"mywindow","status=1,toolbar=1,width="+width+",height="+height+",top="+top+",left="+left);
} 
</script>
</head>
<body>
<?php
require_once "../code/table.php";
	/**
	 * login controle
	 */	
    session_start();
    
	if(!isset($_SESSION["admin"])){
	
			header("location:index.php");
	}else {
?>

<table style=" border-collapse: collapse;"  border="1" align="center" width="60%" >
<tr> <td colspan="2"> <a href='../index.php' target="blank">Ana Site</a></td></tr>
	<tr>
		<td colspan="2"> <img src="../img/banner.jpg"  </td>
		
	
	</tr>
	
	<tr>
	<td width="20%" valign="top">
	
		 <a href='adminMain.php?page=addLogo'>Logo Ekle</a><br><br>
		 <a href='adminMain.php?page=menus'>Menüler</a><br><br>
		 <a href='adminMain.php?page=addUrun'>Ürünler</a><br><br>
		 <a href='adminMain.php?page=photoAlbum'>Fotoğraf Albümü</a><br><br>		 
		 <a href='adminMain.php?page=message'>Mesajlar</a><br><br>
		 <a href='adminMain.php?page=addNews'>Duyurular</a><br><br>
		 <a href='adminMain.php?page=option'>Seçenekler</a><br><br>
		 <a href='adminMain.php?page=subscribes'>Duyuru Aboneleri</a><br><br>
		 <a href='http://www.deniz-elektrik.com/webmail/src/login.php' target="blank">E-Mail'e git</a><br><br>
		 <a href='adminMain.php?page=quit'>Güvenli Çıkış</a><br><br>
	
	</td>
	<td valign="top">
	<?php
	/**
	 * find page
	 */
	  if(isset($_GET["page"])){
    	
	    if(file_exists("$_GET[page].php"))
	    	require_once "$_GET[page].php";
	    else {
	    	require_once "../notImplement.php";
	    	
	    }
	    }else{
	    	
	    	require_once "adminMain.php";
	    }
	?>
	
	</td>	
	</tr>
	
</table

<?php			

}
	
?>
</body>
<html>
