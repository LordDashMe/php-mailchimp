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
 * Invalid Argument Passed Exception Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class InvalidArgumentPassed extends MailChimp
{
    const ERROR_CODE_UNRESOLVED_IS_NOT_ARRAY_OR_CLOSURE_TYPE = 100;

    public static function isNotArrayOrClosure($message = '', $code = null, $previous = null)
    {
        $message = 'The given argument not match the required array or closure type.';

        return new static($message, self::ERROR_CODE_UNRESOLVED_IS_NOT_ARRAY_OR_CLOSURE_TYPE, $previous);
    }
}