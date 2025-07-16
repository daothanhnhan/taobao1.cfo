<?php 
	$url = 'https://magiamgia.com/';
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
    $html = curl_exec($ch);
    curl_close($ch);
    // var_dump($html);

    preg_match_all('/content-id="ph-bi-n-nh-t">(.*)content-id="m-i-nh-t">/Uis', $html, $matches1);//var_dump($matches1[1][0]);
    // preg_match_all('/content-id="m-i-nh-t">(.*)content-id="m-shopee">/Uis', $html, $matches1);var_dump($matches1);
    $noi_dung = str_replace("&lazy=1", "", $matches1[1][0]);
    
    $noi_dung = substr($noi_dung, 0, -100);
    // var_dump($noi_dung);
    echo $noi_dung;
?>
<style>
.offers-details {
    font-size: 13px;
    margin-bottom: 22px;
}
.offers-details {
    overflow: visible;
    width: 49%;
    display: inline-block;
}
.mgg-bl {
    background: #eceff1;
    border-radius: 10px;
    margin: 7px;
    box-shadow: 5px 5px 7px #d5d5d5b0;
    padding: 5px;
}
.mgg-top {
    display: inline-block;
    width: 100%;
    padding: 10px;
}
.mgg-discount {
    font-size: 24px;
    text-align: left;
    font-weight: 800;
    color: #cf0d55;
    padding: 5px 0;
}
.mgg-logo {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    position: relative;
    border-radius: 50%;
    border: 1px solid #039fb7;
    display: inline-block;
    float: right;
}
/*.elementor img {
    height: auto;
    max-width: 100%;
    border: none;
    -webkit-border-radius: 0;
    border-radius: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
}
img {
    vertical-align: middle;
}*/
.polyxgo_title {
    padding-top: 0;
    min-height: 50px;
    font-size: 14px;
    line-height: 1.6;
    color: #333;
    width: 100%;
}
.polyxgo_bold {
    font-weight: 700;
    color: #22a296;
}
.mgg-bottom {
    display: block;
    padding-left: 8px;
    padding-right: 8px;
}
.copy-code {
    width: 100%;
    height: 41px;
    background: #059eb7;
    padding: 5px;
    overflow: hidden;
    border-radius: 5px;
    border: 1px solid #FFFFF8;
    cursor: pointer;
    font-size: 18px;
    color: #fff;
    text-align: center;
    padding-top: 8px;
    font-weight: 700;
    position: relative;
    margin-top: -40px;
    top: 41px;
    z-index: 999;
}
.copy-code {
    height: 45px;
    z-index: 99;
    top: 45px;
}
.mgg-logo img {
    width: 100%;
    height: 100%;
}
.promotion-button {
    display: inline-block;
    margin-bottom: 10px;
    height: 40px;
    margin: 0 auto;
    background: #25a296;
    width: 100%;
    text-align: center;
    font-size: 18px;
    padding: 6px 0 0 0;
    border-radius: 5px;
    color: #fff;
    border: 1px solid #fff;
    cursor: pointer;
    font-weight: 700;
    position: relative;
    bottom: 10px;
    margin-top: 10px;
}
</style>