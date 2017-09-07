<?php

/**
 * The Template Folder Service Interface.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Contract\TemplateFolder\API;

interface TemplateFolderService 
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
     * create/add endpoint for mailchimp template folder.
     *
     * @return json
     */
    public function create();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp template folder.
     *
     * @return json
     */
    public function update();

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp template folder.
     *
     * @return json
     */
    public function delete();
}