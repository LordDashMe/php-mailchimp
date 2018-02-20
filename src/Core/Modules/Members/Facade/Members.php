<?php

namespace PHPMailChimp\Core\Modules\Members\Facade;

use PHPMailChimp\Supports\Facade;

/**
 * The Members Static Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Members extends Facade
{   
    /**
     * The namespace of the normal class that will be converted to static class.
     *
     * @return string
     */
    public static function getFacadeClass()
    {
        return 'PHPMailChimp\Core\Modules\Members\Members';
    }
}