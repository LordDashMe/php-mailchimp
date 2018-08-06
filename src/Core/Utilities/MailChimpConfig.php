<?php

/*
 * This file is part of the PHP MailChimp.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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