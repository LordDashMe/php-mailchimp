<?php

/**
 * The MailChimp Exception Class.
 *
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Exception;

class MailChimpException extends \Exception
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
}