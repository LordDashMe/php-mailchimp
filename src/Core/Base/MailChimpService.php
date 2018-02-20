<?php

namespace PHPMailChimp\Core\Base;

use PHPMailChimp\Supports\Mutator;
use PHPMailChimp\Core\Utilities\MailChimpHost;
use PHPMailChimp\Core\Utilities\MailChimpHttpRequest;
use PHPMailChimp\Contracts\Base\MailChimpService as MailChimpServiceInterface;

/**
 * The MailChimp Service Abstract Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
abstract class MailChimpService extends Mutator implements MailChimpServiceInterface
{
    /**
     * Execute get method in the given url, this will show all the records.
     *
     * @return json
     */
    public function all()
    {
        $endpoint = $this->baseHost() . $this->baseEndpoint();

        return $this->mailchimpCurl($this->baseApiKey(), $endpoint, 'GET', $this->baseResources());
    }

    /**
     * Execute get method in the given url, this will show specific record. 
     *
     * @return json
     */
    public function find()
    {
        $endpoint = $this->baseHost() . $this->baseEndpoint() . $this->baseResouceId();

        return $this->mailchimpCurl($this->baseApiKey(), $endpoint, 'GET', $this->baseResources());
    }

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp.
     *
     * @return json
     */
    public function create()
    { 
        $endpoint = $this->baseHost() . $this->baseEndpoint();

        return $this->mailchimpCurl($this->baseApiKey(), $endpoint, 'POST', $this->baseResources());
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp.
     *
     * @return json
     */
    public function update()
    {
        $endpoint = $this->baseHost() . $this->baseEndpoint() . $this->baseResouceId();

        // var_dump($endpoint);exit;

        return $this->mailchimpCurl($this->baseApiKey(), $endpoint, 'PATCH', $this->baseResources());
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp.
     *
     * @return json
     */
    public function delete()
    {
        $endpoint = $this->baseHost() . $this->baseEndpoint() . $this->baseResouceId();

        return $this->mailchimpCurl($this->baseApiKey(), $endpoint, 'DELETE');
    }

    /**
     * The mailchimp curl class.
     * 
     * @param  string  $apiKey    
     * @param  string  $endpoint  The full constructed url for the api of mailchimp.
     * @param  string  $method 
     * @param  json    $resources 
     * 
     * @return mixed
     */
    protected function mailchimpCurl($apiKey, $endpoint, $method, $resources = null)
    {
        return (new MailChimpHttpRequest($apiKey, $endpoint, $method, $resources))->execute();
    }

    /**
     * The base api key value.
     *
     * @return string
     */
    protected function baseApiKey()
    {
        return $this->mutatorBag['request_headers']['apiKey'];
    }

    /**
     * The base host of mailchimp.
     * 
     * @return string
     */
    protected function baseHost()
    {
        return MailChimpHost::resolve($this->baseApiKey()) . '/';
    }

    /**
     * ( NOOP method )
     * 
     * The base endpoint route.
     *
     * @return string
     */
    protected function baseEndpoint() 
    {
        return '';
    }

    /**
     * ( NOOP method )
     * 
     * The base resource id for the endpoint.
     *
     * @return string
     */
    protected function baseResouceId() 
    {
        return '';
    }

    /**
     * ( NOOP method )
     * 
     * This will parse or prepare resources in the dynamic field instance.
     * Parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function baseResources() 
    {
        return json_encode(array());
    }
}