<?php

namespace App\Http\Helpers;

use App\Settings;

class RecaptchaHelper
{

	public static function validate($response)
	{

		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = ['secret' => "6Lfdvf0cAAAAAOG2-1MqPLun3rGgKbmvn7KxldRe", 'response' => $response, 'remoteip' => $_SERVER['REMOTE_ADDR']];

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);

		curl_close($ch);


		return json_decode($result, true)['success'];
	}
}
