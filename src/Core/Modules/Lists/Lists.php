<?php

namespace PHPMailChimp\Core\Modules\Lists;

use PHPMailChimp\Core\Base\MailChimp;
use PHPMailChimp\Core\Modules\Lists\ListsManager;
use PHPMailChimp\Core\Modules\Lists\ListsService;

/**
 * The Lists Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class Lists extends MailChimp
{
    /**
     * {@inheritdoc}
     */
    protected function module($headers)
    {
        return new ListsManager($headers, new ListsService());
    }
}