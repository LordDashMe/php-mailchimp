<?php

include realpath( dirname(__FILE__) ) . '/vendor/autoload.php';

use LordDashMe\MailChimp\Core\Subscriber\Subscriber;

$apiKey = '436efacaca308f34da871cc93eff3559-us16';
$listID = '40bd239d57';


    $subscriber = new Subscriber($apiKey, $listID);

    $response = $subscriber->create(function ($subscriber) {
         
        $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Tester1 First Name';
        $subscriber->subscriber_lastname = 'Tester1 Last Name';
        $subscriber->subscriber_birthday = '06/16';
       
        return $subscriber;
    });


/*
    $response = Subscriber::create($apiKey, $listID, function ($subscriber) {
         
        $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Tester1 First Name';
        $subscriber->subscriber_lastname = 'Tester1 Last Name';
        $subscriber->subscriber_birthday = '06/16';
       
        return $subscriber;

    });
*/

/*
    $response = Subscriber::create($apiKey, $listID, function ($subscriber) {
       
        $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Tester1 First Name';
        $subscriber->subscriber_lastname = 'Tester1 Last Name';
        $subscriber->subscriber_birthday = '06/16';
       
       return $subscriber;

    });
*/

/*
    $response = Subscriber::update($apiKey, $listID, 'tester1_email@testerlangto.com.ph', function ($subscriber) {
       
        $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Tester1 First Name';
        $subscriber->subscriber_lastname = 'Tester1 Last Name';
        $subscriber->subscriber_birthday = '06/16';
       
        return $subscriber;

    });
*/

/*
    $response = Subscriber::delete($apiKey, $listID, 'tester1_email@testerlangto.com.ph');
*/

/*
    $response = Subscriber::createOrUpdate($apiKey, $listID, 'tester1_email@testerlangto.com.ph', function ($subscriber) {
       
        $subscriber->subscriber_email = 'tester1_email@testerlangto.com.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Tester1 First Name';
        $subscriber->subscriber_lastname = 'Tester1 Last Name';
        $subscriber->subscriber_birthday = '06/16';
       
        return $subscriber;

    });
*/


echo '<pre>';
print_r($response);
exit;
