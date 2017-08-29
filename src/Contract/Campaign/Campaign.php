<?php

/**
 * The Campaign Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Contract\Campaign;

interface Campaign 
{
    /**
     * The object class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     * This will be added functionality for the overloader utility class.
     *
     * @return LordDashMe\MailChimp\Core\Campaign\CampaignAdapter
     */
    public function objectClass();

    /**
     * The static class context, this method will be consumed by overloader utility class for
     *  dynamic calling of methods.
     * This will be added functionality for the overloader utility class.
     *
     * @return LordDashMe\MailChimp\Core\Campaign\CampaignFacade
     */
    public static function staticClass();
}