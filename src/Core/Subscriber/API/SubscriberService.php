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
     * Execute get method in the given url, this will show all the members 
     * in the linked list id.
     *
     * @return json
     */
    public function showAll()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'GET'))->execute();
    }

    /**
     * Execute get method in the given url, this will show specific member 
     * in the linked list id.
     *
     * @return json
     */
    public function show()
    {
        $memberId = $this->mutatorBag['memberId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$memberId}", 'GET'))->execute();
    }

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function create()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'POST', $this->baseResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function update()
    {
        $memberId = $this->mutatorBag['memberId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$memberId}", 'PATCH', $this->baseResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscriber.
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
     * update/modify endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function createOrUpdate()
    {
        $memberId = $this->mutatorBag['memberId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$memberId}", 'PUT', $this->baseResources()))->execute();
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

        $mailchimpApiHost = Url::resolve($apiKey);

        return "{$mailchimpApiHost}/lists/{$listId}/members"; 
    }

    /**
     * This will parse or prepare resources in the dynamic field instance.
     * The purpose of parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function baseResources()
    {
        $mutatorBagCached = $this->mutatorBag;

        unset($mutatorBagCached['apiKey']);
        unset($mutatorBagCached['listId']);

        return json_encode($mutatorBagCached);
    }
}