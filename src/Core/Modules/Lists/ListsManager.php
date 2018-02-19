<?php

namespace PHPMailChimp\Core\Modules\Lists;

use PHPMailChimp\Core\Base\MailChimpManager;
use PHPMailChimp\Exceptions\MailChimpException;
use PHPMailChimp\Contracts\Modules\Lists\ListsService as ListsServiceInterface;

/**
 * The Lists Manager Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class ListsManager extends MailChimpManager
{
    /**
     * {@inheritdoc}
     */
    public function __construct($headers, ListsServiceInterface $service)
    {
        parent::__construct($headers, $service);
    }
}