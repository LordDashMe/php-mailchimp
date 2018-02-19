<?php

namespace PHPMailChimp\Core\Base;

/**
 * The MailChimp Manager Abstract Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
abstract class MailChimp
{
    /**
     * The module attribute that holds the bounded manager and service class.
     *
     * @var mixed
     */
    protected $module;

    public function __construct($headers = [])
    {
        $this->init($headers);
    }

    /**
     * The mailchimp manager abstract init method for static call compatibility.
     *
     * @param  array  $headers
     *
     * @return void
     */
    public function init($headers = [])
    {  
        /**
         * To escape the first initialization process
         * of the Facade support class.
         */
        if (empty($headers)) { return; }

        $this->module = static::module($headers);
    }

    /**
     * ( NOOP method )
     *
     * The module method that will provide the manager and service bindings.
     *
     * @param  array  $headers
     *
     * @throws \RuntimeException
     * 
     * @return mixed
     */
    protected function module($headers) 
    {
        throw new \RuntimeException('Module not properly initialized.');
    }

    /**
     * Dynamically call the methods inside the bounded manager and service class.
     * 
     * @param  string  $method
     * @param  array   $args
     * 
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->module->{$method}(...$args);
    }
}