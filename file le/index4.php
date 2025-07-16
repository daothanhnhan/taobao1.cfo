<?php 
	include_once dirname(__FILE__) . "/database.php";
	include_once dirname(__FILE__) . "/library.php";
	include_once dirname(__FILE__) . "/action.php";

	$action = new action();

  $url = $_SERVER['REQUEST_URI'];
  // var_dump($url);
  if (strpos($url, 'procat')) {
    $url_text = str_replace('/?', '', $url);
    $url_arr = explode("&", $url_text);
    $loai = explode("=", $url_arr[0])[1];
    $url_arr_count = count($url_arr);
    if ($url_arr_count == 2) {
        $loi = explode("=", $url_arr[1])[1];
    } else {
      $loi = 0;
    }
    
  } else {
    $loai = 0;
  }
  // var_dump($loai);
  // var_dump($loi);
  if ($loi == 0) {
    $link = $action->getList_New('admin_link_2', array('loai'), array(&$loai), array('id'), array('asc'), 'i', '', '', '');//var_dump($link);
  } else {
    $link = $action->getList_New('admin_link_2', array('loai', 'error'), array(&$loai, &$loi), array('id'), array('asc'), 'ii', '', '', '');//var_dump($link);
  }
  $link = $action->getList('admin_link_3', '', '', 'id', 'asc', '', '', '');
  $myfile = fopen("link.txt", "w") or die("Unable to open file!");
  foreach ($link as $item) {
    // $txt = $item['link']."\n";
    // fwrite($myfile, $txt);
  }
	fclose($myfile);

  $link_count = count($link);

  $da_xong = $action->getList('admin_link_2', 'done', 1, 'id', 'asc', '', '', '');
  $da_xong_count = count($da_xong);

  $so_loi = $action->getList('admin_link_2', 'error', 1, 'id', 'asc', '', '', '');
  $so_loi_count = count($so_loi);

  $da_dang = $action->getList('admin_link_2', 'da_dang', 1, 'id', 'asc', '', '', '');
  $da_dang_count = count($da_dang);
  // var_dump($so_loi_count);

  $dm_arr = array('trống');
  $dm_arr[] = 'Máy ảnh - Ống kính - Máy in';
  $dm_arr[] = 'Máy quay';
  $dm_arr[] = 'Thiết bị quay phim, truyền hình';
  $dm_arr[] = 'Đèn LED quay phim';
  $dm_arr[] = 'Đèn Flash studio';
  $dm_arr[] = 'Đèn Flash dùng pin ngoài trời';
  $dm_arr[] = 'Gimbal chống run';
  $dm_arr[] = 'Phụ kiện máy ảnh, máy quay';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Danh sách sản phẩm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  
<table class="table">
    <thead>
      <tr>
        <th style="width: 50px;">Số thứ tự</th>
        <th style="width: 200px;">Tên sản phẩm</th>
        <th style="width: 300px;">Danh mục</th>
        <th>Link (<?= $dm_arr[$loai] ?>)</th>
        <th>Tick <input type="checkbox" name=""></th>
        
        
        
        <!-- <th>Email</th> -->
      </tr>
    </thead>
    <tbody>
      <?php 
      // $d = $link_count + 1;
      $d = 0;
      foreach ($link as $item) { 
      	$d++;
        $item_procat = str_replace(",", " ***", $item['procat']);
      ?>
      <tr>
        <td><?= $d ?></td>
        <td><?= $item['name'] ?></td>
        <td><?= $item_procat ?></td>
        <td><a href="<?= $item['link'] ?>" target="_bank"><?= $item['link'] ?></a></td>
        
        <td><input type="checkbox" name=""></td>
        
      </tr>
      <?php } ?>
    </tbody>
  </table>

<script>
  function loi (id) {
    // alert(id);
    const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("loi_id").innerHTML = this.responseText;
          // alert(this.responseText);
        }
      xhttp.open("GET", "/ajax/chon_loi.php?id="+id, true);
      xhttp.send();
  }

  function xong (id) {
    // alert(id);
    const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("da_xong_id").innerHTML = this.responseText;
          // alert(this.responseText);
        }
      xhttp.open("GET", "/ajax/chon_xong.php?id="+id, true);
      xhttp.send();
  }

  function ghi_chu (id, text) {
    // alert(id);
    // alert(text);
    const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        // document.getElementById("da_xong_id").innerHTML = this.responseText;
          // alert(this.responseText);
        }
      xhttp.open("GET", "/ajax/ghi_chu.php?id="+id+"&text="+text, true);
      xhttp.send();
  }

  function copy_main (text) {
    navigator.clipboard.writeText(text);
  }
</script>
</body>
</html>