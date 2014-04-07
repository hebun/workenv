<?php


// Setup class
require_once 'config.php';
require_once 'Dbtool.php';
require_once('paypal.class.php');  // include the class file
$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url

// setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';

switch ($_GET['action']) {

	case 'process':      // Process and order...



		$p->add_field('business', 'ismettung@gmail.com');
		$p->add_field('return', $this_script.'?action=success');
		$p->add_field('cancel_return', $this_script.'?action=cancel');
		//   $p->add_field('notify_url', $this_script.'?action=ipn');
		$p->add_field('item_name', 'Paypal Test Transaction');
		$p->add_field('amount', '0.01');

		$p->submit_paypal_post(); // submit the fields to paypal
		//$p->dump_fields();      // for debugging, output a table of all the fields
		break;

	case 'success':      // Order was successful...

		$req = 'cmd=_notify-synch';

		$tx_token = $_GET['tx'];
		$auth_token = "z4tzt_JPEZXAxUHXvosnr33MXtNMyZi2HTdkvZI4qgCRG3_2LK9BryWec1O";
		$req .= "&tx=$tx_token&at=$auth_token";

		// post back to PayPal system to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

		// url for paypal sandbox
		$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);


		if (!$fp) {
			 
		} else {
			fputs ($fp, $header . $req);
			 
			$res = '';
			$headerdone = false;
			while (!feof($fp)) {
				$line = fgets ($fp, 1024);
				if (strcmp($line, "\r\n") == 0) {
					// read the header
					$headerdone = true;
				}
				else if ($headerdone) {
					// header has been read. now read the contents
					$res .= $line;
				}
			}

			// parse the data
			$lines = explode("\n", $res);
			$keyarray = array();
			if (strcmp ($lines[0], "SUCCESS") == 0) {
				for ($i=1; $i<count($lines);$i++){
					list($key,$val) = explode("=", $lines[$i]);
					$keyarray[urldecode($key)] = urldecode($val);
				}
				// check the payment_status is Completed
				// check that txn_id has not been previously processed
				// check that receiver_email is your Primary PayPal email
				// check that payment_amount/payment_currency are correct
				// process payment
				$firstname = $keyarray['first_name'];
				$lastname = $keyarray['last_name'];
				$itemname = $keyarray['item_name'];
				$amount = $keyarray['payment_gross'];

				echo ("<p><h3>Ödeme başarıyla alındı!</h3></p>");

				echo ("<b>Ödeme detayları</b><br>\n");
				echo ("<li>isim: $firstname $lastname</li>\n");
				echo ("<li>ürün: $itemname</li>\n");
				echo ("<li>fiyat: $amount</li>\n");
				echo ("");
			}
			else if (strcmp ($lines[0], "FAIL") == 0) {
				echo "<html><head><title>Hata</title></head><body><h3>Ödeme alınması işlemi başarısız!</h3>";
			
				echo "</body></html>";
			}
		}
		fclose ($fp);
		
		// You could also simply re-direct them to another page, or your own
		// order status page which presents the user with the status of their
		// order based on a database (which can be modified with the IPN code
		// below).

		break;

	case 'cancel':       // Order was canceled...

		 
		echo "<html><head><title>iptal edildi</title></head><body><h3>Sipariş iptal edildi.</h3>";
		echo "</body></html>";

		break;

	case 'ipn':          // Paypal is calling page for IPN validation...
		$logx="";
		foreach ($p->ipn_data as $key => $value) {
			$logx .= "\n$key: $value";
		}

		$sql=Dbtool::getInsert("orders",array("namesurname"=>"paypalipn","address"=>$logx));

		mysql_query($sql);


		// It's important to remember that paypal calling this script.  There
		// is no output here.  This is where you validate the IPN data and if it's
		// valid, update your database to signify that the user has payed.  If
		// you try and use an echo or printf function here it's not going to do you
		// a bit of good.  This is on the "backend".  That is why, by default, the
		// class logs all IPN data to a text file.
		//do nothing so long..(ismet)
		/* if ($p->validate_ipn()) {

		// Payment has been recieved and IPN is verified.  This is where you
		// update your database to activate or process the order, or setup
		// the database with the user's order details, email an administrator,
		// etc.  You can access a slew of information via the ipn_data() array.

		// Check the paypal documentation for specifics on what information
		// is available in the IPN POST variables.  Basically, all the POST vars
		// which paypal sends, which we send back for validation, are now stored
		// in the ipn_data() array.

		// For this example, we'll just email ourselves ALL the data.
		 
		 
		$subject = 'Instant Payment Notification - Recieved Payment';
		$to = 'ismettung@gmail.com';    //  your email
		$body =  "An instant payment notification was successfully recieved\n";
		$body .= "from ".$p->ipn_data['payer_email']." on ".date('m/d/Y');
		$body .= " at ".date('g:i A')."\n\nDetails:\n";
		 
		foreach ($p->ipn_data as $key => $value) { $body .= "\n$key: $value"; }
		 
		//fopen("ipn.text");
		 
		mail($to, $subject, $body);
		}*/
		break;
}

?>