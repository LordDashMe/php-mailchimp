<?php

include realpath( dirname(__FILE__) ) . '/vendor/autoload.php';

use LordDashMe\MailChimp\Core\Subscriber\SubscriberFacade;

$fname = 'test name 2';
$lname = 'test last name 2';
$email = 'testemailaddress2@gmail.com';

// MailChimp API credentials
$apiKey = '436efacaca308f34da871cc93eff3559-us16';
$listID = '40bd239d57';

// MailChimp API URL
$memberID = md5(strtolower($email));
$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);


// member information
// $data = json_encode([
//     'email_address' => $email,
//     'status'        => 'subscribed',
//     'merge_fields'  => [
//         'FNAME'     => $fname,
//         'LNAME'     => $lname,
//        	'BIRTHDAY'	=> '06/16'
//     ]
// ]);

// $response = SubscriberFacade::create($apiKey, $listID, function ($subscriber) {
	
// 	$subscriber->email = 'tester1_email@testerlangto.com.ph';
// 	$subscriber->status = 'subscribed';

// 	$subscriber->firstName = 'Tester1 First Name';
// 	$subscriber->lastName = 'Tester1 Last Name';
// 	$subscriber->birthday = '06/16';
	
// 	return $subscriber;

// });

// $response = SubscriberFacade::update($apiKey, $listID, 'tester1_email@testerlangto.com.ph', function ($subscriber) {
	
// 	$subscriber->email = 'tester1_email@testerlangto.com.ph';
// 	$subscriber->status = 'subscribed';

// 	$subscriber->firstName = 'Tester BAG First Name';
// 	$subscriber->lastName = 'Tester BAG Last Name';
// 	$subscriber->birthday = '06/16';
	
// 	return $subscriber;

// });

// $response = SubscriberFacade::delete($apiKey, $listID, 'tester1_email@testerlangto.com.ph');

$response = SubscriberFacade::createOrUpdate($apiKey, $listID, 'tester1_email@testerlangto.com.ph', function ($subscriber) {
	
	$subscriber->email = 'tester1_email@testerlangto.com.ph';
	$subscriber->status = 'subscribed';

	$subscriber->firstName = 'Tester BAG11111 First Name';
	$subscriber->lastName = 'Tester BAG11111 Last Name';
	$subscriber->birthday = '06/16';
	
	return $subscriber;

});

echo '<pre>';
print_r($response);

// $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members'; create($url, $apiKey, $json);

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