<?php
namespace App\Http\Helpers;

use App\Http\Helpers\FileHelper;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class GalleryHelper {

	public static function getPhotos($table, $id): Collection {
		return Gallery::where('table_name', $table)->where('item_id', $id)->get();
	}
}