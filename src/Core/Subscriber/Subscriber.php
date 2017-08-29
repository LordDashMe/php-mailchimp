<?php

/**
 * The Subscriber Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Utilities\Overloader;
use LordDashMe\MailChimp\Core\Subscriber\SubscriberAdapter;
use LordDashMe\MailChimp\Contract\Subscriber\Subscriber as SubscriberInterface;

class Subscriber extends Overloader implements SubscriberInterface
{
    /**
     * The object class context field representing the subscriber adapter class.
     *
     * @var LordDashMe\MailChimp\Core\Subscriber\SubscriberAdapter
     */
    protected $objectClass;

    /**
     * The subscriber class constructor.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return void
     */
    public function __construct($apiKey, $listId)
    {
        $this->objectClass = new SubscriberAdapter($apiKey, $listId);
    }

    /**
     * The object class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     *
     * @return LordDashMe\MailChimp\Core\Subscriber\SubscriberAdapter
     */
    public function objectClass()
    {
        return $this->objectClass;
    }

    /**
     * The static class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     *
     * @return LordDashMe\MailChimp\Core\Subscriber\SubscriberFacade
     */
    public static function staticClass()
    {
        return 'LordDashMe\MailChimp\Core\Subscriber\SubscriberFacade';   
    }
}