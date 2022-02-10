<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Services\MailService;

class QuestionValidationTest extends TestCase
{
	public function testValidData(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 'subject',
			'message' => 'message',
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), true);
	}

	public function testEmailDoesNotExist(): void {
		$data = [
			'subject' => 'subject',
			'message' => 'message',
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testSubjectDoesNotExist(): void {
		$data = [
			'email' => 'test@test.com',
			'message' => 'message',
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testMessageDoesNotExist(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 'subject',
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testNameDoesNotExist(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 'subject',
			'message' => 'message',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testPhoneDoesNotExist(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 'subject',
			'message' => 'message',
			'name' => 'name',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testEmailIsValid(): void {
		$data = [
			'email' => 'test',
			'subject' => 'subject',
			'message' => 'message',
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testEmailIsNotString(): void {
		$data = [
			'email' => 123,
			'subject' => 'subject',
			'message' => 'message',
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testSubjectIsNotString(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 123,
			'message' => 'message',
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testMessageIsNotString(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 'subject',
			'message' => 123,
			'name' => 'name',
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testNameIsNotString(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 'subject',
			'message' => 'message',
			'name' => 123,
			'phone' => 'phone',
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}

	public function testPhoneIsNotString(): void {
		$data = [
			'email' => 'test@test.com',
			'subject' => 'subject',
			'message' => 'message',
			'name' => 'name',
			'phone' => 123,
		];
		$this->assertEquals(MailService::questionValidation($data), false);
	}
}
