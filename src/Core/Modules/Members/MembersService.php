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

use PHPMailChimp\Core\Base\MailChimpService;

/**
 * The Members Service Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MembersService extends MailChimpService
{
    /**
     * {@inheritdoc}
     */
    protected function baseEndpoint()
    {
        return "lists/{$this->mutatorBag['request_path_parameters']['list_id']}/members/"; 
    }

    /**
     * {@inheritdoc}
     */
    protected function baseResouceId()
    {
        return md5(mb_strtolower($this->mutatorBag['request_path_parameters']['email_address']));
    }

    /**
     * {@inheritdoc}
     */
    protected function baseResources()
    {
        return json_encode($this->mutatorBag['request_body_parameters']);
    }
}