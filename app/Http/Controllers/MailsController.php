<?php

namespace App\Http\Controllers;

use App\Http\Services\CrudService;
use App\Http\Services\MailService;
use App\Http\Resources\MailsResource;
use Illuminate\Http\Request;

class MailsController extends Controller
{
    public function __construct() {
		CrudService::$model = 'App\\'. str_replace('Controller', '', explode('\\', __CLASS__)[array_key_last(explode('\\', __CLASS__))]);
	}

    public function getAll() {
		$mails = CrudService::getAll();
		return new MailsResource($mails);
	}

	public function getOne($id) {
		$mail = CrudService::getOne($id);
		return new MailsResource($mail);
	}

	public function store(Request $request) {
		return MailService::saveData($request);
	}

	public function send(Request $request) {
		return MailService::send($request);
	}

	public function answer(Request $request) {
		return MailService::answer($request);
	}
	
	public function destroy($id) {
		$mail = CrudService::destroy($id);
		return new MailsResource($mail); 
	}
}
