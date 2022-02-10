<?php

namespace App\Http\Controllers\Auth\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\RegisterHelper;

class RegisterController extends Controller
{
	public function register(Request $request){
		
		$response = RegisterHelper::register($request);
		return $response;
	}
}
