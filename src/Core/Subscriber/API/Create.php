<?php

/**
 * The Subscriber Create Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber\API;

use LordDashMe\MailChimp\Utilities\Curl;
use LordDashMe\MailChimp\Core\Subscriber\API\Url;
use LordDashMe\MailChimp\Core\Subscriber\API\Validator;
use LordDashMe\MailChimp\Exception\SubscriberException;
use LordDashMe\MailChimp\Contract\Subscriber\API\Create as CreateSubscriberInterface;

class Create implements CreateSubscriberInterface
{
	/**
	 * Execute post method in the given url, this will be the create endpoint for mailchimp
	 *	subscribers.
	 *
	 * @param  string  $url
	 * @param  string  $apiKey
	 * @param  json    $data
	 *
	 * @return json
	 */
	public function execute($apiKey, $listId, $data)
	{
		try {

			Validator::requiredFields('LordDashMe\MailChimp\Contract\Subscriber\API\Create', $data);
			
		} catch (SubscriberException $e) {
			return $e->responseHandler;
		}

		$subscriberUrl = Url::parse($apiKey, $listId);

		$url = "{$subscriberUrl}/members";

		return (new Curl($apiKey, $url, 'POST', $data))->execute();
	}
}