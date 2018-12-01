<?php

namespace LordDashMe\MailChimp\Tests\Unit\Facade;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use LordDashMe\MailChimp\Facade\MailChimp;

class MailChimpTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_init_mailchimp_class_in_a_static_way()
    {
        MailChimp::init('abcde1235');
    }
}
