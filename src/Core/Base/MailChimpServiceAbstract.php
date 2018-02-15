<?php

namespace PHPMailChimp\Core\Base;

use PHPMailChimp\Supports\Mutator;
use PHPMailChimp\Core\MailChimpHost;
use PHPMailChimp\Core\MailChimpClientUrl;

/**
 * The MailChimp Service Abstract Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimpServiceAbstract extends Mutator
{
    /**
     * Execute get method in the given url, this will show all the records.
     *
     * @return json
     */
    public function all()
    {
        $api = $this->baseHost() . $this->baseEndpoint();

        return (new MailChimpClientUrl($this->baseApiKey(), $api, 'GET', $this->baseResources()))
               ->execute();
    }

    /**
     * Execute get method in the given url, this will show specific record. 
     *
     * @return json
     */
    public function find()
    {
        $resouceId = $this->baseResouceId();

        $api = $this->baseHost() . $this->baseEndpoint() . "{$resouceId}";

        return (new MailChimpClientUrl($this->baseApiKey(), $api, 'GET', $this->baseResources()))
               ->execute();
    }

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp.
     *
     * @return json
     */
    public function create()
    { 
        $api = $this->baseHost() . $this->baseEndpoint();

        return (new MailChimpClientUrl($this->baseApiKey(), $api, 'POST', $this->baseResources()))
               ->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp.
     *
     * @return json
     */
    public function update()
    {
        $resouceId = $this->baseResouceId();

        $api = $this->baseHost() . $this->baseEndpoint() . "{$resouceId}";

        return (new MailChimpClientUrl($this->baseApiKey(), $api, 'PATCH', $this->baseResources()))
               ->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp.
     *
     * @return json
     */
    public function delete()
    {
        $resouceId = $this->baseResouceId();

        $api = $this->baseHost() . $this->baseEndpoint() . "{$resouceId}";

        return (new MailChimpClientUrl($this->baseApiKey(), $api, 'DELETE'))
               ->execute();
    }

    /**
     * The base api key value.
     *
     * @return string
     */
    protected function baseApiKey()
    {
        return $this->mutatorBag['apiKey'];
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
     * (No-op method)
     * 
     * The base endpoint route.
     *
     * @return string
     */
    protected function baseEndpoint() {}

    /**
     * (No-op method)
     * 
     * The base resource id for the endpoint.
     *
     * @return string
     */
    protected function baseResouceId() {}

    /**
     * (No-op method)
     * 
     * This will parse or prepare resources in the dynamic field instance.
     * The purpose of parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function baseResources() {}
}