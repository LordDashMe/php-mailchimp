<?php

/**
 * The Overloader Utility Class.
 * This also known as "interpreter hooks" for the other people in the PHP community.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Utilities;

class Overloader
{   
    /**
     * The __call magic method of PHP.
     * Triggered when invoking inaccessible methods in an object context.
     * This method required a public function objectClass for the sub-class or inheritor.
     * @uses $this->objectClass()
     * 
     * @param  string  $name
     * @param  array   $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->objectClass(), $name), $arguments);
    }

    /**
     * The __callStatic magic method of PHP.
     * Triggered when invoking inaccessible methods in a static context.
     * This method required a public static function staticClass for the sub-class or inheritor.
     * @uses static::staticClass()
     *
     * @param  string  $name
     * @param  array   $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array(array(static::staticClass(), $name), $arguments);
    }
}