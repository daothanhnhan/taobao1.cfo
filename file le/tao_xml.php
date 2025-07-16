<?php 
	$doc = new DOMDocument('1.0', 'utf-8');

	$root = $doc->createElement('urlset');

	$root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
	$root->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
	$root->setAttribute('xsi:schemaLocation', '"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

	$doc->appendChild($root);

	$url = $doc->createElement('url');

	// $url->nodeValue = 'Tony Nguyen';
	// $from->xmlns = 'http://www.sitemaps.org/schemas/sitemap/0.';

	// $from->setAttribute('name', 'New york');
	// $from->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
	// $from->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
	// $from->setAttribute('xsi:schemaLocation', '"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

	$root->appendChild($url);

	$loc = $doc->createElement('loc');
	$protocol = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
	$domain = $protocol.$_SERVER['SERVER_NAME'];
	$loc->nodeValue = $domain;
	$url->appendChild($loc);

	$lastmod = $doc->createElement('lastmod');
	$date = date('Y-m-d\TH:i:s').'+00:00';
	$lastmod->nodeValue = $date;
	$url->appendChild($lastmod);

	$priority = $doc->createElement('priority');
	$priority->nodeValue = '1.00';
	$url->appendChild($priority);

	//////////////////////////////

	$url = $doc->createElement('url');
	$root->appendChild($url);

	$lastmod = $doc->createElement('lastmod');
	$date = date('Y-m-d\TH:i:s').'+00:00';
	$lastmod->nodeValue = $date;
	$url->appendChild($lastmod);

	$doc->save('note.xml');

	echo 'thanh cong';
	// echo $_SERVER['SERVER_PROTOCOL'];
	// var_dump($_SERVER['HTTPS'])
?>