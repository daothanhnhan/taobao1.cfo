<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://taobao-tmall1.p.rapidapi.com/BatchGetItemFullInfo?language=en&itemId=569413768524",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: taobao-tmall1.p.rapidapi.com",
		"X-RapidAPI-Key: ca61454f56msh24ecf78400c7becp145419jsna00fb9a9e0dc"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	// echo $response;
	echo '<pre>';
	$response = json_decode($response, true);
	var_dump($response);
	$thuoc_tinh_gia = $response['Result']['Item']['Promotions'][0]['ConfiguredItems'];
	var_dump($thuoc_tinh_gia);
}
// 576748958985
// 622198060109 // có link video
// 674511228550 có giá gốc và giá khuyến mãi
// 676192271911
// 614652287664 có 2 pid vid của giá, không có khuyến mãi
// 654097564737 không có ảnh thuộc tính
// 649603694289 không có ảnh thuộc tính và tên alias
// 614652287664 có ảnh thuộc tính
// Attributes  ConfiguredItems