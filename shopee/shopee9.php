<form action="" method="post" accept-charset="utf-8">
  <input type="text" name="url">
  <button type="submit">chạy</button>
</form>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.chanhtuoi-code .item {
    box-shadow: 0 10px 10px -5px rgb(31 31 31 / 50%);
    -webkit-box-shadow: 0 10px 10px -5px rgb(31 31 31 / 50%);
    -khtml-box-shadow: 0 10px 10px -5px rgba(31,31,31,.5);
    -moz-box-shadow: 0 10px 10px -5px rgba(31,31,31,.5);
    -ms-box-shadow: 0 10px 10px -5px rgba(31,31,31,.5);
    -o-box-shadow: 0 10px 10px -5px rgba(31,31,31,.5);
    width: calc(100% / 5 - 15px);
    margin: 0 7.5px 15px 7.5px;
    background: #f1f1f1;
    padding: 15px;
    border-radius: 5px;
    display: inline-block;
}
.chanhtuoi-code .item-top {
    width: 100%;
}
.chanhtuoi-code .item-top__shortname p {
    line-height: 70px;
    text-align: center;
    font-size: 25px;
    font-weight: 700;
    color: #e00034;
    height: 70px;
    overflow: hidden;
}
.line {
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    display: -webkit-box!important;
    overflow: hidden;
}
.line-2 {
    -webkit-line-clamp: 2;
}
.chanhtuoi-code .item-top__title {
    width: 100%;
    clear: both;
    float: left;
    margin-bottom: 10px;
    font-weight: 700;
    line-height: 18px;
    font-size: 14px;
    height: 36px;
    overflow: hidden;
}
.chanhtuoi-code .item-top__other {
    width: 100%;
    clear: both;
    float: left;
    margin-bottom: 10px;
}
.chanhtuoi-code .item-top__other__time {
    font-size: 14px;
    line-height: 15px;
    color: #1da64c;
}
.chanhtuoi-code .item-top__other__time i {
    float: left;
    margin-right: 3px;
    line-height: 16px;
}
.chanhtuoi-code .item-top__desc {
    width: 100%;
    clear: both;
    float: left;
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 18px;
    height: calc(18px * 3);
    overflow: hidden;
    position: relative;
}
.chanhtuoi-code .item-top .item-desc__viewmore {
    position: absolute;
    bottom: 0;
    right: 0;
    background: #f1f1f1;
    color: #2780c9;
    cursor: pointer;
}
.chanhtuoi-code .item-bottom {
    width: 100%;
    position: relative;
    border-top: 4px dotted #fff;
    padding-top: 14px;
    display: flex;
    flex-wrap: wrap;
}
.chanhtuoi-code .item-bottom .item-code {
    clear: both;
    width: 100%;
    margin-bottom: 0;
}
.code {
    width: 100%;
    clear: both;
    float: left;
    width: calc(100% - 40px);
    height: 36px;
    display: block;
    cursor: pointer;
    position: relative;
    background: #fff;
    border: 1px dashed #ccc;
    border-radius: 3px;
}
.code-text {
    width: calc(100% - 50px);
    float: left;
    line-height: 34px;
    text-align: center;
    padding: 0 5px;
    font-weight: 700;
    margin: 0;
}
.code-icon {
    float: left;
    width: 32px;
    height: 32px;
    margin: 1px;
    background: #1da64c;
    color: #fff;
    text-align: center;
    border-radius: 3px;
}
.code-icon i {
    line-height: 32px;
    font-size: 20px;
}
.code-link {
    float: left;
    width: 30px;
    height: 34px;
    margin: 1px;
    background: #69be28;
    color: #fff;
    text-align: center;
    border-radius: 3px;
    position: relative;
    display: block;
    border-left: none;
}
.code-link i {
    line-height: 38px;
    font-size: 20px;
}
.code-link__tooltip {
    box-shadow: 0 10px 25px -5px rgb(31 31 31 / 50%);
    -webkit-box-shadow: 0 10px 25px -5px rgb(31 31 31 / 50%);
    -khtml-box-shadow: 0 10px 25px -5px rgba(31,31,31,.5);
    -moz-box-shadow: 0 10px 25px -5px rgba(31,31,31,.5);
    -ms-box-shadow: 0 10px 25px -5px rgba(31,31,31,.5);
    -o-box-shadow: 0 10px 25px -5px rgba(31,31,31,.5);
    display: block;
    position: absolute;
    left: -45px;
    top: 42px;
    width: 125px;
    font-size: 14px;
    background: #1da64c;
    line-height: 25px;
    padding: 0 5px;
    border-radius: 5px;
    color: #fff;
    opacity: 0;
    visibility: hidden;
    transition: .5s;
    font-size: 12px;
}

</style>
<?php
echo $_POST['url'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.accesstrade.vn/v1/offers_informations/coupon?url=".$_POST['url'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 300,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Token G3pP-dFx84jqOlXbHAIBlY9YValOyjMf",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: a589ebb0-2b35-68a9-8501-1585f1e4d8fb"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
  $array = json_decode($response, true);
  echo '<pre>';
  var_dump($array);
}
?>
