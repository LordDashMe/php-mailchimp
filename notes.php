<?php

include realpath( dirname(__FILE__) ) . '/vendor/autoload.php';

$apiKey = '436efacaca308f34da871cc93eff3559-us16';
$listID = '40bd239d57';

// use PHPMailChimp\Core\Modules\Lists\Facade\Lists;

// Lists::init(['apiKey' => $apiKey]);

// $response = Lists::create(function($requestBody) {
//     $requestBody->name = 'This is a sample';
//     $requestBody->contact = [
//         'company' => 'This is Sample Company',
//         'address1' => 'This is sample address 1',
//         'city' => 'Sample City',
//         'state' => 'Sample State',
//         'zip' => '3022',
//         'country' => 'PH'
//     ];
//     $requestBody->permission_reminder = 'Please make sure your profile info.';
//     $requestBody->campaign_defaults = [
//         'from_name' => 'Dash Reyes',
//         'from_email' => 'reyesjoshuaclifford@gmail.com',
//         'subject' => 'This is a sample subject.',
//         'language' => 'english'
//     ];
//     $requestBody->email_type_option = false;
//     return $requestBody;
// });

use PHPMailChimp\Core\Modules\Lists\Lists;

$lists = new Lists(['apiKey' => $apiKey]);

// $response = $lists->create(function($requestBody) {
//     $requestBody->name = 'This is a sample';
//     $requestBody->contact = [
//         'company' => 'This is Sample Company',
//         'address1' => 'This is sample address 1',
//         'city' => 'Sample City',
//         'state' => 'Sample State',
//         'zip' => '3022',
//         'country' => 'PH'
//     ];
//     $requestBody->permission_reminder = 'Please make sure your profile info.';
//     $requestBody->campaign_defaults = [
//         'from_name' => 'Dash Reyes',
//         'from_email' => 'reyesjoshuaclifford@gmail.com',
//         'subject' => 'This is a sample subject.',
//         'language' => 'english'
//     ];
//     $requestBody->email_type_option = false;
//     return $requestBody;
// });
// 

// $response = $lists->update(function($requestBody) {
//     $requestBody->name = 'This is a sample 1';
//     $requestBody->contact = [
//         'company' => 'This is Sample Company',
//         'address1' => 'This is sample address 1',
//         'city' => 'Sample City',
//         'state' => 'Sample State',
//         'zip' => '3022',
//         'country' => 'PH'
//     ];
//     $requestBody->permission_reminder = 'Please make sure your profile info.';
//     $requestBody->campaign_defaults = [
//         'from_name' => 'Dash Reyes',
//         'from_email' => 'reyesjoshuaclifford@gmail.com',
//         'subject' => 'This is a sample subject.',
//         'language' => 'english'
//     ];
//     $requestBody->email_type_option = false;
//     return $requestBody;
// }, function ($requestPath) {
//     $requestPath->list_id = 'ad82910b36';
//     return $requestPath;
// });

// $response = $lists->delete(function ($requestBody) { 
//     return $requestBody; 
// }, function($requestPath) { 
//     $requestPath->list_id = 'ad82910b36'; return $requestPath; 
// });

// var_dump($response);

// exit;


/**
 * SUBSCRIBER FACADE
 */

// use LordDashMe\MailChimp\Core\Subscriber\Facade\Subscriber;

// Subscriber::init(['apiKey' => $apiKey, 'listId' => $listID]);

/*
$response = Subscriber::show('jeffrey.mabazza@nuworks.ph');
*/

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

// $response = $subscriber->all(function($subscriber){
//     $subscriber->count = 1;
//     return $subscriber;
// });

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

/**
 * TEMPLATE FOLDER FACADE
 */

// use LordDashMe\MailChimp\Core\TemplateFolder\Facade\TemplateFolder;

// TemplateFolder::init(['apiKey' => $apiKey]);

// $response = TemplateFolder::create(function($templateFolder) {
//     $templateFolder->name = 'Test Lang na Folder Template';
//     return $templateFolder;
// });

// $response = TemplateFolder::update('46a9e5bad0', function($templateFolder) {
//     $templateFolder->name = 'This is a new Folder Name';
//     return $templateFolder;
// });

// $response = TemplateFolder::all(function($templateFolder) {
//     $templateFolder->fields = 'folders.name,folders.id';
//     $templateFolder->count = 2;
//     return $templateFolder;
// });

// [
//     'fields' => 'folders.name,folders.id',
//     'count' => 2
// ]


// function($templateFolder) {
//     $templateFolder->fields = 'folders.name,folders.id';
//     $templateFolder->count = 2;
//     return $templateFolder;
// }


// $response = TemplateFolder::delete('46a9e5bad0');

/**
 * TEMPLATE FACADE
 */

// use LordDashMe\MailChimp\Core\Template\Facade\Template;

// Template::init(['apiKey' => $apiKey]);

/*
$response = Template::create(function($template) {

    $template->name = 'This is a sample template';

    $template->html = '<b> This is a Test Template </b>';

    return $template;
});
*/

/*
$response = Template::update('43089', function($template) {
    
    $template->name = 'This is an updated template';
    $template->html = '<b> New Content </b>';
    
    return $template;
});
*/


// $response = Template::select(function($template) {
//     return $template;
// });


// echo '<pre>';
// print_r($response);
// exit;
