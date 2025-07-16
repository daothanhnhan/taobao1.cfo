<?php
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
$txt = date('Y-m-d H:i:s') . "\n";
fwrite($myfile, $txt);
fclose($myfile);
?>