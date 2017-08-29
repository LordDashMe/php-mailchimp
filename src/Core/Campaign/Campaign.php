<?php

/**
 * The Campaign Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Core\Campaign;

use LordDashMe\MailChimp\Utilities\Overloader;
use LordDashMe\MailChimp\Core\Campaign\CampaignAdapter;
use LordDashMe\MailChimp\Contract\Campaign\Campaign as CampaignInterface;

class Campaign extends Overloader implements CampaignInterface
{
	/**
     * The object class context field representing the campaign adapter class.
     *
     * @var LordDashMe\MailChimp\Core\Campaign\CampaignAdapter
     */
    protected $objectClass;

    /**
     * The campaign class constructor.
     *
     * @param  string  $apiKey
     * @param  string  $listId
     *
     * @return void
     */
    public function __construct($apiKey, $listId)
    {
        $this->objectClass = new CampaignAdapter($apiKey, $listId);
    }

    /**
     * The object class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     *
     * @return LordDashMe\MailChimp\Core\Campaign\CampaignAdapter
     */
    public function objectClass()
    {
        return $this->objectClass;
    }

    /**
     * The static class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     *
     * @return LordDashMe\MailChimp\Core\Campaign\CampaignFacade
     */
    public static function staticClass()
    {
        return 'LordDashMe\MailChimp\Core\Campaign\CampaignFacade';   
    }	
}