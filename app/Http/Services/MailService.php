<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Services\CrudService;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\FileHelper;
use App\Http\Helpers\RecaptchaHelper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactForm;
use App\Mail\AnswerForm;
use App\Mail\NewsletterForm;
use App\Http\Resources\MailsResource;
use App\Mails;
use App\Attachments;
use App\Contact;

use Illuminate\Mail\Mailable;

class MailService
{

	public static function questionValidation(array $data): bool
	{
		$validator = Validator::make($data, [
			'email' => 'required|string|email',
			'subject' => 'required|string',
			'message' => 'required|string',
			'name' => 'required|string',
		]);

		return !$validator->fails();
	}

	public static function newsletterValidation(array $data): bool
	{
		$validator = Validator::make($data, [
			'message' => 'required|string',
			'subject' => 'required|string',
		]);

		return !$validator->fails();
	}


	public static function answerValidation(array $data): bool
	{
		$validator = Validator::make($data, [
			'answer_message' => 'required|string',
			'subject' => 'required|string',
			'answer' => 'integer',
			'id' => 'integer',
			'email' => 'required|string|email'
		]);

		return !$validator->fails();
	}

	public static function setRodo(array $data): array
	{
		for ($i = 1; $i < 3; $i++) {
			if (isset($data["rodo$i"]) && $data["rodo$i"]) $data["rodo$i"] = 'Zaakceptowane';
			else $data["rodo$i"] = 'Niezaakceptowane';
		}

		return $data;
	}

	public static function getResponse(Mails $mail): MailsResource
	{
		$response = new MailsResource($mail);
		$response->data = empty(Mail::failures()) ? ResponseHelper::mailSuccessResponse() : ResponseHelper::mailErrorResponse();

		return $response;
	}

	public static function getTemplate(array $data): Mailable
	{
		if (isset($data['answer'])) return new AnswerForm($data);
		else if (isset($data['newsletter'])) return new NewsletterForm($data);
		else return new ContactForm($data);
	}

	public static function checkAttachmentsToDelete(array $data)
	{
		if (isset($data['delete'])) {
			$attachments = Attachments::where('mail_id', $data['id'])->get();
			if (!empty($attachments)) {
				foreach ($attachments as $attachment) {
					FileHelper::deleteFilesFromStorage($attachment->path, 'attachments');
					$attachment->delete();
				}
			}
		}
	}

	public static function saveData(Request $request)
	{
		if ($request->isMethod("POST")) {

			if (!RecaptchaHelper::validate($request->input('response'))) return ResponseHelper::invalidRecaptcha();
		}

		$data = CrudService::prependData($request);
		$validation = isset($data['answer']) ? self::answerValidation($data) : (isset($data['newsletter']) ? self::newsletterValidation($data) : self::questionValidation($data));

		return $validation ?  new MailsResource(CrudService::saveData($request)) : ResponseHelper::validateResponse();
	}

	public static function send(Request $request)
	{
		$data = CrudService::prependData($request);
		$data = self::setRodo($data);
		$data['mail'] = Mails::find($data['id']);

		$receiver = isset($data['answer']) || isset($data['newsletter']) ? $data['email'] : Contact::find(1)->email_1;
		Mail::to($receiver)->send(self::getTemplate($data));

		// self::checkAttachmentsToDelete($data);

		return self::getResponse($data['mail']);
	}
}
