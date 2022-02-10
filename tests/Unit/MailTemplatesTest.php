<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Services\MailService;
use App\Mail\AnswerForm;
use App\Mail\NewsletterForm;
use App\Mail\ContactForm;

class MailTemplatesTest extends TestCase
{
    public function testCheckIfReturnedTemplateIsCorrect(): void {
    	$data = ['answer' => 1];
    	$this->assertEquals(MailService::getTemplate($data), new AnswerForm($data));
    	$data = ['newsletter' => 1];
    	$this->assertEquals(MailService::getTemplate($data), new NewsletterForm($data));
    	$data = [];
    	$this->assertEquals(MailService::getTemplate($data), new ContactForm($data));
    }
}
