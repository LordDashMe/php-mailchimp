<?php

namespace PHPMailChimp\Core\Modules\Lists;

use PHPMailChimp\Core\Base\MailChimpManager;
use PHPMailChimp\Core\Modules\Lists\ListsService;
use PHPMailChimp\Contracts\Modules\Lists\ListsService as ListsServiceInterface;

/**
 * The Lists Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Lists extends MailChimpManager
{
    /**
     * {@inheritdoc}
     */
    protected function registerModule()
    {
        return static::bindings(new ListsService);
    }

    /**
     * The contract between the manager and service for the module.
     *
     * @param  PHPMailChimp\Contracts\Modules\Lists\ListsService $service
     *
     * @return mixed
     */
    public function bindings(ListsServiceInterface $service)
    {
        return $service;
    }
}