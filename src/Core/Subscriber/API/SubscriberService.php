<?php

/**
 * The Subscriber Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 25, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber\API;

use LordDashMe\MailChimp\Utilities\Url;
use LordDashMe\MailChimp\Utilities\Curl;
use LordDashMe\MailChimp\Utilities\Mutator;
use LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService as SubscriberServiceInterface;

class SubscriberService extends Mutator implements SubscriberServiceInterface
{
    /**
     * Execute post method in the given url, this will be the 
     *  create/add endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function create()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'POST', $this->prepareResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     *  update/modify endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function update()
    {
        $memberId = $this->mutatorBag['memberId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$memberId}", 'PATCH', $this->prepareResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     *  update/modify endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function delete()
    {
        $memberId = $this->mutatorBag['memberId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$memberId}", 'DELETE'))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     *  update/modify endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function createOrUpdate()
    {
        $memberId = $this->mutatorBag['memberId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$memberId}", 'PUT', $this->prepareResources()))->execute();
    }

    /**
     * The subscriber create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $apiKey = $this->mutatorBag['apiKey'];
        $listId = $this->mutatorBag['listId'];

        $mailchimpApiHost = Url::parse($apiKey);

        return "{$mailchimpApiHost}/lists/{$listId}/members"; 
    }

    /**
     * This will parse or prepare resources in the dynamic field instance.
     * The purpose of parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function prepareResources()
    {
        $mutatorBagCached = $this->mutatorBag;

        unset($mutatorBagCached['apiKey']);
        unset($mutatorBagCached['listId']);

        return json_encode($mutatorBagCached);
    }
}