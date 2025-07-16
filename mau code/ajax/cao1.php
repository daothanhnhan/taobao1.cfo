<?php 
	include_once dirname(__FILE__) . "/../../database.php";

	$cap = $_GET['cap'];
	$code = $_GET['code'];
	$name = $_GET['name'];
	// echo $cap.$code.$name;

	$sql = "INSERT INTO linh_vuc_1 (cap, code, name) VALUES ('$cap', '$code', '$name')";
	// $result = mysqli_query($conn_vn, $sql);