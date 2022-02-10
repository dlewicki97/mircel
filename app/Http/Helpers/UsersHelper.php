<?php
namespace App\Http\Helpers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Helpers\ResponseHelper;
use App\PasswordResets;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReminder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersHelper {

	public static function getCommentators(Request $request): Collection {
		foreach ($request->id as $i => $id) {
            if($i == 0) $users = User::where('id', $id);
            $users = $users->orWhere('id', $id);
        }
		return $users->get();
	}

	public static function passwordReminder(Request $request): object {
		$user = User::where('email', $request->email)->first();
		if(!$user) return ResponseHelper::userDoesNotExist();

		$password_reset = new PasswordResets;
		$password_reset->email = $user->email;
		$token = Str::random(8);
		$password_reset->token = $token;
		
		$password_reset->save();

		Mail::to($user->email)->send(new PasswordReminder($password_reset->toArray()));

		return ResponseHelper::passwordReminderSuccess();

	}

	public static function changePassword(Request $request): object {
		$user = User::find($request->id);
		$password_reset = PasswordResets::where('email', $user->email)->orderBy('created_at', 'desc')->first();
		if(!Auth::attempt(['email' => $user->email, 'password' => $request->password ]) && $password_reset->token != $request->password) return ResponseHelper::passwordError();

		$user->password = Hash::make($request->new_password);

		$user->save();

		return ResponseHelper::changePasswordSuccess();
		
	}
}