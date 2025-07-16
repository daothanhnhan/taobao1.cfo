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
  <form>
    <div class="form-group">
      <label for="sel1">Chọn danh mục:</label>
      <select class="form-control" id="sel1" name="procat">
        <option value="0">Chọn danh mục</option>
        <option value="1" <?= $loai==1 ? 'selected' : '' ?> >Máy ảnh - Ống kính - Máy in</option>
        <option value="2" <?= $loai==2 ? 'selected' : '' ?> >Máy quay</option>
        <option value="3" <?= $loai==3 ? 'selected' : '' ?> >Thiết bị quay phim, truyền hình</option>
        <option value="4" <?= $loai==4 ? 'selected' : '' ?> >Đèn LED quay phim</option>
        <option value="5" <?= $loai==5 ? 'selected' : '' ?> >Đèn Flash studio</option>
        <option value="6" <?= $loai==6 ? 'selected' : '' ?> >Đèn Flash dùng pin ngoài trời</option>
        <option value="7" <?= $loai==7 ? 'selected' : '' ?> >Gimbal chống rung</option>
        <option value="8" <?= $loai==8 ? 'selected' : '' ?> >Phụ kiện máy ảnh, máy quay</option>
      </select>

      <label for="sel1">Lọc lỗi:</label>
      <select class="form-control" id="sel1" name="loi">
        <option value="0" <?= $loi==0 ? 'selected' : '' ?> >Tất cả</option>
        <option value="1" <?= $loi==1 ? 'selected' : '' ?> >Lọc lỗi</option>
      </select>
      <button type="submit">Chọn</button>
      
    </div>
  </form>
<table class="table">
    <thead>
      <tr>
        <th style="width: 50px;">Số thứ tự</th>
        <th style="width: 200px;">Tên sản phẩm</th>
        <th style="width: 300px;">Danh mục</th>
        <th>Link (<?= $dm_arr[$loai] ?>)</th>
        
        <th>Đã đăng (<span><?= $da_dang_count ?></span>)</th>
        <th>Đã xong (<span id="da_xong_id"><?= $da_xong_count ?></span>)</th>
        <th>Lỗi (<span id="loi_id"><?= $so_loi_count ?></span>)</th>
        <th>Ghi chú</th>
        
        
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
        
        <td><input type="checkbox" name="" <?= $item['da_dang']==1 ? 'checked' : '' ?>></td>
        <td><input type="checkbox" name="" onclick="xong(<?= $item['id'] ?>)" <?= $item['done']==1 ? 'checked' : '' ?>></td>
        <td><input type="checkbox" name="" onclick="loi(<?= $item['id'] ?>)" <?= $item['error']==1 ? 'checked' : '' ?>></td>
        <td><textarea onkeyup="ghi_chu(<?= $item['id'] ?>, this.value)"><?= $item['note'] ?></textarea></td>
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