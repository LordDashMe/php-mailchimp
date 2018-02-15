<?php

namespace PHPMailChimp\Core\Base;

use PHPMailChimp\Core\Exceptions\MailChimpException;

/**
 * The MailChimp Manager Abstract Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
abstract class MailChimpManagerAbstract
{
    /**
     * The request header, it holds the api key and etc.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * The service that manage the interaction to the mailchimp api.
     *
     * @var mixed
     */
    protected $serviceContext;

    /**
     * The mailchimp manager abstract constructor.
     *
     * @param  array  $headers
     * @param  mixed  $serviceContext
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    public function __construct($headers, $serviceContext)
    {
        try {
            $this->validateHeaders($headers);
        } catch (MailChimpException $e) {
            exit($e->getMessage());
        }

        $this->setHeaders($headers)
             ->setService($serviceContext);
    }

    /**
     * (No-op method)
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
            throw new MailChimpException(
                'The required header fields not set. (The required fields is apiKey)'
            );
        }
    }

    /**
     * The setter method for the mailchimp service field.
     *
     * @param  mixed  $serviceContext
     *
     * @return $this
     */
    public function setService($serviceContext)
    {
        $this->serviceContext = $serviceContext;

        return $this;
    }

    /**
     * The getter method for the mailchimp service field.
     *
     * @return mixed
     */
    public function getService()
    {
        return $this->serviceContext;
    }

    /**
     * The setter method for the mailChimp headers field.
     *
     * @param  array  $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        foreach ($headers as $key => $value) {
            $this->headers[$key] = $value;
        }
        
        return $this;
    }

    /**
     * The getter method for the mailChimp header field.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Dynamic call of mailchimp service.
     * 
     * @param  string  $method
     * @param  array   $args
     * 
     * @return json
     */
    public function __call($method, $args)
    {
        $this->requestStructure(...$args);

        switch ($method) {
            
            case 'all':
            case 'find':
            case 'delete':

                $serviceContext = $this->validateRequestPathParameters(
                    $this->getService()
                );

                if ($method == 'all') {
                    return $serviceContext->all();
                } else if ($method == 'find') {
                    return $serviceContext->find();
                } else if ($method == 'delete') {
                    return $serviceContext->delete();
                }

                break;

            case 'create':
            case 'update':

                $serviceContext = $this->removeRequestBodyParameters(
                    $this->modifyRequestBodyParameters(
                        $this->validateRequestBodyParameters($this->getService())
                    )
                );

                if ($method == 'create') {
                    return $serviceContext->create();
                } else if ($method == 'update') {
                    return $serviceContext->update();
                }

                break;
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
    protected function requestStructure($requestPathParameters, $requestBodyParameters)
    {
        $this->requestHeaders()
             ->requestPathParameters($requestPathParameters)
             ->requestBodyParameters($requestBodyParameters);
             
        return $this;  
    }

    /**
     * Headers for the request.
     * 
     * @return $this
     */
    protected function requestHeaders()
    {
        $serviceContext = $this->getService();

        foreach ($this->getMailChimpHeaders() as $property => $value) {
            $serviceContext->{'request_headers'}[$property] = $value;
        }

        $this->setService($serviceContext);

        return $this;
    }

    /**
     * Path parameters for the request.
     *
     * @return $this
     */
    protected function requestPathParameters($args)
    {
        $this->argsParametersConverter($args, 'request_path_parameters', 
            'There\'s no request path parameter(s) detected. use closure or array 
                to specify the request body parameter of the endpoint.'
        );

        return $this;
    }

    /**
     * (No-op method)
     *
     * Check if the request path parameters pass the validation rules.
     *
     * @param  mixed  $serviceContext
     *
     * @return mixed
     */
    protected function validateRequestPathParameters($serviceContext)
    {
        return $serviceContext;
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
        $this->argsParametersConverter($args, 'request_body_parameters', 
            'There\'s no request body parameter(s) detected. use closure or array 
                to specify the request body parameter of the endpoint.'
        );

        return $this; 
    }

    protected function argsParametersConverter($args, $parameterType, $exceptionMessage)
    {
        $serviceContext = $this->getService();

        if ($args || is_array($args)) {

            /**
             * Check if the $args is a closure type convert into array form
             * then procceed to mutating all the properties.
             */
            if ($args instanceof \Closure) {
                $object = (object) [];
                $args = (array) $args($object);  
            }

            foreach ($args as $property => $value) {
                $serviceContext->{$parameterType}[$property] = $value;
            }

        /**
         * Notify there's no request parameter matches
         * the required type (Closure and Array).
         */
        } else {

            throw new MailChimpException($exceptionMessage);
        }

        $this->setService($serviceContext);
    }

    /**
     * (No-op method)
     * 
     * Check if the primary fields of MailChimp are available in the current service context.
     *
     * @param  mixed  $serviceContext
     *
     * @throws PHPMailChimp\Core\Exceptions\MailChimpException
     *
     * @return mixed
     */
    protected function validateRequestBodyParameters($serviceContext) 
    { 
        return $serviceContext; 
    }

    /**
     * (No-op method)
     *
     * Add class field(s) in the current service context.
     *
     * @param  mixed  $serviceContext
     * 
     * @return mixed
     */
    protected function modifyRequestBodyParameters($serviceContext) 
    { 
        return $serviceContext; 
    }

    /**
     * (No-op method)
     * 
     * Remove class field(s) in the current service context.
     *
     * @param  mixed  $serviceContext
     *
     * @return mixed
     */
    protected function removeRequestBodyParameters($serviceContext) 
    { 
        return $serviceContext; 
    }
}