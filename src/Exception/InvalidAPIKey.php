<?php

/*
 * This file is part of the MailChimp.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\MailChimp\Exception;

use LordDashMe\MailChimp\Exception\MailChimp;

/**
 * Invalid API Key Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class InvalidAPIKey extends MailChimp
{
    const ERROR_CODE_UNRESOLVED_IS_EMPTY = 100;

    public static function isEmpty($message = '', $code = null, $previous = null)
    {
        $message = 'The api key header is empty. Please provide the api key in the class initialization process.';

        return new static($message, self::ERROR_CODE_UNRESOLVED_IS_EMPTY, $previous);
    }
}