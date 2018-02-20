# PHP MailChimp
- A straight forward php package for Mailchimp API v3.0

### Modules Supported:
1. Lists
2. Members

### Quick Usage:
- The PHP MailChimp usage are generic to all supported modules so the example below will apply also to the other modules.
#### Subscriber or Member Management
- Reference: http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/
- The request body parameters of the Subscriber Class are also the same with the Mailchimp Structure, just convert it to php array.
- First initialize the Subscriber Class and provide the API Key and List ID.
    ```php
    <?php

    use LordDashMe\MailChimp\Core\Subscriber\Facade\Subscriber;

    Subscriber::init(['apiKey' => 'qwxz123...', 'listId' => '40bd...']);

    ```
- Show record.
    ```php
    <?php

    $response = Subscriber::find('sample@email.ph');

    ```
- Create record.
    ```php
    <?php

    $response = Subscriber::create(function ($subscriber) {

        $subscriber->subscriber_email = 'sample@email.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Sample First Name';
        $subscriber->subscriber_lastname = 'Sample Last Name';
        $subscriber->subscriber_birthday = '06/16';

        return $subscriber;
    });

    ```
- Update record.
    ```php
    <?php

    $response = Subscriber::update('sample@email.ph', function ($subscriber) {

        $subscriber->subscriber_email = 'sample_modified@email.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Sample Modified First Name';
        $subscriber->subscriber_lastname = 'Sample Modified Last Name';
        $subscriber->subscriber_birthday = '06/16';

        return $subscriber;
    });

    ```
- Delete record.
    ```php
    <?php

    $response = Subscriber::delete('sample@email.ph');

    ```
- Create or Update record.
    ```php
    <?php

    $response = Subscriber::createOrUpdate('sample@email.ph', function ($subscriber) {

        $subscriber->subscriber_email = 'sample_modified@email.ph';
        $subscriber->subscriber_status = 'subscribed';

        $subscriber->subscriber_firstname = 'Sample Modified First Name';
        $subscriber->subscriber_lastname = 'Sample Modified Last Name';
        $subscriber->subscriber_birthday = '06/16';

        return $subscriber;
    });

    ```
#### Campaign Management
- Reference: http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/
- The request body parameters of Campaign Class are also the same with the Mailchimp Structure, just convert it to php array.
- First initialize the Campaign Class and provide the API Key.
    ```php
    <?php

    use LordDashMe\MailChimp\Core\Campaign\Facade\Campaign;

    Campaign::init(['apiKey' => $apiKey]);

    ```
- Show record.
    ```php
    <?php

    $response = Campaign::find('3e3c1c...');

    ```
- Create record.
    ```php
    <?php
    
    $response = Campaign::create(function($campaign) {

        $campaign->recipients = [
            'list_id' => '40bd...',
        ];

        $campaign->type = 'regular';

        $campaign->settings = [
            'subject_line' => 'First Launch of MailChimp PHP Package',
            'reply_to' => 'support_sample@email.ph',
            'from_name' => 'MailChimp PHP Package',
        ];

        return $campaign;
    });
    
    ```
- Update record.
    ```php
    <?php
    
    $response = Campaign::update('3e3c1c...', function($campaign) {

        $campaign->recipients = [
            'list_id' => '40bd...',
        ];

        $campaign->type = 'regular';

        $campaign->settings = [
            'subject_line' => 'First Launch of MailChimp PHP Package Updated',
            'reply_to' => 'support_sample@email.ph',
            'from_name' => 'MailChimp PHP Package Updated',
        ];

        return $campaign;
    });
    
    ```
- Delete record.
    ```php
    <?php
    
    $response = Campaign::delete('3e3c1c...');
    
    ```
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTY4Mzc0ODcwMl19
-->