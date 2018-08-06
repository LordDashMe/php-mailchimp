<?php

use Mockery as PHPMockery;
use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Base\MailChimpManager;

class MailChimpManagerUnitTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_a_null_if_no_headers_pass_in_the_init_method()
    {
        $manager = new MailChimpManager();

        $this->assertEquals(null, $manager->init());
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     * @expectedExceptionCode 101
     */
    public function it_should_throw_cannot_resolve_register_module_method_exception()
    {
        $manager = new MailChimpManager();

        $manager->init(['apiKey' => '...']);
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     * @expectedExceptionCode 102
     */
    public function it_should_throw_cannot_resolve_module_headers_exception()
    {   
        $managerMocked = PHPMockery::mock(MailChimpManager::class)
            ->makePartial();

        $managerMocked->shouldReceive('registerModule')
            ->andReturn(true);

        $managerMocked->init('test');
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     * @expectedExceptionCode 103
     */
    public function it_should_throw_cannot_resolve_headers_resources_exception()
    {   
        $managerMocked = PHPMockery::mock(MailChimpManager::class)
            ->makePartial();

        $managerMocked->shouldReceive('registerModule')
            ->andReturn(true);

        $managerMocked->init(['key' => '...']);
    }

    /**
     * @test
     */
    public function it_should_init_header_and_service_with_proper_value()
    {
        $managerMocked = PHPMockery::mock(MailChimpManager::class)
            ->makePartial();

        $managerMocked->shouldReceive('registerModule')
            ->andReturn(true);

        $managerMocked->init(['apiKey' => 'qwerty']);   
    }
}