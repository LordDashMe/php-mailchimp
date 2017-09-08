<?php

/**
 * The Template Folder Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\TemplateFolder;

use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\TemplateFolder\API\TemplateFolderService as TemplateFolderServiceInterface;

class TemplateFolderManager extends MailChimpManagerAbstract
{
    /**
     * The templateFolder manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\TemplateFolder\API\TemplateFolderService  $instance
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(TemplateFolderServiceInterface $instance, $headers)
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
        $instance->templateFolderId = $resourceId;

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
            ! isset($instance->name)
        );

        if ($required) {
            throw new MailChimpException('The mailchimp template folder primary field(s) not set in the closure.');
        }  
    }
}