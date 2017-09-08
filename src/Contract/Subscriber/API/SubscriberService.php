<?php

/**
 * The Subscriber Service Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 25, 2017
 */

namespace LordDashMe\MailChimp\Contract\Subscriber\API;

use LordDashMe\MailChimp\Contract\MailChimpServiceAbstract;

interface SubscriberService extends MailChimpServiceAbstract
{
    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp.
     *
     * @return json
     */
    public function createOrUpdate();
}