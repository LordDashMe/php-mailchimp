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
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(CampaignServiceInterface $campaignService, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($campaignService)
             ->setMailChimpHeaders($headers);
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
        $campaignService = $this->prepareMailChimpHeaders($campaignService);

        $campaignService->campaignId = $campaignId;

        return $campaignService->show();
    }

    /**
     * The create method for the campaign.
     *
     * @param  function  $closure
     *
     * @return json
     */
    public function create($closure)
    {
        $campaignService = $this->getMailChimpService();

        $campaignService = $this->prepareMailChimpHeaders($closure($campaignService));
        $campaignService = $this->prepareMailChimpFields($campaignService);

        return $campaignService->create();
    }

    /**
     * The update method for the campaign.
     *
     * @param  string    $campaignId
     * @param  function  $closure
     *
     * @return json
     */
    public function update($campaignId, $closure)
    {
        $campaignService = $this->getMailChimpService();
        $campaignService = $this->prepareMailChimpHeaders($closure($campaignService));

        $campaignService->campaignId = $campaignId;
        $campaignService = $this->prepareMailChimpFields($campaignService);

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
        $campaignService = $this->prepareMailChimpHeaders($campaignService);

        $campaignService->campaignId = $campaignId;

        return $campaignService->delete();
    }

    /**
     * The content method for the campaign.
     *
     * @param  string    $campaignId
     * @param  function  $closure
     *
     * @return json
     */
    public function content($campaignId, $closure)
    {
        $campaignService = $this->getMailChimpService();
        $campaignService = $this->prepareMailChimpHeaders($closure($campaignService));

        $campaignService->campaignId = $campaignId;

        return $campaignService->content();
    }

    /**
     * The send action method for the campaign.
     *
     * @param  string  $camapaignId
     *
     * @return json
     */
    public function send($campaignId)
    {
        $campaignService = $this->getMailChimpService(); 

        $campaignService->campaignId = $campaignId;
        $campaignService = $this->prepareMailChimpHeaders($campaignService);

        return $campaignService->send();  
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  instance|class  $instance
     *
     * @return void
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateMailChimpRequiredFields($instance)
    {
        $required = (
            ! isset($instance->recipients) ||
            ! isset($instance->settings)
        );

        if ($required) {
            throw new MailChimpException('The mailchimp campaign primary field(s) not set in the closure.');
        }  
    }
}