<?php

/**
 * The MailChimp Abstract Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 30, 2017
 */

namespace LordDashMe\MailChimp\Core;

abstract class MailChimpAbstract
{
	/**
     * The headers field.
     *
     * @var array
     */
    protected $headers;

    /**
     * The resolved manager and worker instance.
     *
     * @var mixed
     */
    protected $service;

    /**
     * The mailchimp abstract class constructor.
     *
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct($headers = array())
    {
        $this->init($headers);  
    }

    /**
     * The mailchimp abstract init method.
     *
     * @param  array  $headers
     *
     * @return void
     */
    public function init($headers)
    {
        if (count($headers) > 0) {
            $this->setHeaders($headers);
            $this->setService($this->resolveService());
        }
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
     * The setter method for the service field.
     *
     * @param  mixed  $service
     *
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * The getter method for the service field.
     *
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

	/**
     * Resolver for the dynamic call method.
     *
     * @param  string  $method
     * @param  array   $args
     *
     * @return json
     */
    public function __call($method, $args)
    {
        return $this->getService()->$method(...$args);
    }

    /**
     * "Noop" method, resolve the service injection for the manager and worker.
     *
     * @return mixed
     */
    protected function resolveService() {}
}