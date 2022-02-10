<?php

namespace App\Http\Helpers;

use Request;
use App\Settings;
use App\Subpages;
use App\Offers;
use App\News;
use App\Players;
use App\Cups;
use App\ShopProducts;

class HomeHelper
{

	public static function getCurrentSubpage($subpages): object
	{
		foreach ($subpages as $i => $subpage) {
			if ($subpage->page == '/' . Request::segment(1)) return $subpage;
		}
	}

	public static function loadData(): array
	{
		$data['settings'] = Settings::find(1);
		$data['meta_title'] = 'Panel administracyjny - ' . $data['settings']->company;
		$data['meta_description'] = 'Panel administracyjny';

		if (Request::segment(1) != 'admin-panel') {
			//
		}


		$data['meta_title'] = $data['meta_title'] . ' - ' . $data['settings']->company;
		$data['meta_description'] = strip_tags($data['meta_description']);

		return $data;
	}
}
