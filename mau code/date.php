<?php 
	$now = date('Y-m-d');
	echo $now;

	$thang = date('Y-m-d', strtotime($now . ' + 30 days'));
	echo '<br>';
	echo $thang;