<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$name = $_POST['name'];
	$name = mysqli_real_escape_string($conn_vn, $name);
	$name = html_entity_decode($name);

	$price = $_POST['price'];
	$des = mysqli_real_escape_string($conn_vn, $_POST['des']);
	$content = mysqli_real_escape_string($conn_vn, $_POST['content']);
	// echo $_GET['des'];
	$img = explode(",", $_POST['img']);
	$img = json_encode($img);
	$img = mysqli_real_escape_string($conn_vn, $img);

	$sql = "UPDATE product SET name = '$name', price = '$price', des = '$des', note = '$content', image = '$img' WHERE id = 1";
	$result = mysqli_query($conn_vn, $sql);
	if ($result) {
		echo 'thanh cong';
	} else {
		echo 'that bai';
		echo mysqli_error($conn_vn);
	}
?>