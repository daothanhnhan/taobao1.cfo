<?php 
	include_once dirname(__FILE__) . "/../database.php";

	$id = $_GET['id'];//echo $id;

	$sql = "SELECT * FROM admin_link_2 WHERE id = $id";//echo $sql;
	$result = mysqli_query($conn_vn, $sql);

	$row = mysqli_fetch_assoc($result);//var_dump($row);

	if ($row['done'] == 1) {
		$sql = "UPDATE admin_link_2 SET done = 0 WHERE id = $id";
	} else {
		$sql = "UPDATE admin_link_2 SET done = 1 WHERE id = $id";
	}
	$result = mysqli_query($conn_vn, $sql);

	$name = $row['name'];
	$sql = "SELECT * FROM admin_link_2 WHERE name = '$name'";
	$result = mysqli_query($conn_vn, $sql);
	$so = mysqli_num_rows($result);
	if ($so != 1) {
		$sql = "UPDATE admin_link_2 SET da_dang = 1 WHERE name = '$name'";
		$result = mysqli_query($conn_vn, $sql);
	}

	$sql = "SELECT * FROM admin_link_2 WHERE done = 1";
	$result = mysqli_query($conn_vn, $sql);
	$num = mysqli_num_rows($result);
	echo $num;