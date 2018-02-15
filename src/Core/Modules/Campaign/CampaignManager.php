<?php

/**
 * The Campaign Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign;

use LordDashMe\MailChimp\Exception\MailChimpException;
use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\Campaign\API\CampaignService as CampaignServiceInterface;

class CampaignManager extends MailChimpManagerAbstract
{
    /**
     * The campaign manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\Campaign\API\CampaignService  $service
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(CampaignServiceInterface $service, $headers)
    {
        parent::__construct($service, $headers);
    }

    /**
     * The content method for the campaign.
     *
     * @param  string  $campaignId
     * @param  mixed   $closure
     *
     * @return json
     */
    public function content($campaignId, $closure = null)
    {
        $service = $this->resourceId(
            $this->prepareMailChimpHeaders(
                $this->validateMailChimpArguments($closure, $this->getMailChimpService())
            ), $campaignId
        );

        return $service->content();
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
        $service = $this->resourceId(
            $this->prepareMailChimpHeaders(
                $this->getMailChimpService()
            ), $campaignId
        );
        
        return $service->send();  
    }

    /**
     * The resource id for the current service.
     *
     * @param  mixed  $service
     * @param  int    $resourceId
     *
     * @return mixed
     */
    protected function resourceId($service, $resourceId) 
    { 
        $service->campaignId = $resourceId;

        return $service; 
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  mixed  $service
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     * 
     * @return void
     */
    protected function validateMailChimpRequiredFields($service)
    {
        $required = (
            ! isset($service->recipients) ||
            ! isset($service->settings)
        );

        if ($required) {
            throw new MailChimpException(
                'The mailchimp campaign endpoint primary field(s) not set in the closure.'
            );
        }  
    }
}