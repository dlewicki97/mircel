<?php

namespace App\Http\Controllers\Auth\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\LoginHelper;
use App\Http\Helpers\RegisterHelper;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
	public function login(Request $request)
	{

		$response = LoginHelper::login($request);
		return $response;
	}

	public function autoLogin(Request $request)
	{
		$response = Auth::login(User::find($request->id));
		echo Auth::user();
	}

	public function redirectToProvider(Request $request)
	{
		return Socialite::driver('facebook')->redirect();
	}

	public function handleProviderCallback(Request $request)
	{
		$user = Socialite::driver('facebook')->user();
		$loggedUser = User::where('email', $user->email)->first();
		if ($loggedUser === null) {
			RegisterHelper::createUser(['name' => $user->getName(), 'email' => $user->getEmail(), 'photo' => $user->getAvatar(), 'password' => str_random(8)]);
			$loggedUser = RegisterHelper::$user;
		}


		setcookie('email', $loggedUser->email, time() + (86400 * 30), "/");

		return redirect()->action('HomeController@index');
	}

	public function getToken()
	{
		$response = LoginHelper::fbLogin();
		return $response;
	}
}
