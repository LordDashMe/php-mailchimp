<?php

use Mockery as PHPMockery;
use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Base\MailChimpManager;
use PHPMailChimp\Core\Base\MailChimpService;

class ModuleIntegrationTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_build_all_module_action()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $response = $module->all(
            function($requestBody) {
                return $requestBody;
            },
            function($requestPath) {
                return $requestPath;
            }
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $response);
    }

    /**
     * @test
     */
    public function it_should_build_find_module_action()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $response = $module->find(
            function($requestBody) {
                return $requestBody;
            },
            function($requestPath) {
                return $requestPath;
            }
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $response);
    }

    /**
     * @test
     */
    public function it_should_build_create_module_action()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $response = $module->create(
            function($requestBody) {
                return $requestBody;
            },
            function($requestPath) {
                return $requestPath;
            }
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $response);
    }

    /**
     * @test
     */
    public function it_should_build_update_module_action()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $response = $module->update(
            function($requestBody) {
                return $requestBody;
            },
            function($requestPath) {
                return $requestPath;
            }
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $response); 
    }

    /**
     * @test
     */
    public function it_should_build_delete_module_action()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $response = $module->delete(
            function($requestBody) {
                return $requestBody;
            },
            function($requestPath) {
                return $requestPath;
            }
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $response); 
    }

    /**
     * @test
     */
    public function it_should_build_create_module_action_using_array()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $response = $module->create(
            ['bodyParam1' => 'testBody'],
            ['pathParam1' => 'testPath']
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $response);
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     */
    public function it_should_throw_exception_for_not_valid_request_body_paramter()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $module->create(
            '',
            function($requestPath) {
                return $requestPath;
            }
        );
    }

    /**
     * @test
     */
    public function it_should_pass_for_not_valid_request_path_paramter()
    {
        $module = new Module();
        $module->init(['apiKey' => 'qwerty']);

        $module->create(
            function($requestBody) {
                return $requestBody;
            },
            ''
        );
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     * @expectedExceptionMessage Request bodyParam1 is missing!
     */
    public function it_should_throw_exception_for_invalid_request_body_parameters()
    {
        $module = new ModuleValidateRequestBodyParameters();
        $module->init(['apiKey' => 'qwerty']);

        $module->create(
            function($requestBody) {
                $requestBody->bodyParam2 = 'qwerty';
                return $requestBody;
            },
            function($requestPath) {
                return $requestPath;
            }
        );
    }
}

class Module extends MailChimpManager 
{
    public function registerModule()
    {
        return new MailChimpService();
    }
}

class ModuleValidateRequestBodyParameters extends Module
{
    public function validateRequestBodyParameters($service)
    {
        if (! isset($service->request_body_parameters['bodyParam1'] )) {
            throw new \PHPMailChimp\Core\Exceptions\MailChimpException('Request bodyParam1 is missing!');
        }

        return $service;
    }
}