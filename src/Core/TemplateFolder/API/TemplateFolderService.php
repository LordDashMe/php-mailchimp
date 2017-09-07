<?php

/**
 * The Template Folder Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\TemplateFolder\API;

use LordDashMe\MailChimp\Utilities\Url;
use LordDashMe\MailChimp\Utilities\Curl;
use LordDashMe\MailChimp\Utilities\Mutator;
use LordDashMe\MailChimp\Contract\TemplateFolder\API\TemplateFolderService as TemplateFolderServiceInterface;

class TemplateFolderService extends Mutator implements TemplateFolderServiceInterface
{
    /**
     * Execute get method in the given url, this will show all the members 
     * in the linked template folder id.
     *
     * @return json
     */
    public function select()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'GET', $this->baseResources()))->execute();
    }

    /**
     * Execute get method in the given url, this will show specific member 
     * in the linked template folder id.
     *
     * @return json
     */
    public function find()
    {
        $templateFolderId = $this->mutatorBag['templateFolderId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$templateFolderId}", 'GET', $this->baseResources()))->execute();
    }

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp template folder.
     *
     * @return json
     */
    public function create()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'POST', $this->baseResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp template folder.
     *
     * @return json
     */
    public function update()
    {
        $templateFolderId = $this->mutatorBag['templateFolderId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$templateFolderId}", 'PATCH', $this->baseResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp template folder.
     *
     * @return json
     */
    public function delete()
    {
        $templateFolderId = $this->mutatorBag['templateFolderId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$templateFolderId}", 'DELETE'))->execute();
    }

    /**
     * The templateFolder create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $apiKey = $this->mutatorBag['apiKey'];

        $mailchimpApiHost = Url::resolve($apiKey);

        return "{$mailchimpApiHost}/template-folders"; 
    }

    /**
     * This will parse or prepare resources in the dynamic field instance.
     * The purpose of parsing other resources is the key for the dynamic field declaration in the closure.
     *
     * @return json
     */
    protected function baseResources()
    {
        $mutatorBagCached = $this->mutatorBag;

        unset($mutatorBagCached['apiKey']);

        return json_encode($mutatorBagCached);
    }
}