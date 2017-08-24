<?php

/**
 * The Subscriber Url Base Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Core\Subscriber\API;

class Url
{
	/**
	 * The primary url for subscriber api.
	 *
	 * @param  string  $apiKey
	 * @param  string  $lisdId
	 *
	 * @return string
	 */
	public static function parse($apiKey, $listId)
	{
		$dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);

		return "https://{$dataCenter}.api.mailchimp.com/3.0/lists/{$listId}"; 
	}
}