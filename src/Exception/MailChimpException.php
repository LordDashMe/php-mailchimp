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
     * Holds the error response output of a thrown exception.
     *
     * @var mixed
     */
    protected $response = null;
   
    /**
     * Initialize the error response for exception. 
     *
     * @param  mixed  $response  Holds the throwable error.
     *
     * @return void
     */
    public function __construct($response = null)
    {
        $this->setResponse($response);
    }

    /**
     * The error response field setter.
     *
     * @param  mixed  $response
     *
     * @return void
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * The error reponse field getter.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}