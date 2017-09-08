<?php

/**
 * The MailChimp Service Abstract Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 08, 2017
 */

namespace LordDashMe\MailChimp\Contract;

interface MailChimpServiceAbstract 
{
    /**
     * Execute get method in the given url, this will show all the records 
     *
     * @return json
     */
    public function all();

    /**
     * Execute get method in the given url, this will show specific record 
     *
     * @return json
     */
    public function find();

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp.
     *
     * @return json
     */
    public function create();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp.
     *
     * @return json
     */
    public function update();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp.
     *
     * @return json
     */
    public function delete();
}