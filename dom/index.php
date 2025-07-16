<?php
// example of how to use basic selector to retrieve HTML contents
include('simple_html_dom.php');
 
// get DOM from URL or file
// $html = file_get_html('http://www.google.com/');
// $html = file_get_html('http://vi.aliexpress.com/item/1005004499605665.html');
$html = file_get_html('https://vi.aliexpress.com/');
var_dump($html);
// find all link
// foreach($html->find('a') as $e) 
    // echo $e->href . '<br>';