<?php

namespace PHPMailChimp\Core\Modules\Lists\Facade;

use PHPMailChimp\Supports\Facade;

/**
 * The Lists Static Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Lists extends Facade
{   
    /**
     * The namespace of the normal class that will be converted to static class.
     *
     * @return string
     */
    public static function getFacadeClass()
    {
        return 'PHPMailChimp\Core\Modules\Lists\Lists';
    }
}