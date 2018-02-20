<?php

namespace PHPMailChimp\Contracts\Utilities;

/**
 * The MailChimp Http Request Interface.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
interface MailChimpHttpRequest
{
    public function execute();
}