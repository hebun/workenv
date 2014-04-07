<html>
<head>
<title>Admin</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="client.js"></script>
<link href="css/admin.css" rel="stylesheet" type="text/css" />

</head>
<body>

	<div id="main">
		<div id="header">
					<h1>ClickSEM</h1>
			<!-- (logo)
		
			<a href="#" class="logo"><img src="img/logo.gif" width="101"
				height="29" alt="" /> </a> -->
			<ul id="top-navigation">
				<!-- <li><a href="#" class="active">Homepage</a></li> -->
				<!-- (tabs) -->
			</ul>
		</div>
		<div id="middle">
			<div id="left-column">

				<h3>Menü</h3>
				<ul class="nav">
					
					
				<?php			
   @session_start();
if(isAdmin()){
  echo '<li><a href="publisher.php">Yayıncılar</a></li>';

  echo '<li><a href="jshare.php">Jnw Paylasimlar</a></li>';
  echo '<li><a href="facemails.php">Facebook Mailler</a></li>';
  echo '<li><a href="bitkiblog.php">Bitkiblog</a></li>';
}
if($_SESSION['userid']=='52' or isAdmin()){
  echo '<li><a href="kshare.php">Kibarli Paylasimlar</a></li>';
  echo '<li><a href="kform.php">Kibarli Formlar</a></li>';
  echo '<li><a href="fmails.php">Kibarli Mailler</a></li>';
}
if($_SESSION['userid']=='54' or isAdmin()){

  echo '<li><a href="jmails.php">Jnv Mailler</a></li>';				
}
				?>
				
				</ul>

				<a href="logout.php" class="link">Çıkış</a>

			</div>