<?php

namespace App\Http\Helpers;

use App\DefaultCrudTables as DefaultCrudTablesModel;

class DefaultCrudTables
{
	public static function get()
	{
		return json_decode(DefaultCrudTablesModel::find(1)->json);
	}
}
