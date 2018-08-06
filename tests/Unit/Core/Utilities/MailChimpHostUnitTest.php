<?php

use PHPUnit\Framework\TestCase;
use PHPMailChimp\Core\Utilities\MailChimpHost;

class MailChimpHostUnitTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_resolve_given_api_key()
    {
        $this->assertEquals('https://us16.api.mailchimp.com/3.0', MailChimpHost::resolve('436efacaca308f34da871cc93eff3559-us16')); 
    }
}