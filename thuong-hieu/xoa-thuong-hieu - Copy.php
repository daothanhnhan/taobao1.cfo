<?php 
	$id = $_GET['id'];
	$sql = "SELECT * FROM mau WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);
	$product_id = $row['product_id'];

	$sql = "DELETE FROM mau WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	header('location: index.php?page=mau&product_id='.$product_id);
?>