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

/**
 * MailChimp Class.
 * 
 * A PHP package wrapper for MailChimp API.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimpCurl
{
    /**
     * The host protocol used.
     *
     * @var string
     */
    const MAILCHIMP_PROTOCOL = 'https';
    /**
     * The origin host of the mailchimp for api.
     *
     * @var string
     */
    const MAILCHIMP_HOST = 'api.mailchimp.com';
    /**
     * The version of the mailchimp api.
     *
     * @var string
     */
    const MAILCHIMP_API_VERSION = '3.0';

        /**
     * The maximum number of seconds to allow cURL functions to execute.
     *
     * @var int
     */
    const OPT_TIMEOUT = 120;
    /**
     * Set "true" to return the transfer as a string of the return value of curl_exec() 
     * instead of outputting it out directly
     *
     * @var boolean
     */
    const OPT_RETURNTRANSFER = true;
    /**
     * Set "false" to stop cURL from verifying the peer's certificate. 
     *
     * @var boolean
     */
    const OPT_SSL_VERIFYPEER = true;

    /**
     * The api key that will be use for the request in mailchimp api service.
     * 
     * @var string
     */
    protected $apiKey = '';
    
    /**
     * The location that will be target in the mailchimp api service.
     * 
     * @var string
     */
    protected $route = '';
    
    /**
     * The action that will execute in the curl request.
     * 
     * @var string
     */
    protected $method = '';
    
    /**
     * The request body that will be send in the mailchimp api service.
     * 
     * @var json
     */
    protected $data = null;

    /**
     * The mailchimpcurl class constructor.
     * 
     * @param  string  $apiKey
     * @param  string  $method
     * @param  string  $route
     * @param  json    $data
     * 
     * @return void
     */
    public function __construct($apiKey = '', $method = '', $route = '', $data = null)
    {
        $this->apiKey = $apiKey;
        $this->route = $route;
        $this->method = $method;
        $this->data = $data;
    }

    /**
     * Get the ccurent api key set in the property class.
     * 
     * @return string
     */
    protected function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Get the current route set in the property class.
     * 
     * @return string
     */
    protected function getRoute()
    {
        return $this->route;
    }

    /**
     * Get the method set in the property class.
     * 
     * @return string
     */
    protected function getMethod()
    {
        return $this->method;
    }

    /**
     * Get the data set in the property class.
     * 
     * @return json
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * The initialization method for the mailchimp curl class.
     *
     * @return json
     */
    public function init()
    {
        $curl = $this->curlOptions(\curl_init());
        
        $responseBody = \curl_exec($curl);
        $responseHttpCode = \curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        \curl_close($curl);

        return \json_encode(array(
            'response_body' => \json_decode($responseBody, true),
            'header' => array(
                'response_http_code' => $responseHttpCode
            )
        ));
    }

    /**
     * Prepare and get the curl options.
     *
     * @param  curl_init  $curl    The curl init instance.
     *
     * @return curl_init
     */
    protected function curlOptions($curl)
    {
        $options = [
            CURLOPT_URL             => $this->getUrl(),
            CURLOPT_USERPWD         => "user:{$this->getApiKey()}",
            CURLOPT_HTTPHEADER      => [ 'Content-Type: application/json' ],
            CURLOPT_CUSTOMREQUEST   => $this->getMethod(),
            CURLOPT_TIMEOUT         => self::OPT_TIMEOUT,
            CURLOPT_RETURNTRANSFER  => self::OPT_RETURNTRANSFER,
            CURLOPT_SSL_VERIFYPEER  => self::OPT_SSL_VERIFYPEER,
        ];
        
        if ($this->getData()) {
            $options = $this->resolveRequestData(
                $options, $this->getMethod(), $this->getData()
            );
        }

        \curl_setopt_array($curl, $options);
        
        return $curl;
    }

    /**
     * Resolve the request data depending on the request method type.
     *
     * @param  array   $options
     * @param  string  $method
     * @param  mixed   $data
     *
     * @return array
     */
    protected function resolveRequestData($options, $method, $data)
    {
        switch ($method) {
            case 'PUT':
            case 'POST':
            case 'PATCH':
                $options[CURLOPT_POSTFIELDS] = $data;
                break;
            case 'GET':
                $parameters = \http_build_query(\json_decode($data, true));
                $options[CURLOPT_URL] = "{$options[CURLOPT_URL]}?{$parameters}";
                break;
        } 

        return $options;
    }

    /**
     * Get the resolved mailchimp url. The host and route are merged
     * to create a full path for the location targeted in the mailchimp api service.
     * 
     * @return string
     */
    protected function getUrl()
    {
        return $this->resolveHost() . $this->getRoute();
    }

    /**
     * The primary url for mailchimp api service.
     *
     * @return string
     */
    protected function resolveHost()
    {
        $dataCenter = $this->getDataCenter(
            $this->getApiKey()
        );
        
        return self::MAILCHIMP_PROTOCOL . "://{$dataCenter}." . 
               self::MAILCHIMP_HOST . '/' . 
               self::MAILCHIMP_API_VERSION . '/'; 
    }
    /**
     * Determine the mailchimp api data center.
     * Base on the give api key we can get the data center located.
     *
     * @return string
     */
    protected function getDataCenter()
    {
        return \substr(
            $this->getApiKey(), 
            \strpos($this->getApiKey(), '-') + 1
        );
    }
}
