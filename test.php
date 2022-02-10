<?php
$bearerToken = 'token.token.token';
$tokenParts = explode(".", $bearerToken);

if(count($tokenParts) != 3 || !$bearerToken) return (object)['message' => 'Invalid Bearer Token!'];  
$tokenPayload = base64_decode($tokenParts[1]);
var_dump($tokenPayload);die;
if($tokenPayload == null) return (object)['message' => 'Invalid Bearer Token!'];
$jwtPayload = json_decode($tokenPayload);

return $jwtPayload;