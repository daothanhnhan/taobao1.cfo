<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$cap_1 = $action->getList('linh_vuc', 'parent', '0', 'code', 'asc', '', '', '');
	foreach ($cap_1 as $item_1) {
		echo $item_1['code'];echo '<br>';
		$cap_2 = $action->getList('linh_vuc', 'parent', $item_1['id'], 'code', 'asc', '', '', '');
		foreach ($cap_2 as $item_2) {
			echo $item_2['code'];echo '<br>';
			$cap_3 = $action->getList('linh_vuc', 'parent', $item_2['id'], 'code', 'asc', '', '', '');
			foreach ($cap_3 as $item_3) {
				echo $item_3['code'];echo '<br>';
				$cap_4 = $action->getList('linh_vuc', 'parent', $item_3['id'], 'code', 'asc', '', '', '');
				foreach ($cap_4 as $item_4) {
					echo $item_4['code'];echo '<br>';
					$cap_5 = $action->getList('linh_vuc', 'parent', $item_4['id'], 'code', 'asc', '', '', '');
					foreach ($cap_5 as $item_5) {
						echo $item_5['code'];echo '<br>';
					}
				}
			}
		}
	}