# PHP MailChimp
- A straight forward php package for Mailchimp API v3.0

### Modules Supported:
1. Lists
	- Main Class Namespace: ```PHPMailChimp\Core\Modules\Lists\Facade\Lists```
2. Members
	- Main Class Namespace: ```PHPMailChimp\Core\Modules\Members\Facade\Members```
---
### Quick Usage:
- The PHP MailChimp usage are generic to all supported modules, meaning the example below will apply also to the other modules.
- The ```request body parameters``` and ```request path parameters``` are also the same as stated to the mailchimp api documentation.
- Recommended to check the actual mailchimp api documentation.
	- http://developer.mailchimp.com/documentation/mailchimp/reference/overview/
### Lists Module
---
- First initialize the Lists Module Primary Class and provide the API Key.
	- API Key can get in the Mailchimp Account Settings > Extras.
    ```php
    <?php

    use PHPMailChimp\Core\Modules\Lists\Facade\Lists;

    Lists::init(['apiKey' => 'qwxz123...']);

    ```
- After the initialization of the primary class, we can now use the default methods or action for the API.

### Show record
```php
<?php

// Closure Style
$response = Lists::find([], ['list_id' => 'a31gbd...']);

// Array Style
$response = Lists::find([], ['list_id' => 'a31gbd...']);

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
eyJoaXN0b3J5IjpbNjg0OTUyNzZdfQ==
-->