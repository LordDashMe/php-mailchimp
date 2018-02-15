<?php

/**
 * The Campaign Facade Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 30, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign\Facade;

use LordDashMe\MailChimp\Utilities\Facade;

class Campaign extends Facade
{   
    /**
     * Set the namespace for the dynamic class.
     *
     * @return string
     */
    public static function getFacadeClass()
    {
        return 'LordDashMe\MailChimp\Core\Campaign\Campaign';
    }
}