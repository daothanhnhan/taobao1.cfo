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
/*
* Coupon area
*/
.coupondiv {
    border: 1px solid #d3d3d3;
    min-width: 250px;
    margin-bottom: 6px;
    background-color: #fff
}
.coupondiv .promotiontype {
    padding: 15px;
    overflow: hidden
}
.promotag {
    float: left
}
.promotagcont {
    background: #fff;
    color: #fe6f17;
    overflow: hidden;
    width: 70px;
    border-radius: 2px;
    -webkit-box-shadow: 1px 1px 4px rgba(34, 34, 34, .2);
    box-shadow: 1px 1px 4px rgba(34, 34, 34, .2);
    text-align: center
}
.promotagcont .saleorcoupon {
    background: #fe6f17;
    padding: 7px 6px;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    line-height: 2em
}
.tagsale.promotagcont {
    background: #fff;
    color: #1fb207
}
.tagsale .saleorcoupon {
    background: #1fb207
}
.saveamount {
    min-height: 58px;
    font-size: 20px;
    margin: 0 auto;
    padding: 4px 3px 0;
    font-weight: 700;
    line-height: 2.5
}
.coupondiv .cpbutton {
    float: right;
    position: relative;
    z-index: 1;
    text-align: right;
    width: 150px;
    margin-top: 35px;
    margin-right: 15px
}
.copyma {
    width: 110px;
    min-width: 110px;
    display: inline-block;
    position: relative;
    margin-right: 30px;
    padding: 15px 5px;
    border: 0;
    background: #fe6f17;
    color: #fff;
    font-family: 'Roboto', sans-serif;
    font-size: 15px;
    font-weight: 500;
    line-height: 1;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border-style: solid;
    border-color: #fe6f17;
    border-radius: 0
}
.copyma:after {
    border-left-color: #fe6f17;
    content: "";
    display: block;
    width: 0;
    height: 0;
    border-top: 45px solid transparent;
    border-left: 45px solid #fe6f17;
    position: absolute;
    right: -45px;
    top: 0
}
.copyma:hover {
    background-color: #cb5912
}
.copyma:hover:after {
    opacity: 0;
    -webkit-transition-duration: .5s;
    transition-duration: .5s
}
.coupon-code {
    position: absolute;
    top: 0;
    right: -45px;
    z-index: -1;
    min-width: 50px;
    height: 45px;
    padding: 0 5;
    font-weight: 500;
    line-height: 45px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border-radius: 0;
    font-size: 16px;
    color: #222;
    font-family: 'Open Sans', sans-serif;
    border: 1px solid #ddd
}
.xemngayz {
    width: 110px;
    min-width: 110px;
    display: inline-block;
    position: relative;
    margin-right: 30px;
    padding: 15px 15px;
    border: 0;
    background: #fe6f17;
    color: #fff;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border-style: solid;
    border-color: #fe6f17;
    border-radius: 0
}
.xemngayz:hover {
    background-color: #cb5912
}
.promotiondetails {
    padding-left: 20px;
    width: calc(100% - 270px);
    word-wrap: break-word;
    float: left;
    font-size: 16px
}
.coupontitle {
    display: block;
    font-family: 'Roboto', sans-serif;
    margin-bottom: 5px;
    color: #222;
    font-weight: 500;
    line-height: 1.2;
    text-decoration: none;
    font-size: 16px
}
.cpinfo {
    display: block;
    margin-bottom: 5px;
    color: #222;
    line-height: 1.6;
    text-decoration: none;
    font-size: 14px
}
.news-box .news-thumb,
.news-box .news-info {
    display: inline-block;
    float: left
}
.news-box .news-info {
    width: 500px;
    margin-left: 10px
}
@media screen and (max-width: 767px) {
    .coupontitle {
        font-size: 18px
    }
    .promotagcont {
        width: 60px
    }
    .promotagcont .saleorcoupon {
        font-size: 11px
    }
    .saveamount {
        min-height: 50px;
        font-size: 16px
    }
    .promotiondetails {
        margin-right: 0;
        font-size: 14px;
        width: auto;
        float: none;
        margin-left: 70px;
        padding-left: 0
    }
    .coupondiv .cpbutton {
        clear: both;
        margin-top: 0;
        width: 116px
    }
    .copyma {
        width: 100px;
        min-width: 100px;
        padding: 10px 8px
    }
    .copyma:after {
        border-top: 35px solid transparent;
        border-left: 35px solid #fe6f17;
        position: absolute;
        right: -34px;
        top: 0
    }
    .coupon-code {
        position: absolute;
        top: 0;
        right: -35px;
        z-index: -1;
        height: 35px;
        line-height: 35px
    }
    .xemngayz {
        width: 135px;
        min-width: 135px;
        padding: 10px 8px
    }
    .xemngayz:hover {
        background-color: #167f05
    }
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
    <div class="coupondiv">
        <div class="promotiontype">
            <div class="promotag">
                <div class="promotagcont tagsale">
                    <div class="saveamount"><?=($row['coupon_save'] != '') ? $row['coupon_save'] : 'KM';?></div>
                    <div class="saleorcoupon"><?=($row['coupon_code']) ? ' COUPON' : ' SALE';?></div>
                </div>
            </div>
            <div class="promotiondetails">
                <div class="coupontitle"><?=$row['title'];?></div>
                <div class="cpinfo">
                    <strong>Hạn dùng: </strong><?=date('d-m-Y', strtotime($row['date_end']));?>
                    <?php if( !empty($row['categories']) ): ?>
                    <br><strong>Ngành hàng:</strong> <?=$row['categories'][0]['title'];?>
                    <?php endif; ?>
                    <?=( $row['coupon_desc'] != '' ) ? '<br>' . $row['coupon_desc'] : '';?>
                </div>
            </div>
            <?php if( $row['coupon_code'] != '' ): ?>
            <div class="cpbutton">
                <div class="copyma" onclick="nhymxu_at_coupon_copy2clipboard('<?=$row['code'];?>');window.open('<?=$row['deeplink'];?>','_blank')">
                    <div class="coupon-code"><?=$row['coupon_code'];?></div>
                    <div>COPY MÃ</div>
                </div>
            </div>
            <?php else: ?>
            <div class="cpbutton" style="margin-right:0;">
                <div class="xemngayz" onclick="window.open('<?=$deeplink;?>','_blank')">XEM NGAY</div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php
endforeach;