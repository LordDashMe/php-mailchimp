<?php

/**
 * The Subscriber Facade Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Core\Subscriber\SubscriberManager;
use LordDashMe\MailChimp\Core\Subscriber\API\SubscriberService;

class SubscriberFacade
{
    /**
     * The mailchimp subscriber show all method api.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return json
     */
    public static function showAll($apiKey, $listId)
    {
        return (new SubscriberManager(new SubscriberService(), $apiKey, $listId))->showAll();
    }

    /**
     * The mailchimp subscriber show method api.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     * @param  string  $email
     *
     * @return json
     */
    public static function show($apiKey, $listId, $email)
    {
        return (new SubscriberManager(new SubscriberService(), $apiKey, $listId))->show($email);
    }

    /**
     * The mailchimp subscriber create method api.
     *
     * @param  string   $apiKey
     * @param  string   $listId
     * @param  closure  $closure
     *
     * @return json
     */
    public static function create($apiKey, $listId, $closure)
    {
        return (new SubscriberManager($closure(new SubscriberService()), $apiKey, $listId))->create();
    }

    /**
     * The mailchimp subscriber update method api.
     *
     * @param  string   $apiKey
     * @param  string   $listId
     * @param  string   $email
     * @param  closure  $closure
     *
     * @return json
     */
    public static function update($apiKey, $listId, $email, $closure)
    {
        return (new SubscriberManager($closure(new SubscriberService()), $apiKey, $listId))->update($email);
    }

    /**
     * The mailchimp subscriber delete method api.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     * @param  string  $email
     *
     * @return json
     */
    public static function delete($apiKey, $listId, $email)
    {
        return (new SubscriberManager(new SubscriberService(), $apiKey, $listId))->delete($email);
    }


    /**
     * The mailchimp subscriber create or update method api
     *
     * @param  string   $apiKey
     * @param  string   $listId
     * @param  string   $email
     * @param  closure  $closure
     *
     * @return json
     */
    public static function createOrUpdate($apiKey, $listId, $email, $closure)
    {
        return (new SubscriberManager($closure(new SubscriberService()), $apiKey, $listId))->createOrUpdate($email);
    }
}