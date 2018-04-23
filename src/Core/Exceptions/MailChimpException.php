<?php

namespace PHPMailChimp\Core\Exceptions;

/**
 * The MailChimp Exception Class.
 *
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimpException extends \Exception 
{
    const REGISTER_MODULE_NOT_SET = 101;
    const MODULE_HEADERS_NOT_SET = 102;
    const HEADERS_REQUIRED_NOT_SET = 103;

    public static function cannotResolveRegisterModuleMethod($message = '', $code = null, $previous = null)
    {
        $message = 'Cannot resolve the register module method.';

        return new static($message, static::REGISTER_MODULE_NOT_SET, $previous);
    }

    public static function cannotResolveModuleHeaders($message = '', $code = null, $previous = null)
    {
        $message = 'Cannot resolve the module headers, use array to provide the required headers.';

        return new static($message, static::MODULE_HEADERS_NOT_SET, $previous);  
    }

    public static function cannotResolveHeadersResources($message = '', $code = null, $previous = null)
    {
        $message = 'The required header fields not set. (The required fields is apiKey).';

        return new static($message, static::HEADERS_REQUIRED_NOT_SET, $previous);  
    }
}