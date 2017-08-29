<?php

/**
 * The Subscriber Adapter Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Core\Subscriber\SubscriberFacade;

class SubscriberAdapter
{   
    /**
     * The api key field for the adapter class.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The list id field for the adapter class.
     */
    protected $listId;

    /**
     * The subscriber adapter class constructor.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return void
     */
    public function __construct($apiKey = '', $listId = '')
    {
        $this->setApiKey($apiKey)->setListId($listId);
    }

    /**
     * The setter method for api key field.
     *
     * @param  string  $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * The getter method for api key field.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * The setter method for the list id field.
     *
     * @param  string  $listId
     *
     * @return $this
     */
    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }

    /**
     * The getter method for the list id field.
     *
     * @return string
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * The subscriber adapter class method initialization.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return LordDashMe\MailChimp\Core\Subscriber\SubscriberAdapter
     */
    public function init($apiKey = '', $listId = '')
    {
        return new static($apiKey, $listId);
    }

    /**
     * The mailchimp subscriber show all method to be transform.
     *
     * @param  string  $email
     *
     * @return json
     */
    public function showAll()
    {
        return SubscriberFacade::showAll($this->getApiKey(), $this->getListId());
    }

    /**
     * The mailchimp subscriber show method to be transform.
     *
     * @param  string  $email
     *
     * @return json
     */
    public function show($email)
    {
        return SubscriberFacade::show($this->getApiKey(), $this->getListId(), $email);
    }

    /**
     * The mailchimp subscriber create method to be transform.
     *
     * @param  function  $closure
     *
     * @return json
     */
    public function create($closure)
    {
        return SubscriberFacade::create($this->getApiKey(), $this->getListId(), $closure);    
    }

    /**
     * The mailchimp subscriber update method to be transform.
     *
     * @param  string    $email
     * @param  function  $closure
     *
     * @return json
     */
    public function update($email, $closure)
    {
        return SubscriberFacade::update($this->getApiKey(), $this->getListId(), $email, $closure);
    }

    /**
     * The mailchimp subscriber delete method to be transform.
     *
     * @param  string  $email
     *
     * @return json
     */
    public function delete($email)
    {
        return SubscriberFacade::delete($this->getApiKey(), $this->getListId(), $email);
    }

    /**
     * The mailchimp subscriber create or update method to be transform.
     *
     * @param  string    $email
     * @param  function  $closure
     *
     * @return json
     */
    public function createOrUpdate($email, $closure)
    {
        return SubscriberFacade::createOrUpdate($this->getApiKey(), $this->getListId(), $email, $closure);
    }
}