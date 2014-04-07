<?php

$USERNAME = 'ismettung@gmail.com';
$PASSWORD = '280682gmtk';
$COOKIEFILE = 'cookies.txt';

$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:16.0) Gecko/20100101 Firefox/16.0 FirePHP/0.7.1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);

curl_setopt($ch, CURLOPT_URL,
  'https://accounts.google.com/ServiceLogin?hl=en&service=alerts&continue=http://www.google.com/alerts/manage');
$data = curl_exec($ch);

$formFields = getFormFields($data);

$formFields['Email']  = $USERNAME;
$formFields['Passwd'] = $PASSWORD;
unset($formFields['PersistentCookie']);

$post_string = '';
foreach($formFields as $key => $value) {
	$post_string .= $key . '=' . urlencode($value) . '&';
}

$post_string = substr($post_string, 0, -1);

curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/ServiceLoginAuth');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);

$result = curl_exec($ch);

if (strpos($result, '<title>Yönlendiriliyor') === false) {
	var_dump($result);
	die("Login failed");
	
} else {
	curl_setopt($ch, CURLOPT_URL, 'https://adwords.google.com/select/CampaignSummary');
	curl_setopt($ch, CURLOPT_POSTFIELDS, null);
	curl_setopt($ch, CURLOPT_POST, FALSE);
	curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	
	

	$result = curl_exec($ch);
    echo "result:";
	print($result);
}

function getFormFields($data)
{
	if (preg_match('/(<form.*?id=.?gaia_loginform.*?<\/form>)/is', $data, $matches)) {
		$inputs = getInputs($matches[1]);

		return $inputs;
	} else {
		die('didnt find login form');
	}
}

function getInputs($form)
{
	$inputs = array();

	$elements = preg_match_all('/(<input[^>]+>)/is', $form, $matches);

	if ($elements > 0) {
		for($i = 0; $i < $elements; $i++) {
			$el = preg_replace('/\s{2,}/', ' ', $matches[1][$i]);

			if (preg_match('/name=(?:["\'])?([^"\'\s]*)/i', $el, $name)) {
				$name  = $name[1];
				$value = '';

				if (preg_match('/value=(?:["\'])?([^"\'\s]*)/i', $el, $value)) {
					$value = $value[1];
				}

				$inputs[$name] = $value;
			}
		}
	}

	return $inputs;
}
