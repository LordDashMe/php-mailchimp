<?php

/**
 * The Template Folder Facade Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\TemplateFolder\Facade;

use LordDashMe\MailChimp\Utilities\Facade;

class TemplateFolder extends Facade
{   
    /**
     * Set the namespace for the dynamic class.
     *
     * @return string
     */
    public static function getFacadeClass()
    {
        return 'LordDashMe\MailChimp\Core\TemplateFolder\TemplateFolder';
    }
}