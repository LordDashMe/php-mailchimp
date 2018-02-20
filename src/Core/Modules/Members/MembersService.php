<?php

namespace PHPMailChimp\Core\Modules\Members;

use PHPMailChimp\Core\Base\MailChimpService;
use PHPMailChimp\Contracts\Modules\Members\MembersService as MembersServiceInterface;

/**
 * The Members Service Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class MembersService extends MailChimpService implements MembersServiceInterface
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