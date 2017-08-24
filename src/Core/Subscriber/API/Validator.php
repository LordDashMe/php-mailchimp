<?php

/**
 * The Subscriber Validator Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber\API;

use LordDashMe\MailChimp\Exception\SubscriberException;

class Validator 
{
	/**
	 * Check if the required fields for the Subscriber API is not violated.
	 *
	 * @param  json  $data
	 *
	 * @return void | LordDashMe\MailChimp\Exception\SubscriberException
	 */
	public static function requiredFields($className, $data)
	{
		$data_decoded = json_decode($data, true);
		
		$top_layer = (
			isset($data_decoded['email_address']) && 
			isset($data_decoded['status']) && 
			isset($data_decoded['merge_fields'])
		);
		
		if ($top_layer) {

			$bottom_layer = (
				isset($data_decoded['merge_fields']['FNAME']) && 
				isset($data_decoded['merge_fields']['LNAME']) && 
				isset($data_decoded['merge_fields']['BIRTHDAY'])
			);

			if ($bottom_layer) {
				return;
			}
		}

		throw new SubscriberException(json_encode([
				'response' => [
					'locate_in' => $className,
					'error_message' => 'Some required fields for Subscriber fields is not set! please check double check the data.',
				],
				'header' => [
					'http_code' => '500',
				]
			])
		);
	}

	protected static function topLayerFields($data_decoded)
	{
		return isset($data_decoded['email_address']) && isset($data_decoded['status']) && isset($data_decoded['merge_fields']);
	}
}