<?php

/**
 * The Campaign Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign\API;

use LordDashMe\MailChimp\Utilities\Url;
use LordDashMe\MailChimp\Utilities\Curl;
use LordDashMe\MailChimp\Utilities\Mutator;
use LordDashMe\MailChimp\Contract\Campaign\API\CampaignService as CampaignServiceInterface;

class CampaignService extends Mutator implements CampaignServiceInterface
{
    /**
     * Execute get method in the given url, this will show all the members 
     *  in the linked list id.
     *
     * @return json
     */
    public function showAll()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'GET'))->execute();
    }

    /**
     * Execute get method in the given url, this will show specific member 
     *  in the linked list id.
     *
     * @return json
     */
    public function show()
    {
        $campaignId = $this->mutatorBag['campaignId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$campaignId}", 'GET'))->execute();
    }

    /**
     * Execute post method in the given url, this will be the 
     *  create/add endpoint for mailchimp campaign.
     *
     * @return json
     */
    public function create()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'POST', $this->prepareResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     *  update/modify endpoint for mailchimp campaign.
     *
     * @return json
     */
    public function update()
    {
        $campaignId = $this->mutatorBag['campaignId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$campaignId}", 'PATCH', $this->prepareResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     *  update/modify endpoint for mailchimp campaign.
     *
     * @return json
     */
    public function delete()
    {
        $campaignId = $this->mutatorBag['campaignId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$campaignId}", 'DELETE'))->execute();
    }

    /**
     * The campaign create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $apiKey = $this->mutatorBag['apiKey'];
        $listId = $this->mutatorBag['listId'];

        $mailchimpApiHost = Url::parse($apiKey);

        return "{$mailchimpApiHost}/campaigns"; 
    }

    /**
     * This will parse or prepare resources in the dynamic field instance.
     * The purpose of parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function prepareResources()
    {
        $mutatorBagCached = $this->mutatorBag;

        unset($mutatorBagCached['apiKey']);
        unset($mutatorBagCached['listId']);

        return json_encode($mutatorBagCached);
    }
}