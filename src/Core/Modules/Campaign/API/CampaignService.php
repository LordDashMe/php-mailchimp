<?php

/**
 * The Campaign Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign\API;

use LordDashMe\MailChimp\Core\MailChimpServiceAbstract;
use LordDashMe\MailChimp\Contract\Campaign\API\CampaignService as CampaignServiceInterface;

class CampaignService extends MailChimpServiceAbstract implements CampaignServiceInterface
{
    /**
     * Execute put method in the given url, this will add content in
     * the campaign selected.
     *
     * @return json
     */
    public function content()
    {
        $resourceId = $this->baseResouceId();

        return (new Curl($this->baseApiKey(), $this->baseEndpoint() . "/{$resourceId}/content", 'PUT', $this->baseResources()))->execute();
    }

    /**
     * Execute post method in the given url, this will send the campaign in
     * the specified list of members.
     *
     * @return json
     */
    public function send()
    {
        $resourceId = $this->baseResouceId();

        return (new Curl($this->baseApiKey(), $this->baseEndpoint() . "/{$resourceId}/actions/send", 'POST'))->execute();  
    }

    /**
     * The base resource id for the endpoit.
     *
     * @return int
     */
    protected function baseResouceId() 
    {
        return $this->mutatorBag['campaignId'];
    }

    /**
     * The campaign create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $mailchimpApiHost = $this->resolveHostUrl();

        return "{$mailchimpApiHost}/campaigns"; 
    }

    /**
     * This will parse or prepare resources in the dynamic field instance.
     * The purpose of parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function baseResources()
    {
        $mutatorBagCached = $this->mutatorBag;

        unset($mutatorBagCached['apiKey']);

        return json_encode($mutatorBagCached);
    }
}