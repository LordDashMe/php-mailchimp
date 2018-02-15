<?php

namespace PHPMailChimp\Core;

/**
 * The MailChimp Client Url.
 *
 * The class used in requestion api or webservices
 * of mailchimp using PHP curl function.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimpClientUrl
{   
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
    const OPT_SSL_VERIFYPEER = false;

    /**
     * The maximum number of seconds to allow cURL functions to execute.
     *
     * @var int
     */
    const OPT_TIMEOUT = 16;

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
        $curl = $this->getCurlOptions(curl_init());
        
        $responseBody = curl_exec($curl);
        
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return $this->getCurlResponse($responseBody, $httpCode);
    }

    /**
     * Prepare and get the curl options.
     *
     * @param  curl_setopt  $curl
     *
     * @return \curl_setopt
     */
    private function getCurlOptions($curl)
    {
        $url = $this->getUrl();
        $data = $this->getData();
        $apiKey = $this->getApiKey();
        $requestMethod = $this->getRequestMethod();

        $options = [
            CURLOPT_URL              => $url,
            CURLOPT_USERPWD          => "user:{$apiKey}",
            CURLOPT_HTTPHEADER       => ['Content-Type: application/json'],
            CURLOPT_CUSTOMREQUEST    => $requestMethod,
            CURLOPT_TIMEOUT          => self::OPT_TIMEOUT,
            CURLOPT_RETURNTRANSFER   => self::OPT_RETURNTRANSFER,
            CURLOPT_SSL_VERIFYPEER   => self::OPT_SSL_VERIFYPEER,
        ];

        if ($data) {
            $options = $this->resolveRequestData($options, $requestMethod, $data);
        }

        curl_setopt_array($curl, $options);

        return $curl;
    }

    /**
     * Resolve the request data depending on the request method type.
     *
     * @param  array   $options
     * @param  string  $requestMethod
     * @param  mixed   $data
     *
     * @return array
     */
    private function resolveRequestData($options, $requestMethod, $data)
    {
        switch ($requestMethod) {
            case 'PUT':
            case 'POST':
                $options[CURLOPT_POSTFIELDS] = $data;
                break;

            case 'GET':
                $parameters = http_build_query(json_decode($data, true));
                $options[CURLOPT_URL] = "{$options[CURLOPT_URL]}?{$parameters}";
                break;

            default:
                break;
        } 

        return $options;
    }

    /**
     * Get curl parse response.
     *
     * @param  json  $responseBody
     * @param  int   $httpCode
     *
     * @return json
     */
    private function getCurlResponse($responseBody, $httpCode)
    {
        return json_encode([
            'response_body' => json_decode($responseBody, true),
            'header' => [
                'http_code' => $httpCode,
            ]
        ]);
    }
}