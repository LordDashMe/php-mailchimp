<?php

namespace PHPMailChimp\Core\Modules\Members;

use PHPMailChimp\Core\Base\MailChimpManager;
use PHPMailChimp\Core\Modules\Members\MembersService;
use PHPMailChimp\Contracts\Modules\Members\MembersService as MembersServiceInterface;

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
    protected function registerModule()
    {
        return static::bindings(new MembersService);
    }

    /**
     * The contract between the manager and service for the module.
     *
     * @param  PHPMailChimp\Contracts\Modules\Members\MembersService $service
     *
     * @return mixed
     */
    public function bindings(MembersServiceInterface $service)
    {
        return $service;
    }
}