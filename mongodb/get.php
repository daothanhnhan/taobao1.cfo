<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://caosim-5596.restdb.io/rest/simdienthoai",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 4f4a5d2d-db5d-bd8f-3021-6e46e6904a7a",
    "x-apikey: dd155a4117e3989a8d20fd2462b66268f31cb"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}