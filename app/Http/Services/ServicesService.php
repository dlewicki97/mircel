<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\ServicesServiceCategories;

class ServicesService
{

	public static $model = 'App\Services';



	public static function prependData(Request $request): array
	{
		return $request->all();
	}

	public static function saveData(Request $request): Model
	{
		$data = self::prependData($request);
		$model = $request->isMethod('put') ? self::$model::where('id', $request->input('id'))->first()->fill($data) : self::$model::create($data);

		$model->save();

		if ($request->service_categories) self::saveServicesServiceCategories($model, $request->service_categories);

		return $model;
	}

	private static function saveServicesServiceCategories($model, $requestServiceCategories)
	{
		$modelServiceCategories = ServicesServiceCategories::where('service_id', $model->id)->get();
		foreach ($modelServiceCategories as $row) {
			if (!in_array($row->service_category_id, $requestServiceCategories)) $row->delete();
		}
		$modelServiceCategories = array_map(function ($row) {
			return $row['service_category_id'];
		}, $modelServiceCategories->toArray());

		foreach ($requestServiceCategories as $categoryId) {

			if (!in_array($categoryId, $modelServiceCategories)) ServicesServiceCategories::create(['service_category_id' => $categoryId, 'service_id' => $model->id])->save();
		}
	}
}
