<?php

namespace PHPMailChimp\Core;

use PHPMailChimp\Core\MailChimpConfig;

/**
 * The MailChimp Host.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimpHost
{
    /**
     * The primary url for subscriber api.
     *
     * @param  string  $apiKey  The key will only be generated to the user settings.
     *
     * @return string
     */
    public static function resolve($apiKey)
    {
        $dataCenter = self::getDataCenter($apiKey);

        return MailChimpConfig::MAILCHIMP_PROTOCOL . "://{$dataCenter}." . 
               MailChimpConfig::MAILCHIMP_HOST . '/' . 
               MailChimpConfig::MAILCHIMP_API_VERSION; 
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