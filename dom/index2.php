<?php 
	echo 'dom<br>';
	// $html = file_get_contents('http://www.google.com/');
	// $html = file_get_contents('https://vi.aliexpress.com/');
	// $html = file_get_contents('http://vi.aliexpress.com/');
	// $html = file_get_contents('http://vi.aliexpress.com/item/1005004499605665.html');
	// var_dump($html);

	$c = curl_init('http://vi.aliexpress.com/');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
//curl_setopt(... other options you want...)

$html = curl_exec($c);

if (curl_error($c))
    die(curl_error($c));

// Get the status code
$status = curl_getinfo($c, CURLINFO_HTTP_CODE);

var_dump($status);
echo '<br>';
curl_close($c);

	echo date("H:i:s");
?>