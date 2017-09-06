<?php

/**
 * The Subscriber Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Core\MailChimpAbstract;
use LordDashMe\MailChimp\Core\Subscriber\SubscriberManager;
use LordDashMe\MailChimp\Core\Subscriber\API\SubscriberService;

class Subscriber extends MailChimpAbstract
{   
    /**
     * The subscriber class constructor.
     *
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct($headers = array())
    {
        parent::__construct($headers);
    }

    /**
     * Resolve the service injection for the manager and worker.
     *
     * @return mixed
     */
    protected function concreteService()
    {
        return new SubscriberManager(new SubscriberService(), $this->getHeaders());
    }
}