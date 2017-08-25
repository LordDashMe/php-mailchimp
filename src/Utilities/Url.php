<?php

/**
 * The Url Utility Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 24, 2017
 */

namespace LordDashMe\MailChimp\Utilities;

class Url
{
	/**
	 * The origin host of the mailchimp for api.
	 *
	 * @var string
	 */
	const MAILCHIMP_HOST = 'api.mailchimp.com';

	/**
	 * The version of the mailchimp api.
	 *
	 * @var string
	 */
	const MAILCHIMP_API_VER = '3.0';

	/**
	 * The host protocol used.
	 *
	 * @var string
	 */
	const MAILCHIMP_PROTOCOL = 'https';

	/**
	 * The primary url for subscriber api.
	 *
	 * @param  string  $apiKey
	 *
	 * @return string
	 */
	public static function parse($apiKey)
	{
		$dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);

		return Url::MAILCHIMP_PROTOCOL . "://{$dataCenter}." . Url::MAILCHIMP_HOST . '/' . Url::MAILCHIMP_API_VER; 
	}
}