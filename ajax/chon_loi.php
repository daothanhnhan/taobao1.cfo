<?php 
	include_once dirname(__FILE__) . "/../database.php";

	$id = $_GET['id'];//echo $id;

	$sql = "SELECT * FROM admin_link_2 WHERE id = $id";//echo $sql;
	$result = mysqli_query($conn_vn, $sql);

	$row = mysqli_fetch_assoc($result);//var_dump($row);

	if ($row['error'] == 1) {
		$sql = "UPDATE admin_link_2 SET error = 0 WHERE id = $id";
	} else {
		$sql = "UPDATE admin_link_2 SET error = 1 WHERE id = $id";
	}
	$result = mysqli_query($conn_vn, $sql);

	$sql = "SELECT * FROM admin_link_2 WHERE error = 1";
	$result = mysqli_query($conn_vn, $sql);
	$num = mysqli_num_rows($result);
	echo $num;