<?php

/**
 * The Facade Utility Class. 
 *
 * Use to convert dynamic class into static class this 
 * may result for many options to call, initialize or consume
 * the concrete class that extends this facade class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 30, 2017
 */

namespace LordDashMe\MailChimp\Utilities;

use RuntimeException;

class Facade
{
    /**
     * Holds the first instance of the dynamic class.
     *
     * @var object
     */
    protected static $class;

    /**
     * Resolves the dynamic to static call to the object.
     *
     * @param  string  $method
     * @param  array   $args
     * 
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::resolveFacadeClass();

        if (! $instance) {
            throw new RuntimeException('Facade instance has not been set.');
        }

       return $instance->$method(...$args);
    }

    /**
     * Resolver for the dynamic class instance.
     *
     * @return mixed
     */
    protected static function resolveFacadeClass()
    {
        /**
         * When "static::$class" already set then use the old one,
         *  this will retain the first initialization of the class.
         */ 
        if (is_object(static::$class)) {
            return static::$class;
        }

        static::$class = static::resolveClassNameSpace();

        return static::$class;
    }

    /**
     * Resolver for dynamic class namespace.
     *
     * @return mixed
     */
    protected static function resolveClassNameSpace()
    {
        $classNamespace = static::getFacadeClass();

        return new $classNamespace;
    }

    /**
     * Get the dynamic class namespace that will be convert to static class.
     *
     * @return string
     * 
     * @throws \RuntimeException
     */
    protected static function getFacadeClass()
    {
        throw new RuntimeException('Facade needs getFacadeClass to be declared or override in the inheritor or subclass class.');
    }
}