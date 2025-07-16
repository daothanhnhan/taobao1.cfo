<?php
  function base64url_encode($text) {
      $base64 = base64_encode($text);
      $base64 = trim($base64, "=");
      $base64url = strtr($base64, "+/", "-_");
      return $base64url;
  }

	function generate_state_param() {
	    // a random 8 digit hex, for instance
	    return bin2hex(openssl_random_pseudo_bytes(4));
	}

  function generate_pkce_codes() {
      $random = bin2hex(openssl_random_pseudo_bytes(32)); // a random 64-digit hex
      $code_verifier = base64url_encode(pack('H*', $random));
      $code_challenge = base64url_encode(pack('H*', hash('sha256', $code_verifier)));
      return array($code_verifier, $code_challenge);
  }


	$url = $_SERVER['REQUEST_URI'];
	$url = str_replace("/login-zalo?", "", $url);
	$url_arr = explode("&", $url);
	// var_dump($url_arr[0]);
	$code = $url_arr[0];
	$code = str_replace("code=", "", $code);
	// var_dump($code);
	// echo $code;
?>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://oauth.zaloapp.com/v4/access_token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "code=$code&app_id=343923244309538428&grant_type=authorization_code&code_verifier=".$_SESSION['code_verifier'],
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: 6a34e5e3-18aa-2438-b3f2-ad89146aca9c",
    "secret_key: Q5I9E5g1fIgZxxPNA8FE"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
  $response_arr = json_decode($response, true);
  // var_dump($response_arr);
  $access_token = $response_arr['access_token'];
}

?>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://graph.zalo.me/v2.0/me?fields=id%2Cname%2Cpicture",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "access_token: $access_token",
    "cache-control: no-cache",
    "postman-token: 0c138a8e-1c8c-5f19-9c9b-1241f8497d05"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
  $response_arr_profile = json_decode($response, true);
  var_dump($response_arr_profile);
}
?>
<!-- <a target="_blank" href="https://oauth.zaloapp.com/v4/permission?app_id=343923244309538428&redirect_uri=https://chonhatot.com/login-zalo&code_challenge=<?= $code_challenge ?>&state=<?= $state ?>" title="">login zalo</a> -->
<!-- https://hainh.me/zalo-api-php-tao-va-cau-hinh-ung-dung.html -->