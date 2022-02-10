<?php

namespace App\Http\Controllers;

use App\Http\Resources\CrudResource;
use App\Http\Services\CrudService;
use App\Media;
use App\Http\Helpers\FileHelper;
use Illuminate\Http\Request;

class MediaController extends Controller
{

	public function __construct()
	{
		CrudService::$model = 'App\\' . str_replace('Controller', '', explode('\\', __CLASS__)[array_key_last(explode('\\', __CLASS__))]);
	}

	public function getFiles()
	{
		return new CrudResource(Media::where([['type', '!=', 'image/jpeg'], ['type', '!=', 'image/jpg'], ['type', '!=', 'image/png'], ['type', '!=', 'image/bmp'], ['type', '!=', 'image/jfif']])->get());
	}

	public function getPhotos()
	{

		$photos = Media::where('type', 'image/jpeg')->orWhere('type', 'image/jpg')->orWhere('type', 'image/png')->orWhere('type', 'image/bmp')->orWhere('type', 'image/svg+xml')->orWhere('type', 'application/octet-stream')->orWhere('type', 'image/jfif')->get();
		return new CrudResource($photos);
	}

	public function store(Request $request)
	{

		if (!$request->isMethod('post')) return new CrudResource(['message' => 'Wrong request method!']);
		else {
			$media = FileHelper::store($request->file('file'), 'media');
			return new CrudResource($media);
		}
	}

	public function getAll()
	{
		return new CrudResource(CrudService::getAll());
	}

	public function destroy(String $id, Request $request)
	{
		if (!$request->isMethod('delete')) return new CrudResource(['message' => 'Wrong request method!']);
		else {
			return FileHelper::delete($id);
		}
	}
}
