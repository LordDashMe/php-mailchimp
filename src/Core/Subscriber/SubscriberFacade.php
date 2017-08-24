<?php

/**
 * The Subscriber Facade Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber;

use LordDashMe\MailChimp\Core\Subscriber\SubscriberManager;
use LordDashMe\MailChimp\Core\Subscriber\API\Create as CreateSubscriber;

class SubscriberFacade
{
	public static function create($apiKey, $listId, $data)
	{
		$manager = new SubscriberManager($apiKey, $listId, $data);
		
		return $manager->create(new CreateSubscriber());
	}

	public static function update()
	{
		// 
	}

	public static function createOrUpdate()
	{
		// 
	}
}