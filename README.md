# PHP MailChimp
- A straight forward php package for Mailchimp API v3.0

### Modules Supported:
1. Lists
	- Main Class Namespace: ```PHPMailChimp\Core\Modules\Lists\Facade\Lists```
2. Members
	- Main Class Namespace: ```PHPMailChimp\Core\Modules\Members\Facade\Members```
---
### Quick Usage:
- The ```PHP MailChimp``` usage are generic to all supported modules, meaning the example below will apply also to the other modules.
- The ```request body parameters``` and ```request path parameters```  structure are also the same to the mailchimp api documentation.
- Recommended to check the actual mailchimp api documentation.
	- http://developer.mailchimp.com/documentation/mailchimp/reference/overview/
- The module primary class structure consist only of ```request body``` and ```request path```, see example below:
```php
<?php

// Initialize Module
Module::init(['apiKey' => 'abcde1234...', ...]);

// Use the default module action.
// Request Body and Request Path can be declare in two ways
// by using Closure or Array
$response = Module::create(Request Body, Request Path);

// Closure
$response = Module::create(
	function($requestBody) {
		return $requestBody;
	}, 
	function($requestPath){
		return $requestPath;
	}
);

// Array
$response = Module::create([...], [...]);

```

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

##### Show Record
```php
<?php

// Closure Style
$response = Lists::find(
	function($requestBody) {
		return $requestBody;
	}, 
	function($requestPath){
		$requestPath->list_id = 'a31gbd...';
		return $requestPath;
	}
);

// Array Style
$response = Lists::find([], ['list_id' => 'a31gbd...']);

```
##### Create Record
```php
<?php

// Closure Style
$response = Lists::create(
	function($requestBody) {
		$requestBody->name = 'Lists Name';
		...
		return $requestBody;
	}, 
	function($requestPath){
		return $requestPath;
	}
);

// Array Style
$response = Lists::create(['name' => 'Lists Name', ...], []);

```
##### Update Record
```php
<?php

// Closure Style
$response = Lists::update(
	function($requestBody) {
		$requestBody->name = 'Lists Name';
		...
		return $requestBody;
	}, 
	function($requestPath){
		$requestPath->list_id = 'a31gbd...';
		return $requestPath;
	}
);

// Array Style
$response = Lists::update(['name' => 'Lists Name', ...], ['list_id' => 'a31gbd...']);

```
##### Delete Record
```php
<?php

// Closure Style
$response = Lists::delete(
	function($requestBody) {
		return $requestBody;
	}, 
	function($requestPath){
		$requestPath->list_id = 'a31gbd...';
		return $requestPath;
	}
);

// Array Style
$response = Lists::delete([], ['list_id' => 'a31gbd...']);


```
---
### Support
- If you have any question feel free to contact me just drop a mail to this email address:
	- reyesjoshuaclifford@gmail.com

<!--stackedit_data:
eyJoaXN0b3J5IjpbMzM3OTA5NzY4XX0=
-->