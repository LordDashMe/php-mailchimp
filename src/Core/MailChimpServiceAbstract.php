<?php

/**
 * The MailChimp Service Abstract Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 08, 2017
 */

namespace LordDashMe\MailChimp\Core;

use LordDashMe\MailChimp\Utilities\Url;
use LordDashMe\MailChimp\Utilities\Curl;
use LordDashMe\MailChimp\Utilities\Mutator;

class MailChimpServiceAbstract extends Mutator
{
    /**
     * Execute get method in the given url, this will show all the records.
     *
     * @return json
     */
    public function all()
    {
        return (new Curl($this->baseApiKey(), $this->baseEndpoint(), 'GET', $this->baseResources()))->execute();
    }

    /**
     * Execute get method in the given url, this will show specific record. 
     *
     * @return json
     */
    public function find()
    {
        $resouceId = $this->baseResouceId();

        return (new Curl($this->baseApiKey(), $this->baseEndpoint() . "/{$resouceId}", 'GET', $this->baseResources()))->execute();
    }

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp.
     *
     * @return json
     */
    public function create()
    {
        return (new Curl($this->baseApiKey(), $this->baseEndpoint(), 'POST', $this->baseResources()))->execute();
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

        return (new Curl($this->baseApiKey(), $this->baseEndpoint() . "/{$resouceId}", 'PATCH', $this->baseResources()))->execute();
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

        return (new Curl($this->baseApiKey(), $this->baseEndpoint() . "/{$resouceId}", 'DELETE'))->execute();
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
     * "Noop" method, the base resource id for the endpoit.
     *
     * @return int
     */
    protected function baseResouceId() {}

    /**
     * "Noop" method, the base endpoint route.
     *
     * @return string
     */
    protected function baseEndpoint() {}

    /**
     * Resolver for the mailChimp host url.
     *
     * @return string
     */
    protected function resolveHostUrl()
    {
        return Url::resolve($this->baseApiKey());
    }

    /**
     * "Noop" method, this will parse or prepare resources in the dynamic field instance.
     * The purpose of parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function baseResources() {}
}