<?php

/**
 * The Template Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\Template;

use LordDashMe\MailChimp\Core\MailChimpAbstract;
use LordDashMe\MailChimp\Core\Template\TemplateManager;
use LordDashMe\MailChimp\Core\Template\API\TemplateService;

class Template extends MailChimpAbstract
{   
    /**
     * The template class constructor.
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
        return new TemplateManager(
            new TemplateService(), $this->getHeaders()
        );
    }
}