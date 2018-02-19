<?php

namespace PHPMailChimp\Core\Utilities;

/**
 * The MailChimp Config.
 *
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimpConfig
{
    /**
     * The host protocol used.
     *
     * @var string
     */
    const MAILCHIMP_PROTOCOL = 'https';

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
    const MAILCHIMP_API_VERSION = '3.0';
}