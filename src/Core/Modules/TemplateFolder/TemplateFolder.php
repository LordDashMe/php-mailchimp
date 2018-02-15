<?php

/**
 * The Template Folder Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\TemplateFolder;

use LordDashMe\MailChimp\Core\MailChimpAbstract;
use LordDashMe\MailChimp\Core\TemplateFolder\TemplateFolderManager;
use LordDashMe\MailChimp\Core\TemplateFolder\API\TemplateFolderService;

class TemplateFolder extends MailChimpAbstract
{   
    /**
     * The template folder class constructor.
     *
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct($headers = array())
    {
        parent::__construct($headers);
    }

    /**
     * Resolve the service injection for the manager and worker.
     *
     * @return mixed
     */
    protected function concreteService()
    {
        return new TemplateFolderManager(
            new TemplateFolderService(), $this->getHeaders()
        );
    }
}