<?php

/**
 * The Facade Utility Class. Use to convert dynamic class
 *	into static class.
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
		// when "static::$class" already set then use that old one,
		// this will retain the first initialization of the class.
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
		$namespace = static::getFacadeClass();

		return new $namespace;
	}

	/**
	 * Get the dynamic class instance that will be convert to static class.
	 *
	 * @return string
	 * 
	 * @throws \RuntimeException
	 */
	protected static function getFacadeClass()
	{
		throw new RuntimeException('Facade needs getFacadeClass to be declared in the inheritor or subclass class.');
	}
}