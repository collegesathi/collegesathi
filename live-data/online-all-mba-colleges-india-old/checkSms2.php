<?php

$mobile = $_REQUEST['Mobile'];
$otp 	= rand(1000,9999);

$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://control.msg91.com/api/v5/otp?template_id=648c4d76d6fc0563463856e5&mobile=91".$mobile,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode([
		'OTP' => $otp
	]),
	CURLOPT_HTTPHEADER => [
		"accept: application/json",
		"authkey: 398466AqfN6xUoBa648c4dafP1",
		"content-type: application/json"
	],
]);

$response 	= curl_exec($curl);
$err 		= curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} 
else {
	$responseArray = json_decode($response, true);
	$responseArray['OTP'] = $otp;
	$json = json_encode($responseArray);
	echo $json;
}