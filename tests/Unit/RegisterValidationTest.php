<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Helpers\RegisterHelper;

class RegisterValidationTest extends TestCase
{
	public function testValidRegisterData(): void {
		$data = [
			'name' => 'name',
			'email' => 'test@test.com',
			'password' => 'password',
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), true);
	}

	public function testEmailIsValid(): void {
		$data = [
			'name' => 'name',
			'email' => 'test',
			'password' => 'password',
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testEmailIsNotString(): void {
		$data = [
			'name' => 'name',
			'email' => 123,
			'password' => 'password',
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testEmailDoesNotExist(): void {
		$data = [
			'name' => 'name',
			'password' => 'password',
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testNameIsNotString(): void {
		$data = [
			'email' => 'test@test.com',
			'name' => 123,
			'password' => 'password',
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testNameDoesNotExist(): void {
		$data = [
			'email' => 'test@test.com',
			'password' => 'password',
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testPasswordIsNotString(): void {
		$data = [
			'name' => 'name',
			'email' => 'test@test.com',
			'password' => 123,
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testPasswordDoesNotExist(): void {
		$data = [
			'name' => 'name',
			'email' => 'test@test.com',
			'type' => 'type'
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testTypeIsNotString(): void {
		$data = [
			'name' => 'name',
			'email' => 'test@test.com',
			'password' => 'password',
			'type' => 123
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}

	public function testTypeDoesNotExist(): void {
		$data = [
			'name' => 'name',
			'email' => 'test@test.com',
			'password' => 'password',
		];
		$this->assertEquals(RegisterHelper::validator($data), false);
	}
}
