<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	function get_img ($link) {
		$arr = explode("/", $link);
		return end($arr);
	}

	$product_id = $_GET['product_id'];

	$product = $action->getDetail('product', 'product_id', $product_id);

	$productcat = $action->getList('productcat', '', '', 'productcat_id', 'asc', '', '', '');

	$list_danh_muc = $product['product_des2'];

	$list_danh_muc_arr = explode(",", $list_danh_muc);//var_dump($list_danh_muc_arr);

	$arr_cat = array();

	foreach ($list_danh_muc_arr as $item) {
		foreach ($productcat as $procat) {
			if ($item == $procat['productcat_name']) {
				$arr_cat[] = $procat['productcat_id'];
			}
		}
	}

	// var_dump($arr_cat);
	$cat = implode(",", $arr_cat);

	/////////////////////
	$list_anh = $product['product_des3'];
	$list_anh_arr = json_decode($list_anh, true);//var_dump($list_anh_arr);
	$d = 0;
	$sub_img = array();
	foreach ($list_anh_arr as $item) {

		$nguon = str_replace("-100x100", "", $item);
		$dich = get_img($nguon);
		$dich_1 = $dich;
		$dich = dirname(__FILE__) . "/../../images/".$dich;
		// echo $dich;
		if ($d == 0) {
			$product_img = $dich_1;
		}
		$sub_img[] = json_encode(array('image'=>$dich_1));
		copy($nguon, $dich);
		$d++;
	}
	$sub_img = json_encode($sub_img);
	$sub_img = mysqli_real_escape_string($conn_vn, $sub_img);
	// var_dump($sub_img);
	$product_img_nguon = 'http://winluxury.cafelink.org/images/'.$product_img;
	// var_dump($product_img_nguon);
	$product_img_main = $product['friendly_url'].'-main.jpg';
	$product_img_dich =  dirname(__FILE__) . "/../../images/".$product_img_main;
	// copy($product_img_nguon, $product_img_dich);
	//////////////////////
	mkdir(dirname(__FILE__) . "/../../image/images/".$product_id);
	$anh_noi_dung = $product['product_content2'];
	$anh_noi_dung_arr = explode(",", $anh_noi_dung);//var_dump($anh_noi_dung_arr);
	foreach ($anh_noi_dung_arr as $item) {

		$dich = get_img($item);
		$dich = dirname(__FILE__) . "/../../image/images/".$product_id."/".$dich;
		copy($item, $dich);
	}
	//////////////////////
	$product_content = $product['product_content'];
	// $product_content = preg_replace("/<img[^>]+\>/i", "", $product_content);
	$product_content = str_replace('<img alt="✔️" src="https://s.w.org/images/core/emoji/14.0.0/svg/2714.svg" />', '', $product_content);
	$product_content = str_replace('<img draggable="false" role="img" class="emoji" alt="✔️" src="https://s.w.org/images/core/emoji/14.0.0/svg/2714.svg">', '', $product_content);
	$product_content = str_replace('<img draggable="false" role="img" class="emoji" alt="✅" src="https://s.w.org/images/core/emoji/14.0.0/svg/2705.svg">', '', $product_content);
	$product_content = str_replace('<img draggable="false" role="img" class="emoji" alt="🌿" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f33f.svg">', '', $product_content);
	$product_content = str_replace('<img alt="✅" src="https://s.w.org/images/core/emoji/14.0.0/svg/2705.svg" />', '', $product_content);
	$product_content = str_replace('<img alt="🌿" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f33f.svg" />', '', $product_content);
	// var_dump($product_content);
	// die;
	$product_content_luu = $product_content;
	foreach ($anh_noi_dung_arr as $item) {
		$dich = get_img($item);
		$dich = "/image/images/".$product_id."/".$dich;
		$product_content_luu = str_replace($item, $dich, $product_content_luu);
		// var_dump($item);
		// var_dump($dich);
		// die;
	}
	// var_dump($product_content_luu);
	// var_dump(explode('MỌI TH&Ocirc;NG TIN CHI TIẾT XIN LI&Ecirc;N HỆ:', $product_content_luu)[1]);
	$product_content_luu = explode('MỌI TH&Ocirc;NG TIN CHI TIẾT XIN LI&Ecirc;N HỆ:', $product_content_luu)[0];
	$product_content_luu = explode('MỌI THÔNG TIN CHI TIẾT XIN LIÊN HỆ:', $product_content_luu)[0];
	// var_dump()
	$product_content_luu = preg_replace("/(<img\\s)[^>]*(src=\\S+)[^>]*(\\/?>)/i", "$1$2$3", $product_content_luu);
	// $product_content_luu = str_replace('<img src="/image/images/'.$product_id.'/2714.svg">', "", $product_content_luu);
	// var_dump($product_content_luu);
	$product_content_luu = mysqli_real_escape_string($conn_vn, $product_content_luu);
	// var_dump($product_content_luu);
	
	// var_dump($html);
	//////////////////////

	$sql = "UPDATE product SET productcat_ar = '$cat', product_img = '$product_img', product_sub_img = '$sub_img', product_content = '$product_content_luu' WHERE product_id = $product_id";//echo $sql;
	$result = mysqli_query($conn_vn, $sql);

	$sql = "UPDATE product_languages SET lang_product_content = '$product_content_luu' WHERE product_id = $product_id";
	$result = mysqli_query($conn_vn, $sql);

	if ($result) {

	} else {
		echo 'loi';
	}

	echo 'thành công';