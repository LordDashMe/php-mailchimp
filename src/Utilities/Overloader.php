<?php

/**
 * The Overloader Utility Class.
 * This also known as "interpreter hooks" for the other people in the PHP community.
 * "Noop" or no-operation is a style of telling other that the method is overridable by the inheritor or subclass.
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

    /**
     * Noop for the object class context method.
     * This will be the class instance or object holder that later on will be use
     *  in call_user_func_array.
     *
     * @return instance|class
     */
    public function objectClass() {}

    /**
     * Noop for the static class context method.
     * This will be the namespace holder that later on will be use in call_user_func_array.
     *
     * @return string
     */
    public static function staticClass() {}
}