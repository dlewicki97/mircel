<?php

namespace App\Http\Traits;

use App\User;
use App\PasswordResets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LoginResource;

trait LoginTrait
{
	public static function validator(array $data): bool
	{
		$validator = Validator::make($data, [
			'email' => 'required|string|email',
			'password' => 'required|string',
		]);

		return !$validator->fails();
	}

	public static function isActivated()
	{
		return self::$user->active;
	}

	public static function isBlocked()
	{
		return self::$user->blocked;
	}

	public static function findUser(string $email): bool
	{
		self::$user = User::where('email', $email)->first();
		return self::$user ? true : false;
	}

	public static function login(array $data): bool
	{
		if (self::$user) {
			$password_reset = PasswordResets::where('email', $data['email'])->orderBy('created_at', 'desc')->first();

			if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]) || $data['password'] == ($password_reset->token ?? "")) {
				if ($password_reset) Auth::login(self::$user);
				self::$token = Auth::user()->createToken('authToken')->accessToken;
				return true;
			} else {
				return false;
			}
		}
	}

	public static function getResource(): LoginResource
	{
		$loginResource = new LoginResource(self::$user);
		$loginResource->token = self::$token;

		return $loginResource;
	}
}
