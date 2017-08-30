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
    protected $errorResponse = null;
   
    /**
     * Initialize the error response for exception. 
     *
     * @param  mixed  $errorResponse  Holds the throwable error.
     *
     * @return void
     */
    public function __construct($errorResponse = null)
    {
        $this->setErrorResponse($errorResponse);
    }

    /**
     * The error response field setter.
     *
     * @param  mixed  $errorResponse
     *
     * @return void
     */
    public function setErrorResponse($errorResponse)
    {
        $this->errorResponse = $errorResponse;
    }

    /**
     * The error reponse field getter.
     *
     * @return mixed
     */
    public function getErrorResponse()
    {
        return $this->errorResponse;
    }
}