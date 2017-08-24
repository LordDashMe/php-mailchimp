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
	 * Holds the response output of a request.
	 *
	 * @var mixed
	 */
    public $responseHandler = null;
   
    /**
	 * Initialize the response for exception. 
	 *
	 * @param  mixed  $response  Holds the throwable error.
	 * @return void
     */
    public function __construct($response)
    {
        $this->responseHandler = $response;
    }
}