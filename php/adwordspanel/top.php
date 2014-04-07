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
				if($_SESSION["usertype"]==="2")echo '<li><a href="gosterim.php">Gösterimler</a></li>';
			
				if($_SESSION["usertype"]==="1")echo '<li><a href="publisher.php">Gösterimler</a></li>';
				
				if($_SESSION["usertype"]==="0")
				{
					echo '<li><a href="users.php">Kullanıcılar</a></li>';
					echo '<li><a href="forms.php">Formlar</a></li>';
					echo '<li><a href="formpublisher.php">Form-Yayıncı Dağılımı</a></li>';
					echo '<li><a href="plugin.php">Plugin siteleri</a></li>';
				
				}
				
				?>
				
				</ul>

				<a href="logout.php" class="link">Çıkış</a>

			</div>