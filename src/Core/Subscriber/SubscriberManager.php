<?php

/**
 * The Subscriber Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Core\Subscriber\SubscriberAbstract;
use LordDashMe\MailChimp\Contract\Subscriber\API\Create as CreateSubscriberInterface;
use LordDashMe\MailChimp\Contract\Subscriber\API\Update as UpdateSubscriberInterface;
use LordDashMe\MailChimp\Contract\Subscriber\API\CreateOrUpdate as CreateOrUpdateInterface;

class SubscriberManager extends SubscriberAbstract
{
	/**
	 * The class constructor.
	 *
	 * @param  string  $apiKey
	 * @param  string  $listId
	 * @param  string  $url
	 * @param  json    $data
	 *
	 * @return void
	 */
	public function __construct($apiKey, $listId, $data)
	{
		$this->setApiKey($apiKey)
		     ->setListId($listId)
		     ->setData($data);
	}

	/**
	 * The create class for the subscriber.
	 *
	 * @param  \LordDashMe\MailChimp\Contract\Subscriber\API\Create  $createSubscriber
	 *
	 * @return json
	 */
	public function create(CreateSubscriberInterface $createSubscriber)
	{
		return $createSubscriber->execute(
			$this->getApiKey(),
			$this->getListId(),
			$this->getData()
		);
	}

	public function update(UpdateSubscriberInterface $updateSubscriber)
	{
		// 
	}

	public function createOrUpdate(CreateOrUpdateInterface $createOrUpdateSubscriber)
	{
		// 
	}
}