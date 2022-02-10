<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CrudResource;
use App\Http\Services\CrudService;

class SubpagesController extends Controller
{
	public function __construct() {
		CrudService::$model = 'App\\'. str_replace('Controller', '', explode('\\', __CLASS__)[array_key_last(explode('\\', __CLASS__))]);
	}
	
	public function getAll() {
		$subpages = CrudService::getAll();
		return new CrudResource($subpages);
	}

	public function getOne($id) {
		$subpage = CrudService::getOne($id);
		return new CrudResource($subpage);
	}

	public function getWhere(Request $request) {
		$subpages = CrudService::getWhere($request, 'asc');
		return new CrudResource($subpages);
	}
	
	public function store(Request $request) {
		$subpage = CrudService::saveData($request);
		return new CrudResource($subpage);
	}

	
	public function destroy($id) {
		$subpage = CrudService::destroy($id);
		return new CrudResource($subpage); 
	}
}
