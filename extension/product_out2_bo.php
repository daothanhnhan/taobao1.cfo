<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$name = $_POST['name'];
	// echo $name;

	$product = $action->getDetail('product', 'id', 2);
	$product = json_encode($product);
	echo $product;
?>