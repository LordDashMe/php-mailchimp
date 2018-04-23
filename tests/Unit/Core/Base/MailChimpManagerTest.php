<?php

use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Base\MailChimpManager;

class MailChimpManagerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_a_null_if_no_headers_pass_in_the_init_method()
    {
        $manager = $this->getMockBuilder(MailChimpManager::class)
            ->getMockForAbstractClass();

        $this->assertEquals(null, $manager->init());
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     * @expectedExceptionCode 101
     */
    public function it_should_throw_cannot_resolve_register_module_method_exception()
    {
        $manager = $this->getMockBuilder(MailChimpManager::class)
            ->getMockForAbstractClass();

        $manager->init(['apiKey' => '...']);
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     * @expectedExceptionCode 102
     */
    public function it_should_throw_cannot_resolve_module_headers_exception()
    {   
        $manager = $this->getMockBuilder(MailChimpManager::class)
            ->setMethods(['registerModule'])
            ->getMockForAbstractClass();

        $manager->expects($this->any())
            ->method('registerModule')
            ->will($this->returnValue(true));

        $manager->init('test');
    }

    /**
     * @test
     * @expectedException PHPMailChimp\Core\Exceptions\MailChimpException
     * @expectedExceptionCode 103
     */
    public function it_should_throw_cannot_resolve_headers_resources_exception()
    {   
        $manager = $this->getMockBuilder(MailChimpManager::class)
            ->setMethods(['registerModule'])
            ->getMockForAbstractClass();

        $manager->expects($this->any())
            ->method('registerModule')
            ->will($this->returnValue(true));

        $manager->init(['key' => '...']);
    }
}