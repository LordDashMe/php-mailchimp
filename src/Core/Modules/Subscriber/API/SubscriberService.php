<?php

/**
 * The Subscriber Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 25, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber\API;

use LordDashMe\MailChimp\Core\MailChimpServiceAbstract;
use LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService as SubscriberServiceInterface;

class SubscriberService extends MailChimpServiceAbstract implements SubscriberServiceInterface
{
    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function createOrUpdate()
    {
        $resourceId = $this->baseResouceId();

        return (new Curl($this->baseApiKey(), $this->baseEndpoint() . "/{$resourceId}", 'PUT', $this->baseResources()))->execute();
    }

    /**
     * The base resource id for the endpoit.
     *
     * @return int
     */
    protected function baseResouceId() 
    {
        return $this->mutatorBag['memberId'];
    }

    /**
     * The subscriber create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $mailchimpApiHost = $this->resolveHostUrl();

        $listId = $this->mutatorBag['listId'];

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