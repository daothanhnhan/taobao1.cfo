<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thanh toán trực tuyến bằng thẻ ATM, internetbanking, Visa, Master Card;... qua NgânLượng.vn</title>
</head>
<?php

include 'config.php';
include 'lib/nganluong.class.php';
$flag = true;
if (isset($_POST['submit'])) {
	// Lấy các tham số để chuyển sang Ngânlượng thanh toán:

 //$ten= $_POST["txt_test"];
    $receiver=RECEIVER;
	//Mã đơn hàng 
	$order_code='NL_'.time();
	//Khai báo url trả về 
	$return_url= $_SERVER['HTTP_REFERER']. "/success.php";
	// Link nut hủy đơn hàng
	$cancel_url= $_SERVER['HTTP_REFERER'];	
	$notify_url = $_SERVER['HTTP_REFERER']. "/success.php";
	//Giá của cả giỏ hàng 
	$txh_name =$_POST['txh_name']; 	
	$txt_email =$_POST['txt_email']; 	
	$txt_phone =$_POST['txt_phone'];
	if (strlen($txh_name) > 50 || strlen($txt_email) > 50 || strlen($txt_phone) > 20){
	    $flag = false;
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $txh_name))
    {
        $flag = false;
    }
	if ($flag) {
        $price =(int)$_POST['txt_gia'];
        //Thông tin giao dịch
        $transaction_info="Thong tin giao dich";
        $currency= "vnd";
        $quantity=1;
        $tax=0;
        $discount=0;
        $fee_cal=0;
        $fee_shipping=0;
        $order_description="Thong tin don hang: ".$order_code;
        $buyer_info=$txh_name."*|*".$txt_email."*|*".$txt_phone;
        $affiliate_code="";
        //Khai báo đối tượng của lớp NL_Checkout
        $nl= new NL_Checkout();
        $nl->nganluong_url = NGANLUONG_URL;
        $nl->merchant_site_code = MERCHANT_ID;
        $nl->secure_pass = MERCHANT_PASS;
        //Tạo link thanh toán đến nganluong.vn
        $url= $nl->buildCheckoutUrlExpand($return_url, $receiver, $transaction_info, $order_code, $price, $currency, $quantity, $tax, $discount , $fee_cal,    $fee_shipping, $order_description, $buyer_info , $affiliate_code);
        //$url= $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);


        //echo $url; die;
        if ($order_code != "") {
            //một số tham số lưu ý
            //&cancel_url=http://yourdomain.com --> Link bấm nút hủy giao dịch
            //&option_payment=bank_online --> Mặc định forcus vào phương thức Ngân Hàng
            $url .='&cancel_url='. $cancel_url . '&notify_url='.$notify_url;
            //$url .='&option_payment=bank_online';

            echo '<meta http-equiv="refresh" content="0; url='.$url.'" >';
            //&lang=en --> Ngôn ngữ hiển thị google translate
        }
    }

}
?>
<script type="text/javascript">
function check(){
		var price = document.Test.txt_gia.value;
    var txh_name = document.Test.txh_name.value;
    var txt_email = document.Test.txt_email.value;
    var txt_phone = document.Test.txt_phone.value;
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
		
		if (price < 2000) {
		alert('Minimum amount is 2000 VNĐ');
		return false;
		}

    if (txh_name.length > 50 ) {
        alert('Họ tên không hợp lệ');
        return false;
    }
    if (txt_email.length > 50 ) {
        alert('Email không hợp lệ');
        return false;
    }
    if (txt_phone.length > 20 ) {
        alert('Số điện thoại không hợp lệ');
        return false;
    }
    if(format.test(txh_name)){
        alert('Họ tên không hợp lệ');
        return false;
    }
	return true;	
}
</script>

<body>
<p><span style="color: #ff0000;"><em><span style="font-size: medium;"><strong> <span style="color: #000000;">
Thanh toán trực tuyến bằng thẻ ATM; Visa, Master Card;... qua NgânLượng.vn</span></p>
<p style="color: red">LƯU Ý: Nhập thông tin người thanh toán không được chứa thông tin Merchant</p>
<?php if (!$flag){ ?>
    <p style="color: red">Lỗi : Thông tin không hợp lệ</p>
<?php } ?>
<form name="Test"  method="post" action="" onsubmit="return check();">
<table>
	<tr><th><strong>Họ Tên:</strong></th><td><input  type="text" name="txh_name" size="50" placeholder="không chứa thông tin merchant, ký tự đặc biệt, tối đa 50 ký tự" maxlength="50"/></td></tr>
	<tr><th><strong>Email:</strong></th><td><input  type="email" name="txt_email" size="50" placeholder="tối đa 50 ký tự" maxlength="50"/></td></tr>
	<tr><th><strong>Số điện thoại:</strong></th><td><input  type="text" name="txt_phone" size="50" placeholder="tối đa 20 ký tự" maxlength="20"/></td></tr>
	<tr><th><strong>Số tền thanh toán:</strong></th><td><input name="txt_gia" type="text" size="50" placeholder="Số tiền quyên góp" maxlength="20"/></td></tr>
	<tr><th></th><td><input  type="submit" name="submit" value="Thanh Toán"></td></tr>	
</table>


</form>
</body>
</html>

