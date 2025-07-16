<?php 
	include_once dirname(__FILE__) . "/../functions/database.php";
	include_once dirname(__FILE__) . "/../functions/library.php";
	include_once dirname(__FILE__) . "/../functions/action.php";

	$action = new action();

	if (isset($_POST['del-product'])) {
		echo '<pre>';
		$product_id = $_POST['product_id'];
		$product = $action->getDetail('product', 'product_id', $product_id);
		// var_dump($product['product_img']);
		// var_dump($product['product_sub_img']);
		$list_product = $action->getList('product', '', '', 'product_id', 'desc', '', '', '');
		foreach ($list_product as $pro) {
			$product_sub_img = json_decode($pro['product_sub_img']);
			// var_dump($product_sub_img);
			foreach ($product_sub_img as $item) {
				$img_sub = json_decode($item, true);
				var_dump($img_sub['image']);
				$link = dirname(__FILE__) .'/../images/'. $img_sub['image'];
				unlink($link);
			}
		}

		
	}
?>
<form action="" method="post" accept-charset="utf-8">
	<input type="number" name="product_id" value="">
	<button type="submit" name="del-product">Xóa ảnh sản phẩm</button>
</form>