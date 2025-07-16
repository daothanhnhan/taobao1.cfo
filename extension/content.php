<?php 
	include_once dirname(__FILE__) . "/../database.php";
	include_once dirname(__FILE__) . "/../library.php";
	include_once dirname(__FILE__) . "/../action.php";

	$action = new action();

	$product = $action->getDetail('product_1', 'id', 1);//var_dump($product);

	// $the_alt = str_replace(",", "<br>", $product['the_alt']);
  $anh = explode(",", $product['img']);//var_dump($anh);

  $content = preg_replace("/<img[^>]+\>/i", "(image)", $product['content']);
  // $content = $product['content'];//var_dump($content);

  // $content = str_replace("<b><b>", "<b>", $content);

  // $content = preg_replace(
  //        "/class\s*=\s*\"[^\"]*test23321456[^\"]*\"/", 
  //        "class=''", 
  //        $content);

  $content = preg_replace(
         "/class=\"[^\"]*\"/", 
         "class=''", 
         $content);

  $content = preg_replace(
         "/style=\"[^\"]*\"/", 
         "style=''", 
         $content);

  $content = str_replace("<p class=''><span style=''>(image)</span></p>", "<p style='text-align:center;'>(image)</p>", $content);

  $content = str_replace("<span class=''>", '', $content);
  $content = str_replace('</span>', '', $content);

  $mo_ta = str_replace("Thẻ mô tả:", "", $product['mo_ta']);

function convert_vn2latin($str)
{
    // Mảng các ký tự tiếng việt không dấu theo mã unicode tổ hợp
    $tv_unicode_tohop  =
        [
            "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă", "ằ","ắ","ặ","ẳ","ẵ",
            "è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ" ,"ò","ớ","ợ","ở","õ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","À","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă" ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ" ,"Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ"
        ];
    // Mảng các ký tự tiếng việt không dấu theo mã unicode dựng sẵn   
    $tv_unicode_dungsan  =
        [
            "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
            "è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ"
        ];
    // Mảng các ký không dấu sẽ thay thế cho ký tự có dấu
    $tv_khongdau =
        [
            "a","a","a","a","a","a","a","a","a","a","a" ,"a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o" ,"o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A" ,"A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O" ,"O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D"
        ];

    $str = str_replace($tv_unicode_dungsan, $tv_khongdau, $str);
    $str = str_replace($tv_unicode_tohop,   $tv_khongdau, $str);
    return $str;
}

function UrlNormal($str)
{
    // Chuyển tiếng việt không dấu
    $str = convert_vn2latin($str);
    // chuyển sang in thường
    $str = mb_strtolower($str);
    // Giữ lại các ký tự chữ a - z và số 0 - 9 còn lại thay bằng -
    $str = preg_replace('/[^a-z0-9]/', '-', ($str));
    $str = preg_replace('/[--]+/', '-', $str);
    $str = trim($str, '-');
    return $str;
}

//////////////////////
  $arr_anh = array();
  $the_alt_arr = json_decode($product['the_alt'], true);//var_dump($the_alt_arr);
  foreach ($the_alt_arr as $d => $item) {
    $alt = UrlNormal($item);
    $alt .= '-'.$d;
    $alt .= '.jpg';
    // var_dump($alt);
    $link = 'image/'.$alt;
    // echo '<img src="'.$link.'">';
    $arr_anh[] = $link;
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  	.c0 {
  		/*font-weight: bold;*/
  	}
  </style>
</head>
<body>
	<table class="table table-bordered" style="width: 100%;">
	    <thead>
	      <tr>
	        <th>Firstname</th>
	        <th>Copy</th>
	        <th>Nội dung</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>Tên</td>
	        <td><button onclick="copyClipboard_name()">Copy</button></td>
	        <td id="name"><?= $product['name'] ?></td>
	      </tr>
	      <tr>
	        <td>Mô tả</td>
	        <td><button onclick="copyClipboard_mo_ta()">Copy</button></td>
	        <td id="mo_ta"><?= $mo_ta ?></td>
	      </tr>
	      <tr>
	        <td>Thẻ alt</td>
	        <td></td>
	        <td>
              <table style="width: 100%;">
                <tbody>
                  <?php 
                  $d = -1;
                  foreach ($the_alt_arr as $item) { 
                    $d++;
                    $alt = UrlNormal($item);
                    $alt .= '-'.$d;
                    $alt .= '.jpg';
                  ?>
                  <tr>
                    <td><?= $item ?></td>
                    <td><img src="<?= $anh[$d] ?>" width="100"></td>
                    <td><?= $alt ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table> 
          </td>
	      </tr>
        <tr>
          <td>Ảnh</td>
          <td>
            <button onclick="keo_anh()">kéo ảnh về</button><br><br>
            <!-- <button onclick="download()">Download</button><br><br> -->
            <!-- <button onclick="xoa_anh()">Xóa</button> -->
          </td>
          <td>
            <!-- <textarea id="ten_alt"><?= $product['the_alt'] ?></textarea>
            <textarea id="ten_anh"><?= $product['img'] ?></textarea> -->
            <?php foreach ($arr_anh as $anh) { ?>
              <a href="<?= $anh ?>" download>
                <img src="<?= $anh ?>" width="200" class="img_content">
              </a>
            <?php } ?>
          </td>
        </tr>
	      <tr>
	        <td>Nội dung</td>
	        <td><button onclick="copyClipboard_content()">Copy</button></td>
	        <td id="content">
            <?= $content ?>
          </td>
	      </tr>
	    </tbody>
	  </table>

<script>
function copyClipboard_name() {
  var elm = document.getElementById("name");
  // var myJSON = JSON.stringify(elm);
  // alert(myJSON);
  // for Internet Explorer

  if(document.body.createTextRange) {
    var range = document.body.createTextRange();
    range.moveToElementText(elm);
    range.select();
    document.execCommand("Copy");
    // alert("Copied");
  }
  else if(window.getSelection) {
    // other browsers

    var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(elm);
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand("Copy");
    // console.log('tuan');
    var y = JSON.stringify(elm);
    var x = typeof elm;
    // alert(y);
    // selection = 'abc';
    // selection = selection.replace("a", "");
    // alert(selection);
  }
}

function copyClipboard_mo_ta() {
  var elm = document.getElementById("mo_ta");
  // var myJSON = JSON.stringify(elm);
  // alert(myJSON);
  // for Internet Explorer

  if(document.body.createTextRange) {
    var range = document.body.createTextRange();
    range.moveToElementText(elm);
    range.select();
    document.execCommand("Copy");
    // alert("Copied");
  }
  else if(window.getSelection) {
    // other browsers

    var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(elm);
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand("Copy");
    // console.log('tuan');
    var y = JSON.stringify(elm);
    var x = typeof elm;
    // alert(y);
    // selection = 'abc';
    // selection = selection.replace("a", "");
    // alert(selection);
  }
}

function copyClipboard_content() {
  var elm = document.getElementById("content");
  // var myJSON = JSON.stringify(elm);
  // alert(myJSON);
  // for Internet Explorer

  if(document.body.createTextRange) {
    var range = document.body.createTextRange();
    range.moveToElementText(elm);
    range.select();
    document.execCommand("Copy");
    // alert("Copied");
  }
  else if(window.getSelection) {
    // other browsers

    var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(elm);
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand("Copy");
    // console.log('tuan');
    var y = JSON.stringify(elm);
    var x = typeof elm;
    // alert(y);
    // selection = 'abc';
    // selection = selection.replace("a", "");
    // alert(selection);
  }
}

function keo_anh () {
  // var alt = document.getElementById("ten_alt").innerHTML;
  // var anh = document.getElementById("ten_anh").innerHTML;
  // alert(anh);
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    // document.getElementById("demo").innerHTML = this.responseText;
      // alert(this.responseText);
      // location.reload();
      download(xoa_anh);
    }
  xhttp.open("GET", "ajax_info.php?id=1", true);
  xhttp.send();
}

function download (myCallback) {
  var img_content = document.getElementsByClassName('img_content');
    // alert(img_content.length);
    for (var i=0;i<img_content.length;i++) {
      img_content[i].click();
    }
    myCallback();
}

function xoa_anh () {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    // document.getElementById("demo").innerHTML = this.responseText;
      alert(this.responseText);
      location.reload();
    }
  xhttp.open("GET", "ajax_xoa_anh.php?id=1", true);
  xhttp.send();
}
</script>
</body>

</html>
