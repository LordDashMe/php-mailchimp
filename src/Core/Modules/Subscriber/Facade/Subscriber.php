<?php

/**
 * The Subscriber Facade Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 30, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber\Facade;

use LordDashMe\MailChimp\Utilities\Facade;

class Subscriber extends Facade
{   
    /**
     * Set the namespace for the dynamic class.
     *
     * @return string
     */
    public static function getFacadeClass()
    {
        return 'LordDashMe\MailChimp\Core\Subscriber\Subscriber';
    }
}