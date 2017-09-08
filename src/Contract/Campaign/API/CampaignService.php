<?php

/**
 * The Campaign Service Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Contract\Campaign\API;

use LordDashMe\MailChimp\Contract\MailChimpServiceAbstract;

interface CampaignService extends MailChimpServiceAbstract
{
    /**
     * Execute put method in the given url, this will add content in
     * the campaign selected.
     *
     * @return json
     */
    public function content();

    /**
     * Execute post method in the given url, this will send the campaign in
     * the specified list of members.
     *
     * @return json
     */
    public function send();
}