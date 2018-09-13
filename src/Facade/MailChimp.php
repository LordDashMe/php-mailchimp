<?php

/*
 * This file is part of the MailChimp.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LordDashMe\MailChimp\Facade;

use LordDashMe\StaticClassInterface\Facade;

/**
 * MailChimp Facade Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MailChimp extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getStaticClassAccessor()
    {
        return 'LordDashMe\MailChimp\MailChimp';
    }
}