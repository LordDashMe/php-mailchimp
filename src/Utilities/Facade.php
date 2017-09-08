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
     * Holds the first instance of the dynamic classes.
     *
     * @var array
     */
    protected static $class = [];

    /**
     * Set the class instance in the class field array
     * for caching and will be use later.
     *
     * @param  string  $classNamespace
     * @param  mixed   $instance
     *
     * @return void
     */
    public static function setClass($classNamespace, $instance)
    {
        self::$class[$classNamespace] = $instance;
    }

    /**
     * Get the class instance.
     *
     * @param  string  $classNamespace
     *
     * @return mixed
     */
    public static function getClass($classNamespace)
    {
        return isset(self::$class[$classNamespace]) ? self::$class[$classNamespace] : false;
    }

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
        $instance = self::resolveFacadeClass();

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
        $classNamespace = static::getFacadeClass();

        $classInstance = self::getClass($classNamespace);
    
        if ($classInstance) {
            return $classInstance;
        }

        return self::resolveClassNameSpace($classNamespace);
    }

    /**
     * Resolver for dynamic class namespace and
     * set or cache the resolved dynamic class to the class field.
     *
     * @param  string  $classNamespace
     *
     * @return void
     */
    protected static function resolveClassNameSpace($classNamespace)
    {
        $classInstance = new $classNamespace;

        self::setClass($classNamespace, $classInstance);

        return $classInstance;
    }

    /**
     * "Noop" method, get the dynamic class namespace that will be convert to static class.
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