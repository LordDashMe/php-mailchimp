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

use LordDashMe\MailChimp\Exception\MailChimpException;

/**
 * Invalid API Key Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class InvalidAPIKey extends MailChimpException
{
    const IS_EMPTY = 1;

    public static function isEmpty(
        $message = 'The api key header is empty. Please provide the api key in the class initialization process.', 
        $code = self::IS_EMPTY, 
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }
}