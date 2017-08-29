<?php

/**
 * The Campaign Exception Class.
 *
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Exception;

use LordDashMe\MailChimp\Exception\MailChimpExceptionl;

class CampaignException extends MailChimpException
{
    /**
     * Initialize the response for exception. 
     *
     * @param  mixed  $response  Holds the throwable error.
     *
     * @return void
     */
    public function __construct($response = null)
    {
        parent::__construct($response);
    }
}