<?php

/**
 * The Template Folder Manager Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since September 07, 2017
 */

namespace LordDashMe\MailChimp\Core\TemplateFolder;

use LordDashMe\MailChimp\Exception\TemplateFolderException;
use LordDashMe\MailChimp\Core\MailChimpManagerAbstract;
use LordDashMe\MailChimp\Contract\TemplateFolder\API\templateFolderService as TemplateFolderServiceInterface;

class TemplateFolderManager extends MailChimpManagerAbstract
{
    /**
     * The templateFolder manager class constructor.
     *
     * @param  \LordDashMe\MailChimp\Contract\TemplateFolder\API\TemplateFolderService  $templateFolderService
     * @param  array  $headers
     *
     * @return void
     */
    public function __construct(TemplateFolderServiceInterface $templateFolderService, $headers)
    {
        parent::__construct($headers);

        $this->setMailChimpService($templateFolderService)
             ->setMailChimpHeaders($headers);
    }

    /**
     * The read all records method for the template folder list.
     *
     * @param  function  $closure
     *
     * @return json
     */
    public function select($closure)
    {
        $templateFolderService = $this->getMailChimpService();
        $templateFolderService = $this->prepareMailChimpHeaders($closure($templateFolderService));

        return $templateFolderService->select();
    }

    /**
     * The read specific record method for the template folder list.
     *
     * @param  string    $templateFolderId
     * @param  function  $closure
     *
     * @return json
     */
    public function find($templateFolderId, $closure)
    {
        $templateFolderService = $this->getMailChimpService();
        $templateFolderService = $this->prepareMailChimpHeaders($closure($templateFolderService));

        $templateFolderService->templateFolderId = $templateFolderId;

        return $templateFolderService->find();
    }

    /**
     * The create method for the template folder.
     *
     * @param  function  $closure
     *
     * @return json
     */
    public function create($closure)
    {
        $templateFolderService = $this->getMailChimpService();

        $templateFolderService = $this->prepareMailChimpHeaders($closure($templateFolderService));
        $templateFolderService = $this->prepareMailChimpFields($templateFolderService);

        return $templateFolderService->create();
    }

    /**
     * The update method for the template folder.
     *
     * @param  string    $templateFolderId
     * @param  function  $closure
     *
     * @return json
     */
    public function update($templateFolderId, $closure)
    {
        $templateFolderService = $this->getMailChimpService();
        $templateFolderService = $this->prepareMailChimpHeaders($closure($templateFolderService));

        $templateFolderService->templateFolderId = $templateFolderId;
        $templateFolderService = $this->prepareMailChimpFields($templateFolderService);

        return $templateFolderService->update();
    }

    /**
     * The delete method for the template folder.
     *
     * @param  string  $templateFolderId
     *
     * @return json
     */
    public function delete($templateFolderId)
    {
        $templateFolderService = $this->getMailChimpService();
        $templateFolderService = $this->prepareMailChimpHeaders($templateFolderService);

        $templateFolderService->templateFolderId = $templateFolderId;

        return $templateFolderService->delete();
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
            ! isset($instance->name)
        );

        if ($required) {
            throw new MailChimpException('The mailchimp template folder primary field(s) not set in the closure.');
        }  
    }
}