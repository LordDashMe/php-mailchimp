<?php

/**
 * The Curl Utility Class, that will be use in requesting webservices using PHP.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Utilities;

class Curl
{   
    /**
     * Set "true" to return the transfer as a string of the return value of curl_exec() 
     * instead of outputting it out directly
     *
     * @var boolean
     */
    const OPT_RETURNTRANSFER = true;

    /**
     * The maximum number of seconds to allow cURL functions to execute.
     *
     * @var int
     */
    const OPT_TIMEOUT = 16;

    /**
     * Set "false" to stop cURL from verifying the peer's certificate. 
     *
     * @var boolean
     */
    const OPT_SSL_VERIFYPEER = false;

    /**
     * The url field.
     *
     * @var string
     */
    protected $url;

    /**
     * The api key field.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The request method field.
     *
     * @var string
     */
    protected $requestMethod;

    /**
     * The request body data field.
     *
     * @var json 
     */
    protected $data;

    /**
     * The class constructor.
     *
     * @param  string  $url
     * @param  string  $apiKey
     * @param  string  $requestMethod
     * @param  json    $data
     *
     * @return void
     */
    public function __construct($apiKey, $url, $requestMethod, $data = null)
    {
        $this->setApiKey($apiKey)
             ->setUrl($url)
             ->setRequestMethod($requestMethod)
             ->setData($data);
    }

    /**
     * The setter method for api key field.
     *
     * @param  string  $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * The getter method for api key field
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * The setter method for url field.
     *
     * @param  string  $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * The getter method for url field.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * The setter method for request method field.
     *
     * @param  string  $requestMethod
     *
     * @return $this
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }

    /**
     * The getter method for request method field
     *
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * The setter method for data field.
     *
     * @param  json  $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * The getter method for data field.
     *
     * @return json
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * The execute method for the curl class
     *
     * @return json
     */
    public function execute()
    {
        $curl = $this->curlOptions(curl_init($this->getUrl()), 
            $this->getApiKey(), 
            $this->getRequestMethod(), 
            $this->getData()
        );
        
        $response = curl_exec($curl);
        
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return $this->curlResponse($response, $httpCode);
    }

    /**
     * The curl option setter.
     *
     * @param  curl_setopt  $curl
     * @param  string       $api_key
     * @param  string       $requestMethod
     * @param  json         $data
     *
     * @return \curl_setopt
     */
    private function curlOptions($curl, $apiKey, $requestMethod, $data)
    {
        $options = [
           CURLOPT_USERPWD              => "user:{$apiKey}",
           CURLOPT_HTTPHEADER           => ['Content-Type: application/json'],
           CURLOPT_RETURNTRANSFER       => Curl::OPT_RETURNTRANSFER,
           CURLOPT_TIMEOUT              => Curl::OPT_TIMEOUT,
           CURLOPT_SSL_VERIFYPEER       => Curl::OPT_SSL_VERIFYPEER,
           CURLOPT_CUSTOMREQUEST        => $requestMethod,
        ];

        if ($data) {
            $options[CURLOPT_POSTFIELDS] = $data;
        }

           curl_setopt_array($curl, $options);

        return $curl;
    }

    /**
     * The curl parse response.
     *
     * @param  json  $response
     * @param  int   $httpCode
     *
     * @return json
     */
    private function curlResponse($response, $httpCode)
    {
        return json_encode([
            'response' => json_decode($response, true),
            'header' => [
                'http_code' => $httpCode,
            ]
        ]);
    }
}