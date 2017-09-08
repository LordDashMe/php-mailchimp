<?php

/**
 * The Template Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\Template\API;

use LordDashMe\MailChimp\Core\MailChimpServiceAbstract;
use LordDashMe\MailChimp\Contract\Template\API\TemplateService as TemplateServiceInterface;

class TemplateService extends MailChimpServiceAbstract implements TemplateServiceInterface
{
    /**
     * The base resource id for the endpoit.
     *
     * @return int
     */
    protected function baseResouceId() 
    {
        return $this->mutatorBag['templateId'];
    }

    /**
     * The template create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $mailchimpApiHost = $this->resolveHostUrl();

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