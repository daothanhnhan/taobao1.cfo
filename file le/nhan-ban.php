<?php 
if (isset($_POST['duplic'])) {
	include_once dirname(__FILE__) . "/../functions/database.php";

	$product_id_input = $_POST['product_id'];

	$sql = "SHOW COLUMNS FROM product";
	$result = mysqli_query($conn_vn, $sql);
// echo '<pre>';
	// $row = mysqli_fetch_array($result);
	// var_dump($row);
	$cols = array();
	$type = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'product_id') {
			$cols[] = $row['Field'];
			$type[] = $row['Type'];
		}
		// var_dump($row['Field']);
		// var_dump($row['Type']);
	}
	// unset($row[])
	// var_dump($cols['product_producer']);

	$sql = "SELECT * FROM product WHERE product_id  = $product_id_input";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	if (empty($row)) {
		die('Không có sản phẩm này');
	}

	$sql_insert = "INSERT INTO product (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $key => $col) {
		// var_dump($col);
		// var_dump($row[$col]);
		if ($type[$key] == 'int(11)' && $row[$col] == NULL) {
			$row[$col] = 0;
			$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
		} else {
			if ($type[$key] == 'datetime' && $row[$col] == NULL) {
				$sql_insert .= "'" . "0000-00-00 00:00:00" . "', ";
			} else {
				$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
			}
			
		}
		
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert);
	echo mysqli_error($conn_vn);
	$product_id = mysqli_insert_id($conn_vn);
	var_dump($product_id);
	//////////////////////////
	$link = $row['friendly_url'].'-'.$product_id;
	$sql = "UPDATE product SET friendly_url = '$link' WHERE product_id = $product_id";
	mysqli_query($conn_vn, $sql);
	//////////////////////////////// vn
	$sql = "SHOW COLUMNS FROM product_languages";
	$result = mysqli_query($conn_vn, $sql);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'id') {
			$cols[] = $row['Field'];
		}
	}
	$sql = "SELECT * FROM product_languages WHERE product_id  = $product_id_input AND languages_code = 'vn'";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	$sql_insert = "INSERT INTO product_languages (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert);
	// $product_id = mysqli_insert_id($conn_vn);
	$product_vn_id = mysqli_insert_id($conn_vn);

	$sql = "UPDATE product_languages SET product_id = '$product_id', friendly_url = '$link' WHERE id = $product_vn_id";
	$result = mysqli_query($conn_vn, $sql);
	//////////////////////////////// en
	$sql = "SHOW COLUMNS FROM product_languages";
	$result = mysqli_query($conn_vn, $sql);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'id') {
			$cols[] = $row['Field'];
		}
	}
	$sql = "SELECT * FROM product_languages WHERE product_id  = $product_id_input AND languages_code = 'en'";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	$sql_insert = "INSERT INTO product_languages (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert);
	// $product_id = mysqli_insert_id($conn_vn);
	$product_en_id = mysqli_insert_id($conn_vn);

	$sql = "UPDATE product_languages SET product_id = '$product_id', friendly_url = '$link' WHERE id = $product_en_id";
	$result = mysqli_query($conn_vn, $sql);
}
?>
<form action="" method="post">
	<input type="number" name="product_id" required="">
	<button type="submit" name="duplic">Nhân bản sản phẩm</button>
</form>
<hr>
<?php 
if (isset($_POST['duplic_news'])) {
	include_once dirname(__FILE__) . "/../functions/database.php";

	$news_id_input = $_POST['news_id'];

	$sql = "SHOW COLUMNS FROM news";
	$result = mysqli_query($conn_vn, $sql);
// echo '<pre>';
	// $row = mysqli_fetch_array($result);
	// var_dump($row);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'news_id') {
			$cols[] = $row['Field'];
		}
		// var_dump($row['Field']);
		
	}
	// unset($row[])
	// var_dump($cols);

	$sql = "SELECT * FROM news WHERE news_id  = $news_id_input";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	if (empty($row)) {
		die('Không có tin tức này');
	}

	$sql_insert = "INSERT INTO news (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert);
	$news_id = mysqli_insert_id($conn_vn);
	echo mysqli_error($conn_vn);
	var_dump($news_id);
	//////////////////////////
	$link = $row['friendly_url'].'-'.$news_id;
	$sql = "UPDATE news SET friendly_url = '$link' WHERE news_id = $news_id";
	mysqli_query($conn_vn, $sql);
	//////////////////////////////// vn
	$sql = "SHOW COLUMNS FROM news_languages";
	$result = mysqli_query($conn_vn, $sql);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'id') {
			$cols[] = $row['Field'];
		}
	}
	$sql = "SELECT * FROM news_languages WHERE news_id  = $news_id_input AND languages_code = 'vn'";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	$sql_insert = "INSERT INTO news_languages (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert) or die("lỗi");
	// $product_id = mysqli_insert_id($conn_vn);
	$news_vn_id = mysqli_insert_id($conn_vn);

	$sql = "UPDATE news_languages SET news_id = '$news_id', friendly_url = '$link' WHERE id = $news_vn_id";
	$result = mysqli_query($conn_vn, $sql);
	//////////////////////////////// en
	$sql = "SHOW COLUMNS FROM news_languages";
	$result = mysqli_query($conn_vn, $sql);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'id') {
			$cols[] = $row['Field'];
		}
	}
	$sql = "SELECT * FROM news_languages WHERE news_id  = $news_id_input AND languages_code = 'en'";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	$sql_insert = "INSERT INTO news_languages (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert);
	// $product_id = mysqli_insert_id($conn_vn);
	$news_en_id = mysqli_insert_id($conn_vn);

	$sql = "UPDATE news_languages SET news_id = '$news_id', friendly_url = '$link' WHERE id = $news_en_id";
	$result = mysqli_query($conn_vn, $sql);
}
?>
<form action="" method="post">
	<input type="number" name="news_id" required="">
	<button type="submit" name="duplic_news">Nhân bản tin tức</button>
</form>
<hr>
<?php 
if (isset($_POST['duplic_service'])) {
	include_once dirname(__FILE__) . "/../functions/database.php";

	$service_id_input = $_POST['service_id'];

	$sql = "SHOW COLUMNS FROM service";
	$result = mysqli_query($conn_vn, $sql);
// echo '<pre>';
	// $row = mysqli_fetch_array($result);
	// var_dump($row);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'service_id') {
			$cols[] = $row['Field'];
		}
		// var_dump($row['Field']);
		
	}
	// unset($row[])
	// var_dump($cols);

	$sql = "SELECT * FROM service WHERE service_id  = $service_id_input";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	if (empty($row)) {
		die('Không có tin tức này');
	}

	$sql_insert = "INSERT INTO service (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert) or die("lỗi");
	$service_id = mysqli_insert_id($conn_vn);
	var_dump($service_id);
	//////////////////////////
	$link = $row['friendly_url'].'-'.$service_id;
	$sql = "UPDATE service SET friendly_url = '$link' WHERE service_id = $service_id";
	mysqli_query($conn_vn, $sql);
	//////////////////////////////// vn
	$sql = "SHOW COLUMNS FROM service_languages";
	$result = mysqli_query($conn_vn, $sql);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'id') {
			$cols[] = $row['Field'];
		}
	}
	$sql = "SELECT * FROM service_languages WHERE service_id  = $service_id_input AND languages_code = 'vn'";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	$sql_insert = "INSERT INTO service_languages (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		if ($row[$col] == NULL) {
			$row[$col] = 0;
		}
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert);
	echo mysqli_error($conn_vn);
	// $product_id = mysqli_insert_id($conn_vn);
	$service_vn_id = mysqli_insert_id($conn_vn);

	$sql = "UPDATE service_languages SET service_id = '$service_id', friendly_url = '$link' WHERE id = $service_vn_id";
	$result = mysqli_query($conn_vn, $sql);
	//////////////////////////////// en
	$sql = "SHOW COLUMNS FROM service_languages";
	$result = mysqli_query($conn_vn, $sql);
	$cols = array();
	while ($row = mysqli_fetch_array($result)) {
		if ($row['Field'] != 'id') {
			$cols[] = $row['Field'];
		}
	}
	$sql = "SELECT * FROM service_languages WHERE service_id  = $service_id_input AND languages_code = 'en'";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_array($result);

	$sql_insert = "INSERT INTO service_languages (" . implode(", ",$cols) . ") VALUES (";

	foreach ($cols as $col) {
		$sql_insert .= "'" . mysqli_real_escape_string($conn_vn, $row[$col]) . "', ";
	}

	$sql_insert = substr($sql_insert, 0, -2);

	$sql_insert .= ")";
	// echo $sql_insert;
	$result = mysqli_query($conn_vn, $sql_insert);
	// $product_id = mysqli_insert_id($conn_vn);
	$service_en_id = mysqli_insert_id($conn_vn);

	$sql = "UPDATE service_languages SET service_id = '$service_id', friendly_url = '$link' WHERE id = $service_en_id";
	$result = mysqli_query($conn_vn, $sql);
}
?>
<form action="" method="post">
	<input type="number" name="service_id" required="">
	<button type="submit" name="duplic_service">Nhân bản dịch vụ</button>
</form>