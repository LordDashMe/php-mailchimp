<?php

/**
 * The Campaign Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign;

use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\Campaign\API\CampaignService as CampaignServiceInterface;

class CampaignManager extends MailChimpManagerAbstract
{
    /**
     * The campaign manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\Campaign\API\CampaignService  $instance
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(CampaignServiceInterface $instance, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($instance)
             ->setMailChimpHeaders($headers);
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
        $instance = $this->validateMailChimpArguments($closure, $this->getMailChimpService());
        $instance = $this->prepareMailChimpHeaders($instance);
        $instance = $this->resourceId($instance, $campaignId);

        return $instance->content();
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
        $instance = $this->getMailChimpService(); 
        $instance = $this->prepareMailChimpHeaders($instance);
        $instance = $this->resourceId($instance, $campaignId);
        
        return $instance->send();  
    }

    /**
     * The resource id for the current instance.
     *
     * @param  mixed  $instance
     * @param  int    $resourceId
     *
     * @return mixed
     */
    protected function resourceId($instance, $resourceId) 
    { 
        $instance->campaignId = $resourceId;

        return $instance; 
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  mixed  $instance
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