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
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return $this
     */
    public function setMailChimpHeaders($apiKey, $listId)
    {
        $this->mailChimpHeaders['apiKey'] = $apiKey;
        $this->mailChimpHeaders['listId'] = $listId;

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
        $instance->apiKey = $this->getMailChimpHeaders()['apiKey'];
        $instance->listId = $this->getMailChimpHeaders()['listId'];

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
            $this->validateMailChimpPrimaryMergeFields($instance);
        } catch (MailChimpException $e) {
            echo $e->getError(); exit;
        }

        $instance = $this->convertToMailChimpFields($instance);

        return $this->removeUnusedMailChimpFields($instance);
    }

    /**
     * Noop method, check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     *  we just validate first for the application side for the speed purpose.
     *
     * @param  instance|class  $instance
     *
     * @return void|throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateMailChimpPrimaryMergeFields($instance) {}

    /**
     * Noop method, this will convert the given fields into MailChimp primary field design
     *  for more info regarding for the schema.
     * @see http://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/
     *
     * @param  instance|class  $instance
     * 
     * @return instance|class
     */
    protected function convertToMailChimpFields($instance) {}

    /**
     * Noop method, remove the unused class fields in the current objects.
     * This fields will be unused after the conversion of mail chimp primary fields.
     *
     * @param  instance|class  $instance
     *
     * @return instance|class
     */
    protected function removeUnusedMailChimpFields($instance) {}
}