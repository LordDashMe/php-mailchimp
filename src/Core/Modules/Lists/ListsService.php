<?php

namespace PHPMailChimp\Core\Modules\Lists;

use PHPMailChimp\Core\Base\MailChimpService;
use PHPMailChimp\Contracts\Modules\Lists\ListsService as ListsServiceInterface;

/**
 * The Lists Service Class.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
class ListsService extends MailChimpService implements ListsServiceInterface
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