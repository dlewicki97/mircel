<?php
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Services\CrudService;

class TokenDecoder {

	public static function decode(string $bearerToken): object {
		$tokenParts = explode(".", $bearerToken);

		if(count($tokenParts) != 3 || !$bearerToken) {
			throw new \Exception("Invalid Bearer Token!");
		} 
		$tokenPayload = base64_decode($tokenParts[1]);
		$jwtPayload = json_decode($tokenPayload);
		if($jwtPayload == null) throw new \Exception("Invalid Bearer Token!");

		return $jwtPayload;
	}
}