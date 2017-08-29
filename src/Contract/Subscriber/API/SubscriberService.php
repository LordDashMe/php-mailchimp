<?php

/**
 * The Subscriber Service Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 25, 2017
 */

namespace LordDashMe\MailChimp\Contract\Subscriber\API;

interface SubscriberService 
{
    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function create();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function update();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function delete();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscribers.
     *
     * @return json
     */
    public function createOrUpdate();
}