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
     * Execute get method in the given url, this will show all the members 
     * in the linked list id.
     *
     * @return json
     */
    public function select();

    /**
     * Execute get method in the given url, this will show specific member 
     * in the linked list id.
     *
     * @return json
     */
    public function find();

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function create();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function update();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function delete();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp subscriber.
     *
     * @return json
     */
    public function createOrUpdate();
}