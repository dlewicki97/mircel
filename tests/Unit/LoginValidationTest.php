<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Helpers\LoginHelper;

class LoginValidationTest extends TestCase
{
	public function testValidLoginData() {
		$data = [
			'email' => 'test@test.com',
			'password' => 'password',
		];
		$this->assertEquals(LoginHelper::validator($data), true);
	}

	public function testEmailIsNotValid() {
		$data = [
			'email' => 'test',
			'password' => 'password',
		];
		$this->assertEquals(LoginHelper::validator($data), false);
	}

	public function testEmailIsNotString() {
		$data = [
			'email' => 123,
			'password' => 'password',
		];
		$this->assertEquals(LoginHelper::validator($data), false);
	}

	public function testEmailDoesNotExist() {
		$data = [
			'password' => 'password',
		];
		$this->assertEquals(LoginHelper::validator($data), false);
	}

	public function testPasswordIsNotString() {
		$data = [
			'email' => 'test@test.com',
			'password' => 123,
		];
		$this->assertEquals(LoginHelper::validator($data), false);
	}

	public function testPasswordDoesNotExist() {
		$data = [
			'email' => 'test@test.com',
		];
		$this->assertEquals(LoginHelper::validator($data), false);
	}
}
