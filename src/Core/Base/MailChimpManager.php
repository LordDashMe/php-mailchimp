<?php

namespace PHPMailChimp\Core\Base;

use PHPMailChimp\Core\Exceptions\MailChimpException;
use PHPMailChimp\Contracts\Base\MailChimpService as MailChimpServiceInterface;

/**
 * The MailChimp Manager Abstract Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
abstract class MailChimpManager
{
    /**
     * The service that manage the interaction to the mailchimp api.
     *
     * @var mixed
     */
    protected $service = null;

    /**
     * The request header, it holds the api key and etc.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * The mailchimp manager abstract constructor.
     *
     * @param  array  $headers
     * @param  mixed  $service
     */
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

        $this->setService(static::registerModule());

        $this->setHeaders($headers);
    }

    /**
     * ( NOOP method )
     *
     * The register module method that will provide the manager and service bindings.
     *
     * @throws PHPMailChimp\Core\Exceptions\MailChimpException
     * 
     * @return mixed
     */
    protected function registerModule() 
    {
        throw MailChimpException::cannotResolveRegisterModuleMethod();
    }

    /**
     * The setter method for the mailchimp service.
     *
     * @param  mixed  $service
     *
     * @return $this
     */
    protected function setService($service) 
    {
        $this->service = $service;

        return $this;
    }

    /**
     * The setter method for the mailchimp headers.
     *
     * @param  array  $headers
     *
     * @throws PHPMailChimp\Core\Exceptions\MailChimpException
     * 
     * @return $this
     */
    protected function setHeaders($headers)
    {
        if (! is_array($headers)) {
            throw MailChimpException::cannotResolveModuleHeaders();
        }

        $this->validateHeaders($headers);

        $this->headers = $headers;
        
        return $this;
    }

    /**
     * ( NOOP method )
     *
     * Check if the required header apiKey is available.
     * This function can be override by the sub-class or inheritor.
     *
     * @param  array  $headers
     *
     * @throws PHPMailChimp\Core\Exceptions\MailChimpException
     *
     * @return void
     */
    protected function validateHeaders($headers)
    {
        if (! isset($headers['apiKey'])) {
            throw MailChimpException::cannotResolveHeadersResources();
        }
    }

    /**
     * Dynamic call of mailchimp service.
     * 
     * @param  string  $method
     * @param  array   $args
     *
     * @throws PHPMailChimp\Core\Exceptions\MailChimpException
     * 
     * @return json
     */
    public function __call($method, $args)
    {
        $this->requestBaseProcess(...$args);
        
        try {
            return ($this->requestActionProcess($method))->{$method}();
        } catch (MailChimpException $e) {
            exit($e->getMessage());
        }  
    }

    /**
     * The default mailchimp request structure.
     *
     * @param  array|closure  $requestPathParameters
     * @param  array|closure  $requestBodyParameters
     *
     * @return $this
     */
    private function requestBaseProcess($requestBodyParameters = null, $requestPathParameters = null)
    {
        $this->requestHeaders()
             ->requestBodyParameters($requestBodyParameters)
             ->requestPathParameters($requestPathParameters);
             
        return $this;  
    }

    /**
     * The base process for the given request action.
     *
     * @param  string  $method
     *
     * @return mixed
     */
    private function requestActionProcess($method)
    {
        switch ($method) {
            case 'all':
            case 'find':
            case 'delete':
                return $this->viewRequestProcess(); 
            case 'create':
            case 'update':
                return $this->manipulationRequestProcess();
        }
    }

    /**
     * The base process for show all, find and delete api request.
     *
     * @return mixed
     */
    private function viewRequestProcess()
    {
        return $this->validateRequestPathParameters($this->service);
    }

    /**
     * The base process for create and update api request.
     *
     * @return mixed
     */
    private function manipulationRequestProcess()
    {
        return $this->removeRequestBodyParameters(
            $this->modifyRequestBodyParameters(
                $this->validateRequestBodyParameters($this->service)
            )
        );
    }

    /**
     * Headers for the request.
     * 
     * @return $this
     */
    protected function requestHeaders()
    {   
        $properties = [];

        foreach ($this->headers as $property => $value) {
            $properties[$property] = $value;
        }

        $this->service->request_headers = $properties;

        return $this;
    }

    /**
     * Request boy parameters for the dynamic endpoint arguments, it can be
     * a closure or a array declaration and if the array is selected
     * it will automatically converted to worker class property.
     *
     * @param  mixed  args
     *
     * @return mixed
     */
    protected function requestBodyParameters($args)
    {
        return $this->parametersConverter($args, 'request_body_parameters', 
            'There\'s no request body parameter(s) detected. use closure or array 
            to specify the request body parameter of the endpoint. If request body parameter(s) are
            not applicable to the method then provide atleast empty array or closure.'
        );
    }

    /**
     * ( NOOP method )
     * 
     * Check if the primary fields of MailChimp are available in the current service context.
     *
     * @param  mixed  $service
     *
     * @throws PHPMailChimp\Core\Exceptions\MailChimpException
     *
     * @return mixed
     */
    protected function validateRequestBodyParameters($service) 
    { 
        return $service; 
    }

    /**
     * ( NOOP method )
     *
     * Add class field(s) in the current service context.
     *
     * @param  mixed  $service
     * 
     * @return mixed
     */
    protected function modifyRequestBodyParameters($service) 
    { 
        return $service; 
    }

    /**
     * ( NOOP method )
     * 
     * Remove class field(s) in the current service context.
     *
     * @param  mixed  $service
     *
     * @return mixed
     */
    protected function removeRequestBodyParameters($service) 
    { 
        return $service; 
    }

    /**
     * Path parameters for the request.
     *
     * @return $this
     */
    protected function requestPathParameters($args)
    {
        return $this->parametersConverter($args, 'request_path_parameters');
    }

    /**
     * ( NOOP method )
     *
     * Check if the request path parameters pass the validation rules.
     *
     * @param  mixed  $service
     *
     * @return mixed
     */
    protected function validateRequestPathParameters($service)
    {
        return $service;
    }

    /**
     * The converter for mailchimp request body parameters.
     *
     * This will convert closure or array into valid mailchimp request
     * body parameters, this makes the plugin more flexible to any parameters given.
     * 
     * @param  array|closure  $args
     * @param  string         $parameterType
     * @param  string         $exceptionMessage
     *
     * @throws PHPMailChimp\Core\Exceptions\MailChimpException
     * 
     * @return void
     */
    protected function parametersConverter($args, $parameterType, $exceptionMessage = '')
    {
        if ($args || is_array($args)) {

            /**
             * Check if the $args is a closure type convert into array form
             * then procceed to mutating all the properties.
             */
            if ($args instanceof \Closure) {
                $object = (object) [];
                $args = (array) $args($object);  
            }

            $properties = [];

            foreach ($args as $property => $value) {
                $properties[$property] = $value;
            }

            $this->service->{$parameterType} = $properties;

            return $this;
        }

        /**
         * Notify there's no request parameter matches
         * the required type (Closure and Array).
         */
        if ($exceptionMessage) {
            throw new MailChimpException($exceptionMessage);   
        }
    }
}