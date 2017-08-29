<?php

/**
 * The Campaign Service Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 29, 2017
 */

namespace LordDashMe\MailChimp\Contract\Campaign\API;

interface CampaignService 
{
    /**
     * Execute get method in the given url, this will show all the members 
     *  in the linked list id.
     *
     * @return json
     */
    public function showAll();

    /**
     * Execute get method in the given url, this will show specific member 
     *  in the linked list id.
     *
     * @return json
     */
    public function show();

    /**
     * Execute post method in the given url, this will be the 
     *  create/add endpoint for mailchimp campaign.
     *
     * @return json
     */
    public function create();

    /**
     * Execute patch method in the given url, this will be the 
     *  update/modify endpoint for mailchimp campaign.
     *
     * @return json
     */
    public function update();

    /**
     * Execute patch method in the given url, this will be the 
     *  update/modify endpoint for mailchimp campaign.
     *
     * @return json
     */
    public function delete();
}