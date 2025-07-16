<?php 
	// echo time();echo '<br>';
	$current_time = time();
	$ngay = 60*60*24*30;
	$previous_time = time() - $ngay;

	// echo date('Y-m-d', $previous_time);
	// echo date('Y-m-d');
	
	// echo time()-$ngay;

	$url = "http://sv.isvn.space/api/v1/mars/coupon?from=$previous_time&to=$current_time";//echo $url;

	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
    $html = curl_exec($ch);
    curl_close($ch);
    // var_dump($html);

	$arr = json_decode($html, true);
	// echo '<pre>';
	// var_dump($arr);
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
<script type="text/javascript">
function nhymxu_at_coupon_copy2clipboard( coupon_value ) {
    var aux = document.createElement("input");
    aux.setAttribute("value", coupon_value);
    document.body.appendChild(aux);

    if( navigator.userAgent.match(/ipad|ipod|iphone/i) ) {
		var editable = aux.contentEditable;
		var readOnly = aux.readOnly;

		aux.contentEditable = true;
		aux.readOnly = false;

		var range = document.createRange();
		range.selectNodeContents(aux);

		var selection = window.getSelection();
		selection.removeAllRanges();
		selection.addRange(range);

		aux.setSelectionRange(0, 999999);
		aux.contentEditable = editable;
		aux.readOnly = readOnly;

    } else {
        aux.select();
    }
    document.execCommand("copy");
    document.body.removeChild(aux);
}
</script>
<?php foreach( $arr as $row ): 
    $option['uid'] = '5620780382800371768';
    $utm_source = '';
    $deeplink = 'https://pub.accesstrade.vn/deep_link/'. $option['uid'] .'?url=' . rawurlencode( $row['link'] ) . $utm_source . '&at_source=smart-coupon';
    ?>
    <div class="offers-details">
        <div class="mgg-bl">
        <div class="mgg-row">
            <div class="mgg-top">
                    <span class="rest_piggy" style="display:none">Voucher HOT</span>
                <div class="mgg-discount">
                        <?=$row['title'];?>                           
                        <!-- <div class="mgg-logo"><img src="https://epz24x4zq6r.exactdn.com/wp-content/uploads/2020/12/ma-giam-gia-tiki.png?strip=all&amp;lossy=1&amp;w=1125&amp;ssl=1" data-src="https://epz24x4zq6r.exactdn.com/wp-content/uploads/2020/12/ma-giam-gia-tiki.png?strip=all&amp;lossy=1&amp;w=1125&amp;ssl=1" loading="lazy" class="lazyload" width="300" height="300"><noscript><img src="https://epz24x4zq6r.exactdn.com/wp-content/uploads/2020/12/ma-giam-gia-tiki.png?strip=all&lossy=1&w=1125&ssl=1" data-eio="l"></noscript> </div> -->
                </div>
                    <div class="polyxgo_title">
                            <!-- <span class="polyxgo_bold">Giảm tối đa:</span> 
                            <span class="pxg_price" data-price="200.000 đ">200.000 đ</span>
                            <div>
                                <span class="polyxgo_bold">ĐH tối thiểu:</span> 
                                <span class="pxg_price" data-price="1.100.000 đ">1.100.000 đ</span>
                            </div> -->
                            <div><span class="polyxgo_bold"> Ngày hết hạn:</span> <?=date('d-m-Y', strtotime($row['date_end']));?></div>
                            <div><span class="polyxgo_bold"> Ngành hàng:</span> <?=$row['categories'][0]['title'];?> </div>                              
        
                    </div>
            
            </div>

            <div class="mgg-bottom">
                <div class="copy-code" data-clipboard-text="AT200T11" data-toggle="tooltip" data-placement="top" title="Nhấn để tự động copy mã"  onclick="window.open('<?=$deeplink;?>','_blank')">
                <i class="far fa-copy"></i> COPY MÃ</div>

                        <!-- <div class="coupon-code">
                        <span class="vc-mgg">AT200T11</span>
                        <span class="cp-mgg" data-clipboard-text="AT200T11" data-toggle="tooltip" data-placement="top" title="Nhấn để tự động copy mã" onclick="setTimeout('window.open(\'https://gotrackecom.info/v0/HTnBLyanmfqRbC6URXW1Hg?url=https%3A%2F%2Ftiki.vn%2F&amp;aff_sub1=MAGIAMGIACOM&amp;utm_source=an_17392880000&amp;utm_medium=affiliates&amp;utm_campaign=-&amp;utm_content=MAGIAMGIA-SEARCH---\')', 900);"><i class="far fa-copy"></i> COPY </span>
                        
                        </div> -->
            </div>

        </div>
    </div>
</div>
<?php
endforeach;