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
 * Invalid Argument Passed Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class InvalidArgumentPassed extends MailChimpException
{
    const IS_NOT_ARRAY_OR_CLOSURE = 1;

    public static function isNotArrayOrClosure(
        $message = 'The given argument not match the required array or closure type.', 
        $code = self::IS_NOT_ARRAY_OR_CLOSURE, 
        $previous = null
    ) {
        return new static($message, $code, $previous);
    }
}