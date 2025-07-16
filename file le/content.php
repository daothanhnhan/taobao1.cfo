<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cào yến tâm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
	include_once dirname(__FILE__) . "/database.php";

	$id = $_GET['id'];

	$sql = "SELECT * FROM product WHERE id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);

	// // var_dump($row);
	// echo '<button onclick="copyClipboard()">Nội dung</button>';
	// echo '<button onclick="copyClipboard_des()">Mô tả ngắn</button>';
	// echo '<div id="des">';
	// // echo $row['des'];
	// echo '</div>';
	// echo '<hr>';

	// echo '<div id="content">';
	// // echo $row['content_2'];// mô tả
	// echo '<p>---</p>';
	// // echo $row['note'];// thông số
	// echo '<h6>Thông số kỹ thuật</h6>';
	// // echo $row['content_1'];// bao gồm
	// echo '</div>';

  // $content = preg_replace("/<img[^>]+\>/i", "<p style='text-align:center;'>(image)</p> ", $row['content_2']);
  $content = preg_replace("/<img[^>]+\>/i", "(image)", $row['content_2']);
  $content = str_replace("<p></p>", "", $content);

  $bao_gom = str_replace('Sản phẩm bao gồm:', '', $row['content_1']);
  $bao_gom = str_replace('Sản phẩm bao gồm', '', $bao_gom);
  $bao_gom = str_replace('sản phẩm bao gồm:', '', $bao_gom);
  $bao_gom = str_replace('sản phẩm bao gồm', '', $bao_gom);

  $bao_gom_text = strip_tags($bao_gom);
  $bao_gom_text = trim($bao_gom_text);
  // var_dump($bao_gom_text);

  $mota_ngan = str_replace('Thông tin nổi bật:', '', $row['des']);
  $mota_ngan = str_replace('Thông tin nổi bật :', '', $mota_ngan);
  $mota_ngan = str_replace('Thông tin nổi bật', '', $mota_ngan);
  // $mota_ngan = str_replace("\r\n\r\n", "\r\n", $mota_ngan);
  if ($_GET['id'] == 1) {
    $duoc_giao = "Hằng Phạm";
  }
  if ($_GET['id'] == 2) {
    $duoc_giao = "Tuấn";
  }
  if ($_GET['id'] == 3) {
    $duoc_giao = "Trí";
  }
  if ($_GET['id'] == 4) {
    $duoc_giao = "Hằng Trần";
  }
  if ($_GET['id'] == 5) {
    $duoc_giao = "Thịnh";
  }
?>
<style type="text/css">
table tr th {
  background: #0071ba;
  color: #fff;
}
#content table {
  width: 80%;
}
#content .box-cao {
  height: 100px;
  overflow-y: scroll;
}
#des .box-cao {
  height: 100px;
  overflow-y: scroll;
}
</style>
<h1><?= $duoc_giao ?></h1>
<table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 120px;">Tên</th>
        <th style="width: 50px;">Copy</th>
        <th>Nội dung</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Tên sản phẩm</td>
        <td><button onclick="copyClipboard_name()">Copy</button></td>
        <td id="name"><?= $row['name'] ?></td>
      </tr>
      <tr>
        <td>Nội dung</td>
        <td><button onclick="copyClipboard_note()">Copy</button></td>
        <td id="content">
          <div class="box-cao">
            <?= $content; ?>
            <p>---</p>
            <?= $row['note']; ?>
            <?php if (!empty($bao_gom_text)) { ?>
            <h6>Thông số kỹ thuật</h6>
            <?php } ?>
            <?= $bao_gom; ?>
          </div>
          
        </td>
      </tr>
      <tr>
        <td>Mô tả ngắn</td>
        <td><button onclick="copyClipboard_des()">Copy</button></td>
        <td id="des">
          <div class="box-cao">
            <?= $mota_ngan ?>
          </div>
        </td>
      </tr>
      <tr>
        <td>Giá</td>
        <td><button onclick="copyClipboard_price()">Copy</button></td>
        <?php if (empty($row['price_sale'])) { ?>
        <td id="price"><button onclick="copy_main('<?= $row['price'] ?>')"><?= $row['price'] ?></button> - <?= $row['price_sale'] ?></td>
      <?php } else { ?>
        <td id="price"><?= $row['price'] ?> - <?= $row['price_sale'] ?></td>
      <?php } ?>
      </tr>
      <tr>
        <td><button onclick="copy_main('Nguồn gốc')">Nguồn gốc</button></td>
        <td></td>
        <td>
          <?php if (!empty($row['price_sale'])) { ?>
          <table style="width: 500px;">
            <tr>
              <td><button onclick="copy_main('Hàng Nhập Khẩu')">Copy</button>Hàng Nhập Khẩu</td>
              <td><button onclick="copy_main('<?= $row['price'] ?>')">Copy</button><?= $row['price'] ?></td>
            </tr>
            <tr>
              <td><button onclick="copy_main('Hàng Chính Hãng')">Copy</button>Hàng Chính Hãng</td>
              <td><button onclick="copy_main('<?= $row['price_sale'] ?>')">Copy</button><?= $row['price_sale'] ?></td>
            </tr>
          </table>
        <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Mô tả SEO</td>
        <td><button onclick="copyClipboard_des_seo()">Copy</button></td>
        <td id="des_seo"><?= $row['des_seo'] ?></td>
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

function copyClipboard_price() {
  var elm = document.getElementById("price");
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

function copyClipboard_note() {
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

function copyClipboard_des() {
  var elm = document.getElementById("des");
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

function copyClipboard_des_seo() {
  var elm = document.getElementById("des_seo");
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

function copy_main (text) {
  navigator.clipboard.writeText(text);
}
</script>

</body>
</html>