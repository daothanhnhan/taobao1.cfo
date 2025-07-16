<?php 
	include_once dirname(__FILE__) . "/database.php";
	include_once dirname(__FILE__) . "/library.php";
	include_once dirname(__FILE__) . "/action.php";

	$action = new action();

	$list_sp = $action->getList('admin_link_2', '', '', 'id', 'asc', '', '', '');
	echo '<pre>';
	// $arr_sp = array();
	foreach ($list_sp as $row) {
		$sp = $action->getList('admin_link_2', 'name', $row['name'], 'id', 'asc', '', '', '');
		$sp_count = count($sp);
		if ($sp_count != 1) {
			$arr_sp[] = $row['id'];
			// var_dump($sp_count);
		}
	}
	echo '<pre>';
	// var_dump($arr_sp);
	foreach ($arr_sp as $item) {
		$sp_item = $action->getDetail('admin_link_2', 'id', $item);
		if ($sp_item['done'] == 1) {
			echo $sp_item['id'].$sp_item['name'].'<br>';
			var_dump($sp_item);
		}
	}