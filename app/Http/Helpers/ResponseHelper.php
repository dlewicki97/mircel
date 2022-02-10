<?php

namespace App\Http\Helpers;

use Illuminate\Http\Response;
use App\Http\Resources\ResponseResource;
use App\SnackbarAlerts;

class ResponseHelper
{

	public static function validateResponse()
	{
		return new Response(json_encode([
			'error' => [
				'message' => SnackbarAlerts::find(1)->validate,
				'code' => 400,
				'status' => false
			]
		]), 200);
	}

	public static function productsAvailableError($availableResponse)
	{
		return [
			"error" => [
				'data' => $availableResponse,
				'code' => 200,
				'status' => false,
			]
		];
	}

	public static function passwordError()
	{
		return new Response(json_encode([
			'error' => [
				'message' => SnackbarAlerts::find(1)->password_error,
				'code' => 400,
				'status' => false
			]
		]), 200);
	}

	public static function changePasswordSuccess()
	{
		return new Response(json_encode([
			'success' => [
				'message' => SnackbarAlerts::find(1)->change_password_success,
				'code' => 200,
				'status' => true
			]
		]), 200);
	}

	public static function luckyNumber($number)
	{
		return new Response(json_encode([
			'success' => [
				'message' => str_replace('{id}', $number, SnackbarAlerts::find(1)->lucky_number),
				'code' => 200,
				'status' => true
			]
		]), 200);
	}

	public static function nonActivatedAccount()
	{
		return new Response(json_encode([
			'error' => [
				'message' => SnackbarAlerts::find(1)->non_activated_account,
				'code' => 400,
				'status' => false
			]
		]), 200);
	}

	public static function blockedUser()
	{
		return new Response(json_encode([
			'error' => [
				'message' => SnackbarAlerts::find(1)->blocked_user,
				'code' => 400,
				'status' => false
			]
		]), 200);
	}

	public static function findUserResponse()
	{
		return new Response(json_encode([
			'error' => [
				'message' => SnackbarAlerts::find(1)->user_exist,
				'code' => 400,
				'status' => false
			]
		]), 200);
	}

	public static function userDoesNotExist()
	{
		return new Response(json_encode([
			'error' => [
				'message' => SnackbarAlerts::find(1)->user_does_not_exist,
				'code' => 400,
				'status' => false
			]
		]), 200);
	}

	public static function mailSuccessResponse()
	{
		return [
			"success" => [
				'message' => SnackbarAlerts::find(1)->mail_success,
				'code' => 201,
				'status' => true
			]
		];
	}

	public static function passwordReminderSuccess()
	{
		return new Response(json_encode([
			"success" => [
				'message' => SnackbarAlerts::find(1)->password_reminder_success,
				'code' => 201,
				'status' => true
			]
		]), 200);
	}

	public static function mailErrorResponse()
	{
		return [
			"error" => [
				'message' => SnackbarAlerts::find(1)->mail_error,
				'code' => 500,
				'status' => false
			]
		];
	}

	public static function invalidRecaptcha()
	{
		return [
			"error" => [
				'message' => SnackbarAlerts::find(1)->recaptcha_error,
				'code' => 500,
				'status' => false
			]
		];
	}
}
