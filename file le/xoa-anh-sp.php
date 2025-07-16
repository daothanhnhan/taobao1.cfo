<?php 
	include_once dirname(__FILE__) . "/../functions/database.php";	
	include_once dirname(__FILE__) . "/../functions/library.php";	
	include_once dirname(__FILE__) . "/../functions/action.php";	

	$action = new action();

	$product = $action->getDetail('product', 'product_id', 260);//var_dump($product['product_sub_img']);

	$list_product = $action->getList('product', '', '', 'product_id', 'desc', '', '', '');

	foreach ($list_product as $product) {
		$img_chinh = $product['product_img'];
		$link = dirname(__FILE__) . "/../images/";
		// echo 'http://nguyviet.cafelink.org/images/'.$img_chinh;
		$url = $link.$img_chinh;//var_dump($url);
		// unlink($url);

		$img_sub = $product['product_sub_img'];
		$img_sub_arr = json_decode($img_sub, true);
		foreach ($img_sub_arr as $img_item) {
			// var_dump($img_item);
			$img_item = json_decode($img_item, true);
			// var_dump($img_item['image']);
			$url = $link.$img_item['image'];
			// unlink($url);
		}
	}


	$list_news = $action->getList('news', '', '', 'news_id', 'desc', '', '', '');

	foreach ($list_news as $news) {
		$img_chinh = $news['news_img'];
		$link = dirname(__FILE__) . "/../images/";
		// echo 'http://nguyviet.cafelink.org/images/'.$img_chinh;
		$url = $link.$img_chinh;//var_dump($url);
		// unlink($url);
	}

	
echo 'thành công';