<?php

namespace LordDashMe\MailChimp\Tests\Unit;

use Mockery as Mockery;
use PHPUnit\Framework\TestCase;
use LordDashMe\MailChimp\MailChimp;

class MailChimpTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_mailchimp_class()
    {
        $this->assertInstanceOf(MailChimp::class, new MailChimp('abcde12345'));
    }

    /**
     * @test
     * @expectedException LordDashMe\MailChimp\Exception\InvalidAPIKey
     * @expectedExceptionCode 100
     */
    public function it_should_throw_exception_if_no_mailchimp_api_key_set_in_the_initialization()
    {
        $mailchimp = new MailChimp();
        $mailchimp->get('');
    }

    /**
     * @test
     * @expectedException LordDashMe\MailChimp\Exception\InvalidArgumentPassed
     * @expectedExceptionCode 100
     */
    public function it_should_throw_exception_if_the_given_request_body_argument_not_an_array_or_closure_type()
    {
        $listId = 'abcde12345';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->post("list/{$listId}/members", 'invalid');   
    }

    /**
     * @test
     */
    public function it_should_request_using_post_method_with_the_given_route_and_request_body()
    {
        $listId = 'abcde12345';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->post("list/{$listId}/members", function ($requestBody) {
            $requestBody->email_address = 'sample_email@mailchimp.com';
            return $requestBody;
        });

        $this->assertNotEmpty($mailchimp->getRequest());
    }

    /**
     * @test
     */
    public function it_should_request_using_get_method_with_the_given_route()
    {
        $listId = 'abcde12345';
        $subscriberHash = 'qwerty12345...';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->get("list/{$listId}/members/{$subscriberHash}");

        $this->assertNotEmpty($mailchimp->getRequest());
    }

    /**
     * @test
     */
    public function it_should_request_using_patch_method_with_the_given_route_and_request_body()
    {
        $listId = 'abcde12345';
        $subscriberHash = 'qwerty12345...';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->patch("list/{$listId}/members/{$subscriberHash}", function ($requestBody) {
            $requestBody->email_address = 'sample_email@mailchimp.com';
            return $requestBody;
        });

        $this->assertNotEmpty($mailchimp->getRequest());
    }

    /**
     * @test
     */
    public function it_should_request_using_delete_method_with_the_given_route()
    {
        $listId = 'abcde12345';
        $subscriberHash = 'qwerty12345...';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->delete("list/{$listId}/members/{$subscriberHash}");

        $this->assertNotEmpty($mailchimp->getRequest());
    }

    /**
     * @test
     */
    public function it_should_request_using_action_with_the_given_route()
    {
        $listId = 'abcde12345';
        $subscriberHash = 'qwerty12345...';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->action("list/{$listId}/members/{$subscriberHash}/actions/delete-permanent");

        $this->assertNotEmpty($mailchimp->getRequest());
    }

    /**
     * @test
     */
    public function it_should_get_request_details()
    {
        $listId = 'abcde12345';
        $subscriberHash = 'qwerty12345...';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->get("list/{$listId}/members/{$subscriberHash}");
        
        $this->assertNotEmpty($mailchimp->getRequest());
    }

    /**
     * @test
     */
    public function it_should_get_response_data()
    {
        $listId = 'abcde12345';
        $mailchimp = new MailChimp('abcde12345...');
        $mailchimp->post("list/{$listId}/members", function ($requestBody) {
            $requestBody->email_address = 'sample_email@mailchimp.com';
            return $requestBody;
        });
        
        $this->assertEquals(
            json_encode(array(
                'response_body' => null,
                'header' => array('response_http_code' => 0)
            )), 
            $mailchimp->getResponse()
        );
    }
}