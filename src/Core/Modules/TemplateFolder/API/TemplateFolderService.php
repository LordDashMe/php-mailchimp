<?php

/**
 * The Template Folder Service Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\TemplateFolder\API;

use LordDashMe\MailChimp\Core\MailChimpServiceAbstract;
use LordDashMe\MailChimp\Contract\TemplateFolder\API\TemplateFolderService as TemplateFolderServiceInterface;

class TemplateFolderService extends MailChimpServiceAbstract implements TemplateFolderServiceInterface
{
    /**
     * The base resource id for the endpoit.
     *
     * @return int
     */
    protected function baseResouceId() 
    {
        return $this->mutatorBag['templateFolderId'];
    }

    /**
     * The templateFolder create endpoint.
     *
     * @return string
     */
    protected function baseEndpoint()
    {
        $mailchimpApiHost = $this->resolveHostUrl();

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