<?php

include realpath( dirname(__FILE__) ) . '/vendor/autoload.php';

$apiKey = '436efacaca308f34da871cc93eff3559-us16';
$listID = '40bd239d57';

/**
 * SUBSCRIBER FACADE
 */

use LordDashMe\MailChimp\Core\Subscriber\Facade\Subscriber;

Subscriber::init(['apiKey' => $apiKey, 'listId' => $listID]);

$response = Subscriber::show('jeffrey.mabazza@nuworks.ph');

/*
$response = Subscriber::create(function ($subscriber) {
       
    $subscriber->subscriber_email = 'jeffrey.mabazza@nuworks.ph';
    $subscriber->subscriber_status = 'subscribed';

    $subscriber->subscriber_firstname = 'Tester1 First Name';
    $subscriber->subscriber_lastname = 'Tester1 Last Name';
    $subscriber->subscriber_birthday = '06/16';
   
    return $subscriber;
});
*/

/*
$response = Subscriber::update('tester1_email@testerlangto.com.ph', function ($subscriber) {
       
    $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
    $subscriber->subscriber_status = 'subscribed';

    $subscriber->subscriber_firstname = 'Tester1 First Name';
    $subscriber->subscriber_lastname = 'Tester1 Last Name';
    $subscriber->subscriber_birthday = '06/16';
   
    return $subscriber;
});
*/

/*
$response = Subscriber::createOrUpdate('tester1_email@testerlangto.com.ph', function ($subscriber) {
       
    $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
    $subscriber->subscriber_status = 'subscribed';

    $subscriber->subscriber_firstname = 'Tester1 First Name';
    $subscriber->subscriber_lastname = 'Tester1 Last Name';
    $subscriber->subscriber_birthday = '06/16';
   
    return $subscriber;
});
*/

/*
$response = Subscriber::delete('tester1_email@testerlangto.com.ph');
*/

/**
 * SUBSCRIBER DYNAMIC CLASS
 */

// use LordDashMe\MailChimp\Core\Subscriber\Subscriber;

// $subscriber = new Subscriber(['apiKey' => $apiKey, 'listId' => $listID]);

/*
$response = $subscriber->create(function ($subscriber) {
       
    $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
    $subscriber->subscriber_status = 'subscribed';

    $subscriber->subscriber_firstname = 'Tester1 First Name';
    $subscriber->subscriber_lastname = 'Tester1 Last Name';
    $subscriber->subscriber_birthday = '06/16';
   
    return $subscriber;
});
*/

/*
$response = $subscriber->update('tester1_email@testerlangto.com.ph', function ($subscriber) {
       
    $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
    $subscriber->subscriber_status = 'subscribed';

    $subscriber->subscriber_firstname = 'Tester1 First Name';
    $subscriber->subscriber_lastname = 'Tester1 Last Name';
    $subscriber->subscriber_birthday = '06/16';
   
    return $subscriber;
});
*/

/*
$response = $subscriber->createOrUpdate('tester1_email@testerlangto.com.ph', function ($subscriber) {
       
    $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
    $subscriber->subscriber_status = 'subscribed';

    $subscriber->subscriber_firstname = 'Tester1 First Name';
    $subscriber->subscriber_lastname = 'Tester1 Last Name';
    $subscriber->subscriber_birthday = '06/16';
   
    return $subscriber;
});


/*
$response = $subscriber->delete('tester1_email@testerlangto.com.ph');
*/

/**
 * CAMPAIGN FACADE
 */

// use LordDashMe\MailChimp\Core\Campaign\Facade\Campaign;

// Campaign::init(['apiKey' => $apiKey]);

/*
$response = Campaign::create(function($campaign) {
    
    $campaign->recipients = [
        'list_id' => '40bd239d57',
    ];
    
    $campaign->type = 'regular';

    $campaign->settings = [
        'subject_line' => 'First Launch of MailChimp Package',
        'reply_to' => 'joshua.reyes@nuworks.ph',
        'from_name' => 'MailChimp AI Package',
    ];

    return $campaign;
});
*/

/*
$response = Campaign::content('3e3c1c7ff8', function($campaign) {
    
    $campaign->template = [
        'id' => 38885,
        // 'sections' => [
        //     'std_content00' => 'THIS IS THE CONTENT BODY OF MY EMAIL MESSAGE.',
        // ],
    ];

    return $campaign;
});
*/

// $response = Campaign::send('3e3c1c7ff8');

/*
$response = Campaign::delete('06e830b893');
*/

echo '<pre>';
print_r($response);
exit;
