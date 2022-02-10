<?php
namespace App\Http\Helpers;

use App\Http\Helpers\WebpHelper;
use App\SnackbarAlerts;
use App\Media;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\MediaResource;

class FileHelper {

	private static $name;
	private static $webpTypes = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');

	private static function getFileName($file) {

		$fileNameWithExt = $file->getClientOriginalName();
		self::$name = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
		$extension = $file->getClientOriginalExtension();
		$name = str_replace(' ', '_', self::$name)  . '_' . time() . '.' . $extension;

		return $name;
	}

	private static function storeToMedia($file, $path) {

		$media = new Media;
		$media->path = $path;
		$media->name = self::$name;
		$media->size = $file->getSize();
		$media->type = $file->getClientMimeType();

		$media->save();

		return $media;
	}

	public static function store($file, $folder = 'media') {
		
		$name = self::getFileName($file);
		$destination = date('Y-m-d') . '/';
		$full_path = $destination . $name;
		$destination = "$folder/". $destination;
		
		Storage::putFileAs($destination, new File($file), $name);
		if (in_array($file->getClientMimeType(), self::$webpTypes)) {
			WebpHelper::convertToWebp($destination, $name);
		}

		$media = $folder == 'media' ? self::storeToMedia($file, $full_path) : $full_path;

		return $media;
	}

	public static function deleteFilesFromStorage($path, $folder){
		Storage::delete("$folder/". explode('/', $path)[0]. '/'. explode('/', $path)[1]);
		Storage::delete("$folder/". explode('/', $path)[0]. '/'. explode('/', $path)[1]. '.webp');
	}

	public static function delete($id, $folder = 'media'){

		$media = Media::find($id);

		if ($media->delete()) {
			FileHelper::deleteFilesFromStorage($media->path, $folder);
			return new MediaResource($media);
		}else{
			return new MediaResource(['message' => SnackbarAlerts::find(1)->error]);
		}

	}

}