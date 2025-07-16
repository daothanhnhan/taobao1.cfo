<?php 
	$link = dirname(__FILE__) .'/..'. $_GET['link'];
	unlink($link);
	echo $link;
?>