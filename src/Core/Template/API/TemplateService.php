<?php

/**
 * The Template Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\Template\API;

use LordDashMe\MailChimp\Utilities\Url;
use LordDashMe\MailChimp\Utilities\Curl;
use LordDashMe\MailChimp\Utilities\Mutator;
use LordDashMe\MailChimp\Contract\Template\API\TemplateService as TemplateServiceInterface;

class TemplateService extends Mutator implements TemplateServiceInterface
{
    /**
     * Execute get method in the given url, this will show all the members 
     * in the linked template id.
     *
     * @return json
     */
    public function select()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'GET'))->execute();
    }

    /**
     * Execute get method in the given url, this will show specific member 
     * in the linked template id.
     *
     * @return json
     */
    public function find()
    {
        $templateId = $this->mutatorBag['templateId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$templateId}", 'GET'))->execute();
    }

    /**
     * Execute post method in the given url, this will be the 
     * create/add endpoint for mailchimp template.
     *
     * @return json
     */
    public function create()
    {
        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint(), 'POST', $this->baseResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp template.
     *
     * @return json
     */
    public function update()
    {
        $templateId = $this->mutatorBag['templateId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$templateId}", 'PATCH', $this->baseResources()))->execute();
    }

    /**
     * Execute patch method in the given url, this will be the 
     * update/modify endpoint for mailchimp template.
     *
     * @return json
     */
    public function delete()
    {
        $templateId = $this->mutatorBag['templateId'];

        return (new Curl($this->mutatorBag['apiKey'], $this->baseEndpoint() . "/{$templateId}", 'DELETE'))->execute();
    }

    /**
     * The template create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $apiKey = $this->mutatorBag['apiKey'];

        $mailchimpApiHost = Url::resolve($apiKey);

        return "{$mailchimpApiHost}/templates"; 
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