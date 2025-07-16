<?php 
	// var_dump($rowCat['productcat_id']);
	$br_cat = array();
	function breadcrumb ($productcat_id) {
		global $conn_vn;
		global $br_cat;
		global $action;

		
		$procat = $action->getDetail('productcat', 'productcat_id', $productcat_id);//var_dump($procat);
		$br_cat[] = array($procat['friendly_url'], $procat['productcat_name']);
		if ($procat['productcat_parent'] != 0) {
			breadcrumb($procat['productcat_parent']);
		} else {

		}
	}
	breadcrumb($rowCat['productcat_id']);
	krsort($br_cat);
	// var_dump($br_cat);
?>
<style>
.breadcrumb i {
	font-weight: 600;
}
.breadcrumb>li+li:before {
	content: '';
	padding: 0 1px;
}
</style>
<ul class="breadcrumb">
	<li>
		<a href="/">Trang chủ</a>
	</li>
	<?php foreach ($br_cat as $br) { ?>
	<li>
		<a href="/<?= $br[0] ?>"><i class="fa fa-angle-right"></i> <?= $br[1] ?> </a>
	</li>
	<?php } ?>
</ul>