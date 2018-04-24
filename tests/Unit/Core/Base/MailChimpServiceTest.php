<?php

use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Base\MailChimpService;

class MailChimpServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_set_a_method_base_api_key()
    {
        $manager = $this->getMockBuilder(MailChimpService::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $manager->request_headers = array('apiKey' => '436efacaca308f34da871cc93eff3559-us16');

        $this->assertEquals($manager->baseApiKey(), '436efacaca308f34da871cc93eff3559-us16');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_host()
    {
        $manager = $this->getMockBuilder(MailChimpService::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $manager->request_headers = array('apiKey' => '436efacaca308f34da871cc93eff3559-us16');

        $this->assertEquals($manager->baseHost(), 'https://us16.api.mailchimp.com/3.0/');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_endpoint()
    {
        $manager = $this->getMockBuilder(MailChimpService::class)
            ->getMockForAbstractClass();

        $this->assertEquals($manager->baseEndpoint(), '');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_resource_id()
    {
        $manager = $this->getMockBuilder(MailChimpService::class)
            ->getMockForAbstractClass();

        $this->assertEquals($manager->baseResouceId(), '');
    }

    /**
     * @test
     */
    public function it_should_set_a_method_base_resources()
    {
        $manager = $this->getMockBuilder(MailChimpService::class)
            ->getMockForAbstractClass();

        $this->assertEquals($manager->baseResources(), json_encode(array()));
    }
}