<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Services\MailService;

class NewsletterValidationTest extends TestCase
{
    public function testValidData(): void {
    	$data = [
    		'message' => 'Message',
			'subject' => 'Subject',
    	];
        $this->assertEquals(MailService::newsletterValidation($data), true);
    }

    public function testMessageIsInteger(): void {
    	$data = [
    		'message' => 123,
			'subject' => 'Subject',
    	];
        $this->assertEquals(MailService::newsletterValidation($data), false);
    }

    public function testSubjectIsInteger(): void {
    	$data = [
    		'message' => 'Message',
			'subject' => 123,
    	];
        $this->assertEquals(MailService::newsletterValidation($data), false);
    }

    public function testMessageDoesNotExist(): void {
    	$data = [
			'subject' => 'Subject',
    	];
        $this->assertEquals(MailService::newsletterValidation($data), false);
    }

    public function testSubjectDoesNotExist(): void {
    	$data = [
			'message' => 'Message',
    	];
        $this->assertEquals(MailService::newsletterValidation($data), false);
    }
}
