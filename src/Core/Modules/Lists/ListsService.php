<?php

/*
 * This file is part of the PHP MailChimp.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPMailChimp\Core\Modules\Lists;

use PHPMailChimp\Core\Base\MailChimpService;

/**
 * The Lists Service Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class ListsService extends MailChimpService
{
    /**
     * {@inheritdoc}
     */
    protected function baseEndpoint()
    {
        return 'lists/'; 
    }

    /**
     * {@inheritdoc}
     */
    protected function baseResouceId()
    {
        return $this->mutatorBag['request_path_parameters']['list_id'];
    }

    /**
     * {@inheritdoc}
     */
    protected function baseResources()
    {
        return json_encode($this->mutatorBag['request_body_parameters']);
    }
}