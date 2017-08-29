<?php

/**
 * The Subscriber Exception Class.
 *
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Exception;

class SubscriberException extends \Exception
{
    /**
     * Holds the response output of a thrown exception.
     *
     * @var mixed
     */
    protected $response = null;
   
    /**
     * Initialize the response for exception. 
     *
     * @param  mixed  $response  Holds the throwable error.
     *
     * @return void
     */
    public function __construct($response = null)
    {
        $this->setError($response);
    }

    /**
     * The response field setter.
     *
     * @param  mixed  $response
     *
     * @return void
     */
    public function setError($response)
    {
        $this->response = $response;
    }

    /**
     * The reponse field getter.
     *
     * @return mixed
     */
    public function getError()
    {
        return $this->response;
    }

    /**
     * The throw expection message for undefined or not set primary fields for mailchimp.
     *
     * @return this
     */
    public function undefinedPrimaryFields()
    {
        $this->setError('The mailchimp primary field(s) not set in the closure.');

        return $this;
    }
}