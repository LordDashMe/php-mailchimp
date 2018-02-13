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
     * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService  $service
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(SubscriberServiceInterface $service, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($service)
             ->setMailChimpHeaders($headers);
    }

    /**
     * Check the subscriber headers if the required fields are already set.
     *
     * @param  array  $headers
     * 
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     *
     * @return void
     */
    protected function validateHeaders($headers)
    {
        if (! isset($headers['apiKey']) || ! isset($headers['listId'])) {
            throw new MailChimpException(
                'The required header fields not set. (The required fields are apiKey & listId)'
            );
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
        $service = $this->resourceId(
            $this->prepareMailChimpFields(
                $this->prepareMailChimpHeaders(
                    $this->validateMailChimpArguments($closure, $this->getMailChimpService())
                )
            ), $email
        );

        return $service->createOrUpdate();
    }

    /**
     * The resource id for the current service.
     *
     * @param  mixed  $service
     * @param  int    $resourceId
     *
     * @return mixed
     */
    protected function resourceId($service, $resourceId) 
    { 
        $service->memberId = $this->convertToMemberId($resourceId);

        return $service; 
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
     * @param  mixed  $service
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     *
     * @return void
     */
    protected function validateMailChimpRequiredFields($service)
    {
        $required = (
            ! isset($service->subscriber_email) ||
            ! isset($service->subscriber_status) ||
            ! isset($service->subscriber_firstname) || 
            ! isset($service->subscriber_lastname) || 
            ! isset($service->subscriber_birthday)
        );

        if ($required) {
            throw new MailChimpException(
                'The mailchimp subscriber primary field(s) not set in the closure.'
            );
        }
    }

    /**
     * This will convert the given fields into MailChimp primary field design
     * for more info regarding for the schema.
     *
     * @see http://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/
     *
     * @param  mixed  $service
     * 
     * @return mixed
     */
    protected function convertToMailChimpFields($service)
    {
        $service->email_address = $service->subscriber_email;
        $service->status = $service->subscriber_status;

        $service->merge_fields = [
            'FNAME'    => $service->subscriber_firstname,
            'LNAME'    => $service->subscriber_lastname,
            'BIRTHDAY' => $service->subscriber_birthday,
        ];

        return $service;
    }

    /**
     * Remove the unused class fields in the current objects.
     * This fields will be unused after the conversion of mail chimp primary fields.
     *
     * @param  mixed  $service
     *
     * @return mixed
     */
    protected function removeUnusedMailChimpFields($service)
    {
        unset($service->subscriber_email);
        unset($service->subscriber_status);
        unset($service->subscriber_firstname);
        unset($service->subscriber_lastname);
        unset($service->subscriber_birthday);

        return $service;
    }
}