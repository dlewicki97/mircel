<?php

namespace App\Http\Controllers;

use App\Http\Services\CrudService;
use App\Http\Resources\CrudResource;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
	public function __construct() {
		CrudService::$model = 'App\\'. str_replace('Controller', '', explode('\\', __CLASS__)[array_key_last(explode('\\', __CLASS__))]);
	}

	public function getAll() {
		$settings = CrudService::getAll();
		return new CrudResource($settings);
	}

	public function getOne($id) {
		$settings = CrudService::getOne($id);
		return new CrudResource($settings);
	}

	public function getWhere(Request $request) {
		$settings = CrudService::getWhere($request, 'asc');
		return new CrudResource($settings);
	}

	public function store(Request $request) {
		$settings = CrudService::saveData($request);
		return new CrudResource($settings);
	}
	
	public function destroy($id) {
		$settings = CrudService::destroy($id);
		return new CrudResource($settings); 
	}   
}
