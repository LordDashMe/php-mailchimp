<?php

include realpath( dirname(__FILE__) ) . '/vendor/autoload.php';

use LordDashMe\MailChimp\Utilities\Curl;

$fname = 'test name 1';
$lname = 'test last name 1';
$email = 'testemailaddress1@gmail.com';

// MailChimp API credentials
$apiKey = '13b2ccb87ad77648c3e875cff78d7248-us16';
$listID = '40bd239d57';

// MailChimp API URL
$memberID = md5(strtolower($email));
$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);


// member information
$json = json_encode([
    'email_address' => $email,
    'status'        => 'subscribed',
    'merge_fields'  => [
        'FNAME'     => $fname,
        'LNAME'     => $lname,
       	'BIRTHDAY'	=> '06/16'
    ]
]);

$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members'; create($url, $apiKey, $json);

// $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID; update($url, $apiKey, $json);

// $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID; createOrUpdate($url, $apiKey, $json);

function create($url, $apiKey, $json) 
{
	$response = (new Curl($url, $apiKey, 'POST', $json))->execute();
	echo '<pre>';
	print_r($response);	
}

function update($url, $apiKey, $json)
{
	$response = (new Curl($url, $apiKey, 'PATCH', $json))->execute();
	echo '<pre>';
	print_r($response);
}

function createOrUpdate($url, $apiKey, $json)
{
	$response = (new Curl($url, $apiKey, 'PUT', $json))->execute();
	echo '<pre>';
	print_r($response);
}