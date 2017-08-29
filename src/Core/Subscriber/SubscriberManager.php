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
     * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService  $subscriberService
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return void
     */
    public function __construct(SubscriberServiceInterface $subscriberService, $apiKey, $listId)
    {
        $this->setMailChimpService($subscriberService)
             ->setMailChimpHeaders($apiKey, $listId);
    }

    /**
     * The read all records method for the subscriber list.
     *
     * @return json
     */
    public function showAll()
    {
        $subscriberService = $this->getMailChimpService();
        $subscriberService = $this->prepareMailChimpHeaders($subscriberService);

        return $subscriberService->showAll();
    }

    /**
     * The read specific record method for the subscriber list.
     *
     * @param  string  $email
     *
     * @return json
     */
    public function show($email)
    {
        $subscriberService = $this->getMailChimpService();
        $subscriberService = $this->prepareMailChimpHeaders($subscriberService);

        $subscriberService->memberId = $this->convertToMemberId($email);
        
        return $subscriberService->show();
    }

    /**
     * The create method for the subscriber.
     *
     * @return json
     */
    public function create()
    {
        $subscriberService = $this->getMailChimpService();
        $subscriberService = $this->prepareMailChimpHeaders($subscriberService);

        $subscriberService = $this->prepareMailChimpFields($subscriberService);

        return $subscriberService->create();
    }

    /**
     * The update method for the subscriber.
     *
     * @param  string  $email
     *
     * @return json
     */
    public function update($email)
    {
        $subscriberService = $this->getMailChimpService();
        $subscriberService = $this->prepareMailChimpHeaders($subscriberService);

        $subscriberService->memberId = $this->convertToMemberId($email);
        $subscriberService = $this->prepareMailChimpFields($subscriberService);

        return $subscriberService->update();
    }

    /**
     * The delete method for the subscriber.
     *
     * @param  string  $email
     *
     * @return json
     */
    public function delete($email)
    {
        $subscriberService = $this->getMailChimpService();
        $subscriberService = $this->prepareMailChimpHeaders($subscriberService);

        $subscriberService->memberId = $this->convertToMemberId($email);

        return $subscriberService->delete();
    }

    /**
     * The create or update method for the subscriber.
     *
     * @param  string  $email
     *
     * @return json
     */
    public function createOrUpdate($email)
    {
        $subscriberService = $this->getMailChimpService();
        $subscriberService = $this->prepareMailChimpHeaders($subscriberService);

        $subscriberService->memberId = $this->convertToMemberId($email);
        $subscriberService = $this->prepareMailChimpFields($subscriberService);

        return $subscriberService->createOrUpdate();
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
     *  we just validate first for the application side for the speed purpose.
     *
     * @param  instance|class  $instance
     *
     * @return void|throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateMailChimpPrimaryMergeFields($instance)
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
     *  for more info regarding for the schema.
     * @see http://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/
     *
     * @param  instance|class  $instance
     * 
     * @return instance|class
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
     * @param  instance|class  $instance
     *
     * @return instance|class
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