<?php 
	include_once dirname(__FILE__) . "/../database.php";

	$id = $_GET['id'];//echo $id;
	$text = $_GET['text'];
	$text = mysqli_real_escape_string($conn_vn, $text);

	$sql = "UPDATE admin_link_2 SET note = '$text' WHERE id = $id";//echo $sql;
	$result = mysqli_query($conn_vn, $sql);