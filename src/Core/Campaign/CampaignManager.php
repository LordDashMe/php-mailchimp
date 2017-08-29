<?php

/**
 * The Campaign Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign;

use LordDashMe\MailChimp\Exception\CampaignException;
use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\Campaign\API\CampaignService as CampaignServiceInterface;

class CampaignManager extends MailChimpManagerAbstract
{
	/**
     * The campaign manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\Campaign\API\CampaignService  $campaignService
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return void
     */
    public function __construct(CampaignServiceInterface $campaignService, $apiKey, $listId)
    {
        $this->setMailChimpService($campaignService)
             ->setMailChimpHeaders($apiKey, $listId);
    }

	/**
     * The read all records method for the campaign list.
     *
     * @return json
     */
    public function showAll()
    {
        $campaignService = $this->getMailChimpService();

        $campaignService = $this->prepareMailChimpHeaders($campaignService);

        return $campaignService->showAll();
    }

    /**
     * The read specific record method for the campaign list.
     *
     * @param  string  $campaignId
     *
     * @return json
     */
    public function show($campaignId)
    {
        $campaignService = $this->getMailChimpService();

        $campaignService->campaignId = $campaignId;
        $campaignService = $this->prepareMailChimpHeaders($campaignService);

        return $campaignService->show();
    }

    /**
     * The create method for the campaign.
     *
     * @return json
     */
    public function create()
    {
        $campaignService = $this->getMailChimpService();

        $campaignService = $this->prepareMailChimpHeaders($campaignService);
        $campaignService = $this->prepareCampaignFields($campaignService);

        return $campaignService->create();
    }

    /**
     * The update method for the campaign.
     *
     * @param  string  $campaignId
     *
     * @return json
     */
    public function update($campaignId)
    {
        $campaignService = $this->getMailChimpService();

        $campaignService->campaignId = $campaignId;
        $campaignService = $this->prepareMailChimpHeaders($campaignService);
        $campaignService = $this->prepareCampaignFields($campaignService);

        return $campaignService->update();
    }

    /**
     * The delete method for the campaign.
     *
     * @param  string  $campaignId
     *
     * @return json
     */
    public function delete($campaignId)
    {
        $campaignService = $this->getMailChimpService();

        $campaignService->campaignId = $campaignId;
        $campaignService = $this->prepareMailChimpHeaders($campaignService);

        return $campaignService->delete();
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     *  we just validate first for the application side for the speed purpose.
     *
     * @param  instance|class  $instance
     *
     * @return void|throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateMailChimpPrimaryMergeFields($instance)
    {
        
    }

    /**
     * This will convert the given fields into MailChimp primary field design
     *  for more info regarding for the schema.
     * @see http://developer.mailchimp.com/documentation/mailchimp/reference/campaigns/
     *
     * @param  instance|class  $instance
     * 
     * @return instance|class
     */
    protected function convertToMailChimpFields($instance)
    {
        
    }

    /**
     * Remove the unused class fields in the current objects.
     * This fields will be unused after the conversion of mail chimp primary fields.
     *
     * @param  instance|class  $instance
     *
     * @return instance|class
     */
    protected function removeUnusedMailChimpFields($instance)
    {
        
    }
}