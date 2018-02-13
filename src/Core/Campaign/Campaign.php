<?php

/**
 * The Campaign Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 30, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign;

use LordDashMe\MailChimp\Core\MailChimpAbstract;
use LordDashMe\MailChimp\Core\Campaign\CampaignManager;
use LordDashMe\MailChimp\Core\Campaign\API\CampaignService;

class Campaign extends MailChimpAbstract
{   
    /**
     * The campaign class constructor.
     *
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct($headers = array())
    {
        parent::__construct($headers);
    }

    /**
     * Resolve the service injection for the manager and worker.
     *
     * @return mixed
     */
    protected function concreteService()
    {
        return new CampaignManager(
            new CampaignService(), $this->getHeaders()
        );
    }
}