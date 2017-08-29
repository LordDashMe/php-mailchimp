<?php

/**
 * The Subscriber Manager Abstract Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

abstract class SubscriberManagerAbstract
{
    /**
     * The subscriber service that manage the interaction in the mailchimp api.
     *
     * @var \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService
     */
    protected $subscriberService;

    /**
     * The subscriber header field, it holds the api key and list id.
     *
     * @var array
     */
    protected $subscriberHeaders;

    /**
     * The setter method for the subscriber service field.
     *
     * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService  $subscriberService
     *
     * @return $this
     */
    public function setSubscriberService($subscriberService)
    {
        $this->subscriberService = $subscriberService;

        return $this;
    }

    /**
     * The getter method for the subscriber service field.
     *
     * @return \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService
     */
    public function getSubscriberService()
    {
        return $this->subscriberService;
    }

    /**
     * The setter method for the subscriber headers field.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return $this
     */
    public function setSubscriberHeaders($apiKey, $listId)
    {
        $this->subscriberHeaders['apiKey'] = $apiKey;
        $this->subscriberHeaders['listId'] = $listId;

        return $this;
    }

    /**
     * The getter method for the subscriber header field.
     *
     * @return array
     */
    public function getSubscriberHeaders()
    {
        return $this->subscriberHeaders;
    }
}