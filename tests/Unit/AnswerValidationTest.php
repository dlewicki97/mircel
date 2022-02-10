<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\MailService;

class AnswerValidationTest extends TestCase
{
    public function testValidDataTest(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'subject' => 'Test subject',
    		'answer' => 0,
    		'id' => 27,
    		'email' => 'test@test.com'
    	];
    	$this->assertEquals(MailService::answerValidation($data), true);
    }

    public function testAnswerMessageDoesNotExist(): void {
    	$data = [
    		'subject' => 'Test subject',
    		'answer' => 0,
    		'id' => 27,
    		'email' => 'test@test.com'
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    }

    public function testSubjectDoesNotExist(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'answer' => 0,
    		'id' => 27,
    		'email' => 'test@test.com'
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    }

    public function testEmailIsNotValid(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'subject' => 'Test subject',
    		'answer' => 0,
    		'id' => 27,
    		'email' => 'test'
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    }
    
    public function testEmailIsNotString(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'subject' => 'Test subject',
    		'answer' => 0,
    		'id' => 27,
    		'email' => 123
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    }

    public function testAnswerIsNotInteger(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'subject' => 'Test subject',
    		'answer' => 'answer',
    		'id' => 27,
    		'email' => 'test@test.com'
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);

    }

    public function testIdIsNotInteger(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'subject' => 'Test subject',
    		'answer' => 0,
    		'id' => 'id',
    		'email' => 'test@test.com'
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    }

    public function testEmailDoesNotExist(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'subject' => 'Test subject',
    		'answer' => 0,
    		'id' => 27,
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    }

    public function testAnswerMessageIsNotString(): void {
    	$data = [
    		'answer_message' => 123,
    		'subject' => 'Test subject',
    		'answer' => 0,
    		'id' => 27,
    		'email' => 'test@test.com'
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    }

    public function testSubjectIsNotString(): void {
    	$data = [
    		'answer_message' => 'Test message',
    		'subject' => 123,
    		'answer' => 0,
    		'id' => 27,
    		'email' => 'test@test.com'
    	];
    	$this->assertEquals(MailService::answerValidation($data), false);
    } 
    
}
