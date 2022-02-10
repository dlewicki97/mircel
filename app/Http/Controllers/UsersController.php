<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CrudService;
use App\Http\Helpers\RegisterHelper;
use App\Http\Helpers\UsersHelper;
use App\Http\Resources\CrudResource;
use App\User;

class UsersController extends Controller
{
	public function __construct() {
		CrudService::$model = 'App\User';
	}
	
    public function getAll(Request $request){
        $user = CrudService::getAll();
        return new CrudResource($user);
    }

    public function getOne($id){
    	$user = CrudService::getOne($id);
    	return new CrudResource($user);
    }

    public function getWhere(Request $request) {
        $users = User::where('type', '!=', 'Moderator')->get();
        return new CrudResource($users);
    }

    public function getCommentators(Request $request) {
        return new CrudResource(UsersHelper::getCommentators($request));
    }

    public function passwordReminder(Request $request) {
        return UsersHelper::passwordReminder($request);
    }

    public function changePassword(Request $request) {
        return UsersHelper::changePassword($request);
    }

    public function store(Request $request) {
        $user = CrudService::saveData($request);
        return new CrudResource($user);
    }

    public function confirm($id) {
        return RegisterHelper::activate($id);
    }

    public function destroy($id) {
        $user = CrudService::destroy($id);
        return new CrudResource($user); 
    }

}
