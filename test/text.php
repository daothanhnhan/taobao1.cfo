<?php
// $str = "Visit W3Schools@!#$%";
// $str = "@!#$%a";
// $pattern = "/[a-z]+/";
// echo preg_match($pattern, $str);

$string = "~!@#$%^&*()_+-=/|?*";
$char = "o";

$str = "Visit W3Schools-";
$str_length = strlen($str);

$str_special = 0;

for ($i = 0;$i < $str_length;$i++) {
	// Using strpos() function
	if (strpos($string, $str[$i]) !== false) {
	    // echo "The string contains the character '$char'.";
		$str_special = 1;
		break;
	} else {
	    // echo "The string does not contain the character '$char'.";
	}
}

echo $str_special;
?>