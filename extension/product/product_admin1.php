<?php 
	include_once dirname(__FILE__) . "/database.php";
	// include_once dirname(__FILE__) . "/../library.php";
	// include_once dirname(__FILE__) . "/../action.php";

	// $action = new action();

	$name = json_decode($_POST['name'], true);
	$link = json_decode($_POST['link'], true);
	$procat = json_decode($_POST['procat'], true);
	// var_dump($procat);
	// var_dump($link);
	// $link = explode(",", $_POST['code1']);
	// var_dump($link);
	// var_dump($_POST['code']);

	foreach ($link as $k => $item) {
		$ten = mysqli_real_escape_string($conn_vn, $name[$k]);
		$danh_muc = mysqli_real_escape_string($conn_vn, $procat[$k]);
		$sql = "INSERT INTO admin_link_2 (link, name, procat, loai) VALUES ('$item', '$ten', '$danh_muc', 8)";//echo $sql;
		// $result = mysqli_query($conn_vn, $sql);
	}

?>