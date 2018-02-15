<?php

/**
 * The Template Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\Template;

use LordDashMe\MailChimp\Exception\MailChimpException;
use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\Template\API\TemplateService as TemplateServiceInterface;

class TemplateManager extends MailChimpManagerAbstract
{
    /**
     * The template manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\Template\API\TemplateService  $service
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(TemplateServiceInterface $service, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($service)
             ->setMailChimpHeaders($headers);
    }

    /**
     * The resource id for the current service.
     *
     * @param  mixed  $service
     * @param  int    $resourceId
     *
     * @return mixed
     */
    protected function resourceId($service, $resourceId) 
    { 
        $service->templateId = $resourceId;

        return $service; 
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  mixed  $service
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     * 
     * @return void
     */
    protected function validateMailChimpRequiredFields($service)
    {
        $required = (
            ! isset($service->name) ||
            ! isset($service->html)
        );

        if ($required) {
            throw new MailChimpException(
                'The mailchimp template primary field(s) not set in the closure.'
            );
        }  
    }
}