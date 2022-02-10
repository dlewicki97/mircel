<?php
namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Helpers\FileHelper;
use App\Http\Services\CrudService;
use App\Attachments;

class AttachmentsService {

	public static function prependData($request) {
		$data['path'] = FileHelper::store($request->file, 'attachments');
		$data['mail_id'] = $request->input('mail_id');

		return $data;
	}

	public static function saveData(Request $request) {
		$data = self::prependData($request);

		$attachment = $request->isMethod('put') ? Attachments::where('id', $request->input('id'))->first()->fill($data) : Attachments::create($data);


		if ($attachment->save()) {

			return $attachment;
		}
	}
}