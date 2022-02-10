<?php 

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Http\Traits\RegisterTrait;
use App\Http\Traits\LoginTrait;
use App\Http\Helpers\ResponseHelper;
use App\Http\Resources\RegisterResource;
use App\User;

class RegisterHelper {

	use RegisterTrait, LoginTrait {
		RegisterTrait::validator insteadof LoginTrait;
	}

	protected static $user, $token;
 
	public static function register(Request $request) {
		
		$data = $request->all();

		if(!self::validator($data)) return ResponseHelper::validateResponse();

		if(self::findUser($data['email'])) return ResponseHelper::findUserResponse(); 

		self::createUser($data);
		

		$registerResource = new RegisterResource(self::$user);
		$registerResource->token = self::$token;

		return $registerResource;
	}

	public static function activate($id) {
		$user = User::where('id', $id)->first();
		if($user->active != 1) $user->fill(['active' => 1]);
		else return redirect()->route('home',['aktywacja' => '1']);

		if($user->save()) return redirect()->route('home', ['aktywacja' => '1']);
	}
} 