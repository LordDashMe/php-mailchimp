<?php

/**
 * The Subscriber Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Exception\MailChimpException;
use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService as SubscriberServiceInterface;

class SubscriberManager extends MailChimpManagerAbstract
{
    /**
     * The subscriber manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService  $instance
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(SubscriberServiceInterface $instance, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($instance)
             ->setMailChimpHeaders($headers);
    }

    /**
     * Check the subscriber headers if the required fields are already set.
     *
     * @param  array  $headers
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateHeaders($headers)
    {
        if (! isset($headers['apiKey']) || ! isset($headers['listId'])) {
            throw new MailChimpException('The required header fields not set. (The required fields are apiKey & listId)');
        }  
    }

    /**
     * The create or update method for the subscriber.
     *
     * @param  string    $email
     * @param  function  $closure
     *
     * @return json
     */
    public function createOrUpdate($email, $closure = null)
    {
        $instance = $this->validateMailChimpArguments($closure, $this->getMailChimpService());
        $instance = $this->prepareMailChimpFields($this->prepareMailChimpHeaders($instance));
        $instance = $this->resourceId($instance, $email);

        return $instance->createOrUpdate();
    }

    /**
     * The resource id for the current instance.
     *
     * @param  mixed  $instance
     * @param  int    $resourceId
     *
     * @return mixed
     */
    protected function resourceId($instance, $resourceId) 
    { 
        $instance->memberId = $this->convertToMemberId($resourceId);

        return $instance; 
    }

    /**
     * The email will convert to MailChimp equivalent member ID.
     *
     * @param  string  $email
     *
     * @return string
     */
    private function convertToMemberId($email)
    {
        return md5(strtolower($email));
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  mixed  $instance
     *
     * @return void
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateMailChimpRequiredFields($instance)
    {
        $required = (
            ! isset($instance->subscriber_email) ||
            ! isset($instance->subscriber_status) ||
            ! isset($instance->subscriber_firstname) || 
            ! isset($instance->subscriber_lastname) || 
            ! isset($instance->subscriber_birthday)
        );

        if ($required) {
            throw new MailChimpException('The mailchimp subscriber primary field(s) not set in the closure.');
        }
    }

    /**
     * This will convert the given fields into MailChimp primary field design
     * for more info regarding for the schema.
     *
     * @see http://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/
     *
     * @param  mixed  $instance
     * 
     * @return mixed
     */
    protected function convertToMailChimpFields($instance)
    {
        $instance->email_address = $instance->subscriber_email;
        $instance->status = $instance->subscriber_status;

        $instance->merge_fields = [
            'FNAME'    => $instance->subscriber_firstname,
            'LNAME'    => $instance->subscriber_lastname,
            'BIRTHDAY' => $instance->subscriber_birthday,
        ];

        return $instance;
    }

    /**
     * Remove the unused class fields in the current objects.
     * This fields will be unused after the conversion of mail chimp primary fields.
     *
     * @param  mixed  $instance
     *
     * @return mixed
     */
    protected function removeUnusedMailChimpFields($instance)
    {
        unset($instance->subscriber_email);
        unset($instance->subscriber_status);
        unset($instance->subscriber_firstname);
        unset($instance->subscriber_lastname);
        unset($instance->subscriber_birthday);

        return $instance;
    }
}