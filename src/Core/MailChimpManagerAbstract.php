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
     * @var instance|class
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
            echo $e->getResponse(); exit;
        }
    }

    /**
     * The setter method for the mailChimp service field.
     *
     * @param  instance|class  $mailChimpService
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
     * @return instance|class
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
     * Prepare the unique fields for mailchimp.
     *
     * @param  instance|class  $instance
     * 
     * @return instance|class
     */
    protected function prepareMailChimpHeaders($instance)
    {
        foreach ($this->getMailChimpHeaders() as $field => $value) {
            $instance->{$field} = $value;
        }

        return $instance;
    }

    /**
     * Prepare the required or standard fields of mailchimp for subscriber.
     *
     * @param  instance|class  $instance
     * 
     * @return instance|class
     */
    protected function prepareMailChimpFields($instance)
    {
        try {
            $this->validateMailChimpRequiredFields($instance);
        } catch (MailChimpException $e) {
            echo $e->getResponse(); exit;
        }

        return $this->removeUnusedMailChimpFields(
            $this->convertToMailChimpFields($instance)
        );
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
     * @param  instance|class  $instance
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
     * @param  instance|class  $instance
     * 
     * @return instance|class
     */
    protected function convertToMailChimpFields($instance) { return $instance; }

    /**
     * "Noop" method, remove the unused class fields in the current objects.
     * This fields will be unused after the conversion of mail chimp primary fields.
     *
     * @param  instance|class  $instance
     *
     * @return instance|class
     */
    protected function removeUnusedMailChimpFields($instance) { return $instance; }
}