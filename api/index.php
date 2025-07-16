<?php

$curl = curl_init();

// curl_setopt_array($curl, [
// 	CURLOPT_URL => "https://taobao-advanced.p.rapidapi.com/api?num_iid=535345687048&api=item_detail&area_id=110100",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_FOLLOWLOCATION => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => [
// 		"x-rapidapi-host: taobao-advanced.p.rapidapi.com",
// 		"x-rapidapi-key: ca61454f56msh24ecf78400c7becp145419jsna00fb9a9e0dc"
// 	],
// ]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	// echo $response;
	$response = json_decode($response, true);
	// var_dump($response);
	var_dump($response['result']['item']['detail_url']);
	var_dump($response['result']['item']['desc_imgs']);
}



$curl = curl_init();

// curl_setopt_array($curl, [
// 	CURLOPT_URL => "https://taobao-tmall-product-data-v2.p.rapidapi.com/api/sc/taobao/item_detail?item_id=572562908321",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_FOLLOWLOCATION => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => [
// 		"x-rapidapi-host: taobao-tmall-product-data-v2.p.rapidapi.com",
// 		"x-rapidapi-key: ca61454f56msh24ecf78400c7becp145419jsna00fb9a9e0dc"
// 	],
// ]);

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
	var_dump($response['data']['title']);
	var_dump($response['data']['video_url']);
	var_dump($response['data']['main_imgs']);

	$thuoc_tinh = $response['data']['sku_props'];
	$thuoc_tinh_gia = $response['data']['skus'];

	$ten = array();
	$gia = array();
	$anh = array();

	// foreach ($thuoc_tinh as $item1) {
	// 	foreach ($item1['values'] as $item2) {
	// 		$ten[] = $item2['name'];
	// 		$anh[] = $item2['imageUrl'];
	// 		foreach ($thuoc_tinh_gia as $tien) {
	// 			$props_ids = $item1['pid'] . ':' . $item2['vid'];//var_dump($props_ids);
	// 			if ($tien['props_ids'] == $props_ids) {
	// 				$gia[] = $tien['sale_price'];
	// 			}
	// 		}
	// 	}
	// }

	// $ten_temp = array()
	// $d = 0;
	// $k = 0;
	// $chieu = count($thuoc_tinh);
	// $do_dai_moi_chieu = array();
	// foreach ($thuoc_tinh as $item1) {
	// 	$do_dai_moi_chieu[] = count($item1['values']);
	// }


	$d = -1;

	foreach ($thuoc_tinh_gia as $item1) {
		$d++;
		$gia[$d] = $item1['sale_price'];
		$props_ids = $item1['props_ids'];
		$props_ids_arr = explode(";", $props_ids);
		foreach ($props_ids_arr as $item2) {
			foreach ($thuoc_tinh as $item3) {
				foreach ($item3['values'] as $item4) {
					$props_ids_1 = $item3['pid'] . ':' . $item4['vid'];
					if ($item2 == $props_ids_1) {
						$ten[$d] .= $item4['name'] . ' ';
						if (empty($anh[$d])) {
							$anh[$d] = $item4['imageUrl'];
						}
					}
				}
			}
		}
	}

	var_dump($ten);
	var_dump($anh);
	var_dump($gia);
}
// 572562908321
// 603962804770



$curl = curl_init();

// curl_setopt_array($curl, [
// 	CURLOPT_URL => "https://taobao-tmall-product-data-v2.p.rapidapi.com/api/sc/taobao/item_desc?item_id=589168080273",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_FOLLOWLOCATION => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 30,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => [
// 		"x-rapidapi-host: taobao-tmall-product-data-v2.p.rapidapi.com",
// 		"x-rapidapi-key: ca61454f56msh24ecf78400c7becp145419jsna00fb9a9e0dc"
// 	],
// ]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	// echo $response;
	$response = json_decode($response, true);
	var_dump($response['data']['detail_html']);
}