<?php
// visitor counter
// by: Nico Beekhuijs
// date: 03-11-2006
// This script counts the number of visitors on the website
// for the last x minutes.
// Visitors are tracked by their IP address making several
// visitors from the same IP (ie a proxy) count as one.
// Tracking by IP is good enough in most cases

// config variables
$tframe = 100000;    // time frame (minutes) to count active users

// database connection details
$db_host = "localhost";                 // hostname of your MySQL server. You most likely don't have to change this
$db_name = "clicks_hediye";        // database name
$db_user = "clicks_shed";        // database user
$db_pass = "Fr7f2Ndr1cRK";    // database password
$db_table= "visits";                    // table name

// Lets open up a connection to the database
$db = mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db ($db_name) or die ("Cannot connect to database");

// On to the counter processing...
$vis_ip = ip2long($_SERVER['REMOTE_ADDR']);

$time = time();
$new_vis = 1;

// update database for returning visitor
$get_ip = mysql_query("SELECT * FROM ".$db_table." WHERE vis_ip=".$vis_ip." LIMIT 1");
     while ($row=mysql_fetch_object($get_ip))
         {
         mysql_query("UPDATE ".$db_table." SET vis_time='$time' WHERE vis_ip='$vis_ip'") 
            or die (mysql_error());
        $new_vis = 0;
        }
// add to database for new visitor
if ($new_vis == 1)
    {
    mysql_query("INSERT INTO ".$db_table." (vis_ip, vis_time) VALUES ('$vis_ip','$time')") 
        or die (mysql_error());
    }

// done processing the visit, now lets see how many total visitors are online
$tcheck = time() - (60 * $tframe);
$query = mysql_query("SELECT * FROM ".$db_table." WHERE vis_time > $tcheck");
$onlinenow = mysql_num_rows($query);

// show number of visitors on screen
if($onlinenow == 1)
    {
    echo"$onlinenow.kisisiniz <br>";
    }
else
    {
    echo"Cekilise katilan $onlinenow.kisisiniz <br>";
    }
	
$a = $onlinenow / 10;
$b = round($a);

if ($a == $b) {
		include 'kazan.php';
}  else {
		include 'tekrardene.php';
}
 ?> 