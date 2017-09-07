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
use LordDashMe\MailChimp\Contract\Template\API\templateService as TemplateServiceInterface;

class TemplateManager extends MailChimpManagerAbstract
{
    /**
     * The template manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\Template\API\TemplateService  $templateService
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(TemplateServiceInterface $templateService, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($templateService)
             ->setMailChimpHeaders($headers);
    }

    /**
     * The read all records method for the template list.
     *
     * @param  function  $closure
     *
     * @return json
     */
    public function select($closure)
    {
        $templateService = $this->getMailChimpService();
        $templateService = $this->prepareMailChimpHeaders($closure($templateService));

        return $templateService->select();
    }

    /**
     * The read specific record method for the template list.
     *
     * @param  string    $templateId
     * @param  function  $closure
     *
     * @return json
     */
    public function find($templateId, $closure)
    {
        $templateService = $this->getMailChimpService();
        $templateService = $this->prepareMailChimpHeaders($closure($templateService));

        $templateService->templateId = $templateId;

        return $templateService->find();
    }

    /**
     * The create method for the template.
     *
     * @param  function  $closure
     *
     * @return json
     */
    public function create($closure)
    {
        $templateService = $this->getMailChimpService();

        $templateService = $this->prepareMailChimpHeaders($closure($templateService));
        $templateService = $this->prepareMailChimpFields($templateService);

        return $templateService->create();
    }

    /**
     * The update method for the template.
     *
     * @param  string    $templateId
     * @param  function  $closure
     *
     * @return json
     */
    public function update($templateId, $closure)
    {
        $templateService = $this->getMailChimpService();
        $templateService = $this->prepareMailChimpHeaders($closure($templateService));

        $templateService->templateId = $templateId;
        $templateService = $this->prepareMailChimpFields($templateService);

        return $templateService->update();
    }

    /**
     * The delete method for the template.
     *
     * @param  string  $templateId
     *
     * @return json
     */
    public function delete($templateId)
    {
        $templateService = $this->getMailChimpService();
        $templateService = $this->prepareMailChimpHeaders($templateService);

        $templateService->templateId = $templateId;

        return $templateService->delete();
    }

    /**
     * Check if the primary fields of MailChimp are setted in the closure.
     * This is a custom validation or checking instead of requesting to the mailchimp api
     * we just validate first for the application side for the speed purpose.
     *
     * @param  instance|class  $instance
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