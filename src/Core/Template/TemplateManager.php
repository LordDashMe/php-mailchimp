<?php

/**
 * The Template Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\Template;

use LordDashMe\MailChimp\Exception\TemplateException;
use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\Template\API\TemplateService as TemplateServiceInterface;

class TemplateManager extends MailChimpManagerAbstract
{
    /**
     * The template manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\Template\API\TemplateService  $instance
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(TemplateServiceInterface $instance, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($instance)
             ->setMailChimpHeaders($headers);
    }

    /**
     * The resource id for the current instance.
     *
     * @param  mixed  $instance
     * @param  int    $resourceId
     *
     * @return mixed
     */
    protected function resourceId($instance, $resourceId) 
    { 
        $instance->templateId = $resourceId;

        return $instance; 
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  mixed  $instance
     *
     * @return void
     *
     * @throws LordDashMe\MailChimp\Exception\MailChimpException
     */
    protected function validateMailChimpRequiredFields($instance)
    {
        $required = (
            ! isset($instance->name) ||
            ! isset($instance->html)
        );

        if ($required) {
            throw new MailChimpException('The mailchimp template primary field(s) not set in the closure.');
        }  
    }
}