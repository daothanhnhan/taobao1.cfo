<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$name = $_POST['name'];
	$name = mysqli_real_escape_string($conn_vn, $name);
	$name = html_entity_decode($name);

	$price1 = $_POST['price1'];
	$price2 = $_POST['price2'];
	// echo $_POST['des'];
	$des = mysqli_real_escape_string($conn_vn, $_POST['des']);
	$content = mysqli_real_escape_string($conn_vn, $_POST['content']);
	$code = mysqli_real_escape_string($conn_vn, $_POST['code']);
	// echo $_GET['des'];
	$img = explode(",", $_POST['img']);
	$img = json_encode($img);
	$img = mysqli_real_escape_string($conn_vn, $img);

	$brand = mysqli_real_escape_string($conn_vn, $_POST['brand']);
	$img_content = mysqli_real_escape_string($conn_vn, $_POST['img_content']);

	// echo $content;

	$sql = "UPDATE product SET name = '$name', price = '$price1', price_sale = '$price2', des = '$des', note = '$content', image = '$img', product_code = '$code', list_danh_muc = '$brand', image_content = '$img_content' WHERE id = 4";
	$result = mysqli_query($conn_vn, $sql);
	if ($result) {
		echo 'thanh cong';
	} else {
		echo 'that bai';
		echo mysqli_error($conn_vn);
	}
?>