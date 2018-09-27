<?php

/*
 * This file is part of the MailChimp.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\MailChimp;

use LordDashMe\MailChimp\MailChimpCurl;
use LordDashMe\MailChimp\Exception\InvalidAPIKey as InvalidAPIKeyException;
use LordDashMe\MailChimp\Exception\InvalidArgumentPassed as InvalidArgumentPassedException;

/**
 * MailChimp Class.
 * 
 * A PHP package wrapper for MailChimp API.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimp 
{
    /**
     * The mailchimp account api key.
     * 
     * @var string
     */
    protected $apiKey = '';

    /**
     * The response of the request from the mailchimp api service.
     * 
     * @var mixed
     */
    protected $response = null;

    /**
     * The mailchimp class constructor.
     * 
     * @param  string  $apiKey    The required api key to access all the mailchimp api.
     * 
     * @return void
     */
    public function __construct($apiKey = '')
    {
        $this->init($apiKey);
    }
    
    /**
     * The sub method for the class constructor.
     * 
     * @param  string  $apiKey
     * 
     * @return void
     */
    public function init($apiKey = '')
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * The wapper method for the post http verb.
     * Handles all the post related execution.
     *
     * @param  string         $route
     * @param  array|closure  $callback
     *
     * @return $this
     */
    public function post($route, $callback)
    {
        $this->prepareHeaders();

        $requestBody = $this->processCallbackParameter($callback);
        
        $this->setRequest('POST', $route, $requestBody);

        $this->response = $this->initCurl('POST', $route, $requestBody);

        return $this;
    }

    /**
     * The wapper method for the get http verb.
     * Handles all the post related execution.
     *
     * @param  string  $route
     * 
     * @return $this
     */
    public function get($route)
    {
        $this->prepareHeaders();

        $requestBody = json_encode(array());

        $this->setRequest('GET', $route, $requestBody);

        $this->response = $this->initCurl('GET', $route, $requestBody);

        return $this;
    }

    /**
     * The wapper method for the patch http verb.
     * Handles all the post related execution.
     * 
     * @param  string         $route
     * @param  array|closure  $callback
     * 
     * @return $this
     */
    public function patch($route, $callback)
    {
        $this->prepareHeaders();

        $requestBody = $this->processCallbackParameter($callback);

        $this->setRequest('PATCH', $route, $requestBody);

        $this->response = $this->initCurl('PATCH', $route, $callback);

        return $this;
    }

    /**
     * The wapper method for the patch http verb.
     * Handles all the post related execution.
     *
     * @param  string  $route
     *  
     * @return $this
     */
    public function delete($route)
    {
        $this->prepareHeaders();

        $requestBody = json_encode(array());

        $this->setRequest('DELETE', $route, $requestBody);

        $this->response = $this->initCurl('DELETE', $route, $requestBody);

        return $this;
    }

    /**
     * The custom action of the mailchimp service.
     * To execute those action this method is the key.
     * Alias the method post, because all the action in mailchimp service
     * are set in post method.
     * 
     * @param  string  $route
     * 
     * @return $this
     */
    public function action($route)
    {
        return $this->post($route, array());
    }
    
    /**
     * Prepare the headers that needed to access the mailchimp api service.
     * 
     * @return void
     */
    protected function prepareHeaders()
    {
        if (empty($this->apiKey)) {
            throw InvalidAPIKeyException::isEmpty();
        }
    }

    /**
     * Temporary save the request on every instance.
     * This can be use for debugging purpose to check if the request is actually valid.
     * 
     * @param  string  $method
     * @param  string  $route
     * @param  json    $requestBody
     * 
     * @return void 
     */
    protected function setRequest($method, $route, $requestBody)
    {
        $this->request = array(
            'method' => $method,
            'route' => $route,
            'body' => $requestBody
        );
    }

    /**
     * To get the current request set in the property class.
     * This can be use for the debugging purpose.
     * 
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * To get the response of the request from the curl.
     * The response may be based on the actual mailchimp api.
     * 
     * @return json
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Process the given argument for the request body.
     * The callback process which allows to use closure or array type execution.
     * In the end process the argument must be set as array.
     * 
     * @param  array|closure  $callback
     * 
     * @return json
     */
    protected function processCallbackParameter($callback)
    {
        if (! \is_array($callback) && ! ($callback instanceof \Closure)) {
            throw InvalidArgumentPassedException::isNotArrayOrClosure();    
        }
        
        if ($callback instanceof \Closure) {
            $obj = (object) array();
            $callback = (array) $callback($obj);
        }

        return \json_encode($callback);
    }

    /**
     * The wrapper method for the MailChimpCurl class.
     * This allow us to mock the mail chimp url class in the unit test.
     * 
     * @param  string  $method          The request http method to be execute.
     * @param  string  $route           The location in the api service.
     * @param  json    $requestBody     The request body that will send to the api service.   
     * 
     * @return json
     */
    protected function initCurl($method, $route, $requestBody)
    {
        $mailchimpCurl = new MailChimpCurl(
            $this->apiKey, $method, $route, $requestBody
        );

        return $mailchimpCurl->init();
    }
}