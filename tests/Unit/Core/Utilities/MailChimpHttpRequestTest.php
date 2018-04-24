<?php

use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Utilities\MailChimpHttpRequest;
use PHPMailChimp\Contracts\Utilities\MailChimpHttpRequest as MailChimpHttpRequestInterface;

class MailChimpHttpRequestTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_concrete_class()
    {
        $this->assertInstanceOf(MailChimpHttpRequestInterface::class, $this->concreteClass());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_curl()
    {
        $http = $this->getMockBuilder(MailChimpHttpRequestInterface::class)->getMock();
        $http->expects($this->any())
             ->method('execute')
             ->will($this->returnValue(json_encode(array())));

        $this->assertEquals(json_encode(array()), $http->execute());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_post_method()
    {
        $concreteClass = $this->concreteClass([
            'sandbox-api-us16',
            'https://sandbox-us16.api.mailchimp.com/',
            'POST',
            json_encode(array())
        ]);

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $concreteClass->execute());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_patch_method()
    {
        $concreteClass = $this->concreteClass([
            'sandbox-api-us16',
            'https://sandbox-us16.api.mailchimp.com/',
            'PATCH',
            json_encode(['testname' => 'testname'])
        ]);

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $concreteClass->execute());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_get_method()
    {
        $concreteClass = $this->concreteClass([
            'sandbox-api-us16',
            'https://sandbox-us16.api.mailchimp.com/',
            'GET',
            json_encode(['testname' => 'testname'])
        ]);

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $concreteClass->execute());
    }

    protected function concreteClass($arguments = null)
    {
        if (is_array($arguments)) {
            return new MailChimpHttpRequest(...$arguments);
        }
        return new MailChimpHttpRequest();
    }
}