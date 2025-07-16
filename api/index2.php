<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://taobao-tmall-data-service.p.rapidapi.com/Item/ItemGet.ashx?num_iid=610809612255",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: taobao-tmall-data-service.p.rapidapi.com",
		"X-RapidAPI-Key: ca61454f56msh24ecf78400c7becp145419jsna00fb9a9e0dc"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
	var_dump($response);
	echo '<pre>';
	$response = json_decode($response, true);
	var_dump($response);
}
// 610809612255
// 603962804770
// 572562908321
// 603662131958