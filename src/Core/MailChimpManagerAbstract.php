<?php

/**
 * The MailChimp Manager Abstract Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core;

use LordDashMe\MailChimp\Exception\MailChimpException;

abstract class MailChimpManagerAbstract
{
    /**
     * The mailChimp service that manage the interaction in the mailchimp api.
     *
     * @var mixed
     */
    protected $mailChimpService;

    /**
     * The mailChimp header field, it holds the api key and list id.
     *
     * @var array
     */
    protected $mailChimpHeaders;

    /**
     * The mailchimp manager abstract constructor.
     *
     * @param  array  $headers
     *
     * @return void
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    public function __construct($headers)
    {
        try {
            $this->validateHeaders($headers);
        } catch (MailChimpException $e) {
            exit($e->getResponse());
        }
    }

    /**
     * The setter method for the mailChimp service field.
     *
     * @param  mixed  $mailChimpService
     *
     * @return $this
     */
    public function setMailChimpService($mailChimpService)
    {
        $this->mailChimpService = $mailChimpService;

        return $this;
    }

    /**
     * The getter method for the mailChimp service field.
     *
     * @return mixed
     */
    public function getMailChimpService()
    {
        return $this->mailChimpService;
    }

    /**
     * The setter method for the mailChimp headers field.
     *
     * @param  array  $headers
     *
     * @return $this
     */
    public function setMailChimpHeaders($headers)
    {
        foreach ($headers as $field => $value) {
            $this->mailChimpHeaders[$field] = $value;
        }
        
        return $this;
    }

    /**
     * The getter method for the mailChimp header field.
     *
     * @return array
     */
    public function getMailChimpHeaders()
    {
        return $this->mailChimpHeaders;
    }

    /**
     * The read all records method for the campaign list.
     *
     * @param  mixed  $closure
     *
     * @return json
     */
    public function all($closure = null)
    {
        $instance = $this->validateMailChimpArguments($closure, $this->getMailChimpService());
        $instance = $this->prepareMailChimpHeaders($instance);

        return $instance->all();
    }

    /**
     * The read specific record method for the campaign list.
     *
     * @param  string  $resourceId
     * @param  mixed   $closure
     *
     * @return json
     */
    public function find($resourceId, $closure = null)
    {
        $instance = $this->validateMailChimpArguments($closure, $this->getMailChimpService());
        $instance = $this->prepareMailChimpHeaders($instance);
        $instance = $this->resourceId($instance, $resourceId);

        return $instance->find();
    }

    /**
     * The create method for the campaign.
     *
     * @param  mixed  $closure
     *
     * @return json
     */
    public function create($closure = null)
    {
        $instance = $this->validateMailChimpArguments($closure, $this->getMailChimpService());
        $instance = $this->prepareMailChimpFields($this->prepareMailChimpHeaders($instance));

        return $instance->create();
    }

    /**
     * The update method for the campaign.
     *
     * @param  string  $resourceId
     * @param  mixed   $closure
     *
     * @return json
     */
    public function update($resourceId, $closure = null)
    {
        $instance = $this->validateMailChimpArguments($closure, $this->getMailChimpService());
        $instance = $this->prepareMailChimpFields($this->prepareMailChimpHeaders($instance));
        $instance = $this->resourceId($instance, $resourceId);

        return $instance->update();
    }

    /**
     * The delete method for the campaign.
     *
     * @param  string  $resourceId
     *
     * @return json
     */
    public function delete($resourceId)
    {
        $instance = $this->getMailChimpService();
        $instance = $this->prepareMailChimpHeaders($instance);
        $instance = $this->resourceId($instance, $resourceId);

        return $instance->delete();
    }

    /**
     * "Noop" method, the resource id for the current instance.
     *
     * @param  mixed  $instance
     * @param  int    $resourceId
     *
     * @return mixed
     */
    protected function resourceId($instance, $resourceId)  { return $instance; }

    /**
     * Validate the used arguments in the endpoint method.
     *
     * @param  mixed  $args
     * @param  mixed  $class
     *
     * @return mixed
     */
    protected function validateMailChimpArguments($args, $class)
    {
        try {
            return $this->resolveMailChimpArguments($args, $class);
        } catch (MailChimpException $e) {
            exit($e->getResponse());
        }
    }

    /**
     * Resolver for the dynamic endpoint arguments, it can be
     * a closure or a array declaration and if the array is selected
     * it will automatically converted to worker class property.
     *
     * @param  mixed  args
     * @param  mixed  $class
     *
     * @return mixed
     */
    protected function resolveMailChimpArguments($args, $class)
    {
        /**
         * Check if the $args is a closure type
         * then procceed to mutating all the properties.
         */
        if ($args instanceof \Closure) {

            return $args($class);

        /**
         * Check if the $args is an array type 
         * then convert it to closure type
         * to procceed in mutating all the properties 
         * in the selected instance.
         */
        } else if (is_array($args)) {

            foreach ($args as $property => $value) {
                $class->{$property} = $value;
            }

            return $class;

        /**
         * Notify there's no request parameter matches
         * the required type (Closure and Array).
         */
        } else {

            throw new MailChimpException('
                There\'s no request parameter(s) detected. use closure or array 
                to specify the request parameter of the endpoint.     
            ');
        }
    }

    /**
     * Prepare the unique fields for mailchimp.
     *
     * @param  mixed  $instance
     * 
     * @return mixed
     */
    protected function prepareMailChimpHeaders($instance)
    {
        foreach ($this->getMailChimpHeaders() as $property => $value) {
            $instance->{$property} = $value;
        }

        return $instance;
    }

    /**
     * Prepare the required or standard fields of mailchimp for subscriber.
     *
     * @param  mixed  $instance
     * 
     * @return mixed
     */
    protected function prepareMailChimpFields($instance)
    {
        try {
            $this->validateMailChimpRequiredFields($instance);
        } catch (MailChimpException $e) {
            exit($e->getResponse());
        }

        return $this->removeUnusedMailChimpFields($this->convertToMailChimpFields($instance));
    }

    /**
     * Check the subscriber headers if the required fields are already set.
     * This function can be override by the sub-class or inheritor.
     *
     * @param  array  $headers
     *
     * @return void
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateHeaders($headers)
    {
        if (! isset($headers['apiKey'])) {
            throw new MailChimpException('The required header fields not set. (The required fields are apiKey)');
        }  
    }

    /**
     * "Noop" method, check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  mixed  $instance
     *
     * @return void
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateMailChimpRequiredFields($instance) { return $instance; }

    /**
     * "Noop" method, this will convert the given fields into MailChimp primary field design
     * for more info regarding for the schema.
     *
     * @see http://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/
     *
     * @param  mixed  $instance
     * 
     * @return mixed
     */
    protected function convertToMailChimpFields($instance) { return $instance; }

    /**
     * "Noop" method, remove the unused class fields in the current objects.
     * This fields will be unused after the conversion of mail chimp primary fields.
     *
     * @param  mixed  $instance
     *
     * @return mixed
     */
    protected function removeUnusedMailChimpFields($instance) { return $instance; }
}