<?php

/*
 * This file is part of the PHP MailChimp.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPMailChimp\Core\Modules\Members;

use PHPMailChimp\Core\Base\MailChimpManager;
use PHPMailChimp\Core\Modules\Members\MembersService;

/**
 * The Members Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Members extends MailChimpManager
{
    /**
     * {@inheritdoc}
     */
    public function registerModule()
    {
        return new MembersService();
    }
}