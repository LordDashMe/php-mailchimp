<?php

/*
 * This file is part of the PHP MailChimp.
 *
 * (c) Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPMailChimp\Contracts\Base;

/**
 * The MailChimp Service Interface.
 * 
 * @author Joshua Clifford Reyes <reyesjoshuaclifford@gmail.com>
 */
interface MailChimpService
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