<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	die('dung');

	$cap_1 = $action->getList('linh_vuc_1', 'cap', '1', 'code', 'asc', '', '', '');
	$cap_2 = $action->getList('linh_vuc_1', 'cap', '2', 'code', 'asc', '', '', '');
	$cap_3 = $action->getList('linh_vuc_1', 'cap', '3', 'code', 'asc', '', '', '');
	$cap_4 = $action->getList('linh_vuc_1', 'cap', '4', 'code', 'asc', '', '', '');
	$cap_5 = $action->getList('linh_vuc_1', 'cap', '5', 'code', 'asc', '', '', '');

	foreach ($cap_1 as $item_1) {

		echo $item_1['code'];echo '<br>';
		$name_1 = $item_1['name'];
		$ma_1 = $item_1['code'];
		$sql_1 = "INSERT INTO linh_vuc (name, code, parent) VALUES ('$name_1', '$ma_1', 0)";
		$result_1 = mysqli_query($conn_vn, $sql_1);
		$id_1 = mysqli_insert_id($conn_vn);

		foreach ($cap_2 as $item_2) {

			echo $item_2['code'];echo '<br>';
			$name_2 = $item_2['name'];
			$ma_2 = $item_2['code'];
			$sql_2 = "INSERT INTO linh_vuc (name, code, parent) VALUES ('$name_2', '$ma_2', '$id_1')";
			$result_2 = mysqli_query($conn_vn, $sql_2);
			$id_2 = mysqli_insert_id($conn_vn);

			foreach ($cap_3 as $item_3) {

				$code_3 = substr($item_3['code'], 0, 2);
				

				if ($code_3 == $item_2['code']) {

					echo $item_3['code'];echo '<br>';
					$name_3 = $item_3['name'];
					$ma_3 = $item_3['code'];
					$sql_3 = "INSERT INTO linh_vuc (name, code, parent) VALUES ('$name_3', '$ma_3', '$id_2')";
					$result_3 = mysqli_query($conn_vn, $sql_3);
					$id_3 = mysqli_insert_id($conn_vn);
					
					foreach ($cap_4 as $item_4) {

						$code_4 = substr($item_4['code'], 0, 3);

						if ($code_4 == $item_3['code']) {

							echo $item_4['code'];echo '<br>';
							$name_4 = $item_4['name'];
							$ma_4 = $item_4['code'];
							$sql_4 = "INSERT INTO linh_vuc (name, code, parent) VALUES ('$name_4', '$ma_4', '$id_3')";
							$result_4 = mysqli_query($conn_vn, $sql_4);
							$id_4 = mysqli_insert_id($conn_vn);

							foreach ($cap_5 as $item_5) {
								$code_5 = substr($item_5['code'], 0, 4);

								if ($code_5 == $item_4['code']) {
									echo $item_5['code'];echo '<br>';
									$name_5 = $item_5['name'];
									$ma_5 = $item_5['code'];
									$sql_5 = "INSERT INTO linh_vuc (name, code, parent) VALUES ('$name_5', '$ma_5', '$id_4')";
									$result_5 = mysqli_query($conn_vn, $sql_5);
									$id_5 = mysqli_insert_id($conn_vn);
								}
							}
						}
					}
				}
			}
		}
	}