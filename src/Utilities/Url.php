<?php

/**
 * The Url Utility Class.
 *
 * The settings for Mailchimp URL structure, by
 * declaring in the define constant, example the api version of
 * the url are meant to be change anytime.
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
    public static function resolve($apiKey)
    {
        $host = self::MAILCHIMP_HOST;
        $api = self::MAILCHIMP_API_VER;
        $protocol = self::MAILCHIMP_PROTOCOL;

        $dataCenter = self::getDataCenter($apiKey);

        return "{$protocol}://{$dataCenter}.{$host}/{$api}"; 
    }

    /**
     * Determine the mailchimp api data center.
     *
     * @param  string  $apiKey
     *
     * @return string
     */
    protected static function getDataCenter($apiKey)
    {
        return substr($apiKey, strpos($apiKey, '-') + 1);
    }
}