<?php 
	include_once dirname(__FILE__) . "/../../database.php";
	include_once dirname(__FILE__) . "/../../library.php";
	include_once dirname(__FILE__) . "/../../action.php";

	$action = new action();

	$name = $_POST['name'];
	$name = mysqli_real_escape_string($conn_vn, $name);
	$name = html_entity_decode($name);

	// var_dump($name);die;
	$mo_ta = $_POST['mo_ta'];
	$the_alt = $_POST['the_alt'];
	// echo $_POST['des'];
	// $des = mysqli_real_escape_string($conn_vn, $_POST['des']);
	$content = mysqli_real_escape_string($conn_vn, $_POST['content']);
	// $code = mysqli_real_escape_string($conn_vn, $_POST['code']);
	// echo $_GET['des'];
	// $img = explode(",", $_POST['img']);
	// $img = json_encode($img);
	// $img = mysqli_real_escape_string($conn_vn, $img);

	// $brand = mysqli_real_escape_string($conn_vn, $_POST['brand']);
	$img_content = mysqli_real_escape_string($conn_vn, $_POST['img_content']);

	// $content1 = mysqli_real_escape_string($conn_vn, $_POST['content1']);
	// $content2 = mysqli_real_escape_string($conn_vn, $_POST['content2']);
	// $des_seo = mysqli_real_escape_string($conn_vn, $_POST['des_seo']);


	// echo $content;

	$sql = "UPDATE product_1 SET name = '$name', mo_ta = '$mo_ta', the_alt = '$the_alt', content = '$content', img = '$img_content' WHERE id = 1";
	$result = mysqli_query($conn_vn, $sql);
	if ($result) {
		echo 'thanh cong';
	} else {
		echo 'that bai';
		echo mysqli_error($conn_vn);
	}
?>