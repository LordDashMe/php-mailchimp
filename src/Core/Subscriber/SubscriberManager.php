<?php

/**
 * The Subscriber Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Exception\SubscriberException;
use LordDashMe\MailChimp\Core\Subscriber\SubscriberAbstract;
use LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService as SubscriberServiceInterface;

class SubscriberManager extends SubscriberAbstract
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
		$this->setSubscriberService($subscriberService)
		     ->setApiKey($apiKey)
		     ->setListId($listId);
	}

	/**
	 * The create method for the subscriber.
	 *
	 * @return json
	 */
	public function create()
	{
		$subscriberService = $this->getSubscriberService();

		$subscriberService = $this->setMailChimpSubscriberHeaders($subscriberService);
		$subscriberService = $this->setMailChimpSubscriberFields($subscriberService);

		return $subscriberService->create();
	}

	/**
	 * The update method for the subscriber.
	 *
	 * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService  $subscriberService
	 * @param  string  $email
	 *
	 * @return json
	 */
	public function update($email)
	{
		$subscriberService = $this->getSubscriberService();

		$subscriberService->memberId = $this->convertToMailChimpMemberId($email);

		$subscriberService = $this->setMailChimpSubscriberHeaders($subscriberService);
		$subscriberService = $this->setMailChimpSubscriberFields($subscriberService);

		return $subscriberService->update();
	}

	/**
	 * The delete method for the subscriber.
	 *
	 * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService  $subscriberService
	 *
	 * @return json
	 */
	public function delete($email)
	{
		$subscriberService = $this->getSubscriberService();

		$subscriberService->memberId = $this->convertToMailChimpMemberId($email);

		$subscriberService = $this->setMailChimpSubscriberHeaders($subscriberService);

		return $subscriberService->delete();
	}

	/**
	 * The create or update method for the subscriber.
	 *
	 * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\SubscriberService  $subscriberService
	 *
	 * @return json
	 */
	public function createOrUpdate($email)
	{
		$subscriberService = $this->getSubscriberService();

		$subscriberService->memberId = $this->convertToMailChimpMemberId($email);

		$subscriberService = $this->setMailChimpSubscriberHeaders($subscriberService);
		$subscriberService = $this->setMailChimpSubscriberFields($subscriberService);

		return $subscriberService->createOrUpdate();
	}

	/**
	 * The email will convert to MailChimp equivalent member ID.
	 *
	 * @param  string  $email
	 *
	 * @return string
	 */
	protected function convertToMailChimpMemberId($email)
	{
		return md5(strtolower($email));
	}

	/**
	 * Set the unique fields for mailchimp.
	 *
	 * @param  instance|class  $instance
	 * 
	 * @return instance|class
	 */
	protected function setMailChimpSubscriberHeaders($instance)
	{
		$instance->apiKey = $this->getApiKey();
		$instance->listId = $this->getListId();

		return $instance;
	}

	/**
	 * Set the required or standard fields of mailchimp for subscriber.
	 *
	 * @param  instance|class  $instance
	 * 
	 * @return instance|class
	 */
	protected function setMailChimpSubscriberFields($instance)
	{
		try {
			$this->validateSubscriberPrimaryMergeFields($instance);
		} catch (SubscriberException $e) {
			echo $e->getError(); exit;
		}

		$instance = $this->convertToMailChimpSubscriberFields($instance);

		return $this->removeUnusedSubscriberFields($instance);
	}

	/**
	 * Check if the primary fields of MailChimp are setted in the closure.
	 *
	 * @param  instance|class  $instance
	 *
	 * @return void|LordDashMe\MailChimp\Exception\SubscriberException
	 */
	protected function validateSubscriberPrimaryMergeFields($instance)
	{
		if (! isset($instance->firstName) || ! isset($instance->lastName) || ! isset($instance->birthday)) {
			throw (new SubscriberException())->undefinedPrimaryFields();
		}
	}

	/**
	 * This will convert the given fields into MailChimp primary field design.
	 * @see http://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/
	 *
	 * @param  instance|class  $instance
	 * 
	 * @return instance|class
	 */
	protected function convertToMailChimpSubscriberFields($instance)
	{
		$instance->resources = json_encode([
			'email_address' => $instance->email,
			'status' 		=> $instance->status,
			'merge_fields' 	=> [
				'FNAME' 	=> $instance->firstName,
				'LNAME' 	=> $instance->lastName,
				'BIRTHDAY' 	=> $instance->birthday,
			]
		]);	

		return $instance;
	}

	/**
	 * Remove the unused class fields in the current objects.
	 *	This fields will be unused after the conversion of mail chimp primary fields.
	 *
	 * @param  instance|class  $instance
	 *
	 * @return instance|class
	 */
	protected function removeUnusedSubscriberFields($instance)
	{
		unset($instance->email);
		unset($instance->status);
		unset($instance->firstName);
		unset($instance->lastName);
		unset($instance->birthday);

		return $instance;
	}
}