<?php 

require_once 'Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
	require_once 'Google/Api/Ads/AdWords/Util/ReportUtils.php';
	require_once 'Google/Api/Ads/AdWords/v201008/cm/ReportDefinitionService.php';
	require_once 'Google/Api/Ads/AdWords/Util/ReportDownloadException.php';
	
$username = "ismettung@gmail.com";
$password = "280682gmtk";
$currencyCode = "USD";
$developerToken = "$username++$currencyCode";

$user = new AdWordsUser(null, $username, $password, $developerToken);
$user->SetDefaultServer("https://adwords-sandbox.google.com/");
$user->LogAll();
$user->SetClientId(null);

try {
	$campaignService = $user->GetService("CampaignService", 'v201109');
	$page = $campaignService->get(new Selector());
} catch (Exception $e) {
}

$accountService = $user->GetService("ServicedAccountService", 'v201109');
$selector = new ServicedAccountSelector();
$page = $accountService->get($selector);

foreach ($page->accounts as $account) {
	print "Customer ID: {$account->customerId}\n";
}

$customerId = $page->accounts[0]->customerId;
$user->SetClientId($customerId);

$campaignService = $user->GetService("CampaignService", 'v201109');
 
$campaign = new Campaign();
$campaign->name = "Test Sandbox Account #" + time();
$campaign->status = "ACTIVE";
$campaign->biddingStrategy = new ManualCPC();

$budget = new Budget();
$budget->period = 'DAILY';
$budget->amount = new Money((float) 10000000);
$budget->deliveryMethod = 'STANDARD';
$campaign->budget = $budget;

$networkSetting = new NetworkSetting();
$networkSetting->targetGoogleSearch = TRUE;
$campaign->networkSetting = $networkSetting;

$operation = new CampaignOperation();
$operation->operand = $campaign;
$operation->operator = 'ADD';
 
$operations = array($operation);
$result = $campaignService->mutate($operations);

print_r($result);
?>