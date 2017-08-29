<?php

/**
 * The Subscriber Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Contract\Subscriber;

interface Subscriber 
{
    /**
     * The object class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     * This will be added functionality for the overloader utility class.
     *
     * @return LordDashMe\MailChimp\Core\Subscriber\SubscriberAdapter
     */
    public function objectClass();

    /**
     * The static class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     * This will be added functionality for the overloader utility class.
     *
     * @return LordDashMe\MailChimp\Core\Subscriber\SubscriberFacade
     */
    public static function staticClass();
}