<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<p>
		<?php

		// database connection details
		$db_host = "localhost";                 // hostname of your MySQL server. You most likely don't have to change this
		$db_name = "clicks_hediye";        // database name
		$db_user = "clicks_shed";        // database user
		$db_pass = "Fr7f2Ndr1cRK";    // database password
		$db_table= "visits";                    // table name

		$vis_ip = ip2long($_SERVER['REMOTE_ADDR']);

		// Lets open up a connection to the database
		$db = mysql_connect($db_host,$db_user,$db_pass);
		mysql_select_db ($db_name) or die ("Cannot connect to database");

		// update database for returning visitor

		mysql_select_db(".$db_table.", $db);

		$result = mysql_query("SELECT vis_sira FROM ".$db_table." WHERE vis_ip=".$vis_ip." ");

		while($row = mysql_fetch_array($result))
		{
			echo "Çekilişe katılan".$row['vis_sira'].". kişisiniz <br>";
			echo "Beşinci ve katlarındaki katılımcılara hediye verebiliyoruz <br>";
			echo "Bu yüzden ";

			$adet= round($row['vis_sira']/5);
		}

		$result = mysql_query("SELECT vis_sonuc FROM ".$db_table." WHERE vis_ip=".$vis_ip." ");

		while($row = mysql_fetch_array($result))
		{
			echo $row['vis_sonuc']."<br>";
			echo "Şu ana kadar ".$adet. " ödül dağıtıldı <br>";
			echo "Kampanya sonunda kalan ödüller kazanamayan katılımcılara dağıtılacaktır <br>";
		}

		?>
	</p>
	<p>
		<a
			href="https://www.facebook.com/pages/Promosyon-Kuponu/367133583371458?sk=app_458778440845511">kampanya
			adresi</a>
	</p>
</body>
</html>
