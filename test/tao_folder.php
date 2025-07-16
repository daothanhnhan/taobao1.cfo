<?php 

///////////////////
	$hom_nay = date("Y-m-d");echo $hom_nay;
	$time = strtotime($hom_nay);
	$final = date("Y-m-d", strtotime("+1 month", $time));

	// $year = date('Y');
	// $month = date('m');

	$year = date('Y', strtotime("+1 month", $time));
	$month = date('m', strtotime("+1 month", $time));

	$_SESSION['step_1']['year'] = $year;
	$_SESSION['step_1']['month'] = $month;
	$dir = $year.'/'.$month.'/';

	$src= "evisa/";
	$year_dir = $src.$year;
	$month_dir = $year_dir.'/'.$month;
	if (!file_exists($year_dir)) {
		mkdir($year_dir);
	}
	if (!file_exists($month_dir)) {
		mkdir($month_dir);
	}
	//////////////////