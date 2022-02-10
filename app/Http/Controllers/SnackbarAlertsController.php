<?php

namespace App\Http\Controllers;

use App\Http\Services\CrudService;
use App\Http\Resources\CrudResource;
use Illuminate\Http\Request;

class SnackbarAlertsController extends Controller
{
    public function __construct() {
		CrudService::$model = 'App\\'. str_replace('Controller', '', explode('\\', __CLASS__)[array_key_last(explode('\\', __CLASS__))]);
	}

    public function getAll() {
		$data = CrudService::getAll();
		return new CrudResource($data);
	}

	public function getOne($id) {
		$data = CrudService::getOne($id);
		return new CrudResource($data);
	}

	public function getWhere(Request $request) {
		$data = CrudService::getWhere($request, 'asc');
		return new CrudResource($data);
	}

	public function store(Request $request) {
		$data = CrudService::saveData($request);
		return new CrudResource($data);
	}
	
	public function destroy($id) {
		$data = CrudService::destroy($id);
		return new CrudResource($data); 
	}
}
