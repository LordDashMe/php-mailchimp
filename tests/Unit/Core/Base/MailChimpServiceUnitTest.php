<?php

use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Base\MailChimpService;

class MailChimpServiceUnitTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_set_a_method_base_api_key()
    {
        $service = new MailChimpService();

        $service->request_headers = array(
            'apiKey' => '436efacaca308f34da871cc93eff3559-us16'
        );

        $this->assertEquals($service->baseApiKey(), '436efacaca308f34da871cc93eff3559-us16');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_host_via_api_key()
    {
        $service = new MailChimpService();

        $service->request_headers = array(
            'apiKey' => '436efacaca308f34da871cc93eff3559-us16'
        );

        $this->assertEquals($service->baseHost(), 'https://us16.api.mailchimp.com/3.0/');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_endpoint()
    {
        $service = new MailChimpService();

        $this->assertEquals($service->baseEndpoint(), '');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_resource_id()
    {
        $service = new MailChimpService();

        $this->assertEquals($service->baseResouceId(), '');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_resources()
    {
        $service = new MailChimpService();

        $this->assertEquals($service->baseResources(), json_encode(array()));
    }
}