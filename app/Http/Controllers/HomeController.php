<?php

namespace App\Http\Controllers;

use App\Http\Helpers\HomeHelper;

class HomeController extends Controller {
	
	public function index() {
		return view('welcome', HomeHelper::loadData());
	}
}
