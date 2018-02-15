<?php

namespace PHPMailChimp\Core\Base;

/**
 * The MailChimp Abstract Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
abstract class MailChimpAbstract
{
    /**
     * The headers field.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * The mailchimp abstract class constructor.
     *
     * @param  array  $headers
     */
    public function __construct($headers = [])
    {
        $this->init($headers);
    }

    /**
     * The mailchimp abstract init method for static call compatibility.
     *
     * @param  array  $headers
     *
     * @return void
     */
    public function init($headers = [])
    {
        $this->setHeaders($headers);
    }

    /**
     * The setter method for the headers field.
     *
     * @param  mixed  $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * The getter method for the service field.
     *
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Resolver for the normal context call method.
     *
     * @param  string  $method
     * @param  array   $args
     *
     * @return json
     */
    public function __call($method, $args)
    {
        $serviceHeaders = $this->getHeaders();

        if (! $serviceHeaders) {
            throw new \RuntimeException('The service bindings not set properly!');      
        }

        $serviceContext = $this->serviceBindings($serviceHeaders);

        return $serviceContext->{$method}(...$args);  
    }

    /**
     * (No-op method)
     * 
     * Get the resolve service injection of the manager and worker.
     *
     * @return mixed
     */
    protected function serviceBindings() {}
}