<?php

use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Utilities\MailChimpHttpRequest;
use PHPMailChimp\Contracts\Utilities\MailChimpHttpRequest as MailChimpHttpRequestInterface;

class MailChimpHttpRequestUnitTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_concrete_class()
    {
        $this->assertInstanceOf(MailChimpHttpRequestInterface::class, new MailChimpHttpRequest());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_curl()
    {
        $httpRequest = new MailChimpHttpRequest();

        $this->assertEquals(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $httpRequest->execute());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_post_method()
    {
        $httpRequest = new MailChimpHttpRequest(
            'sandbox-api-us16',
            'https://sandbox-us16.api.mailchimp.com/',
            'POST',
            json_encode(array())
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $httpRequest->execute());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_patch_method()
    {
        $httpRequest = new MailChimpHttpRequest(
            'sandbox-api-us16',
            'https://sandbox-us16.api.mailchimp.com/',
            'PATCH',
            json_encode(['testname' => 'testname'])
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $httpRequest->execute());
    }

    /**
     * @test
     */
    public function it_can_call_http_request_using_get_method()
    {
        $httpRequest = new MailChimpHttpRequest(
            'sandbox-api-us16',
            'https://sandbox-us16.api.mailchimp.com/',
            'GET',
            json_encode(['testname' => 'testname'])
        );

        $this->assertJsonStringEqualsJsonString(json_encode([
            'response_body' => null,
            'header' => [
                'http_code' => 0
            ]
        ]), $httpRequest->execute());
    }
}