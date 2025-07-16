<?php 
    function generateRandomString($length = 6) {
      // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[random_int(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    function dang_nhap () {
        global $conn_vn;
        if (isset($_POST['dang_nhap'])) {
            $name = $_POST['name'];
            $pass = $_POST['password'];

            $sql = "SELECT * FROM admin WHERE admin_login = '$name'";
            $result = mysqli_query($conn_vn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1) {
                $row = mysqli_fetch_assoc($result);
                $admin_pass = $row['admin_password'];
                if (password_verify($pass, $admin_pass)) {
                  $_SESSION['admin_id_home'] = $row['admin_id'];
                  if (isset($_POST['rememberme'])) {
                        $identify = randomString(20);
                        $token = randomString(30);
                        $cooki = $identify . ':' . $token;

                        setcookie('user_id_trichdan', $cooki, time() + 2592000);
                        $sql_me = "UPDATE admin SET remember_me_identify = '$identify', remember_me_token = '$token' Where admin_id = " . $row['admin_id'];
                        $result_me = mysqli_query($conn_vn, $sql_me);
                    }
                    echo '<script>alert(\'Đăng nhập thành công.\');location.href = "/quan-ly-ca-nhan";</script>';
                    
                } else {
                    echo '<script>alert(\'Tên đăng nhập hoặc mật khẩu không đúng.\')</script>';
                }
            } else {
                echo '<script>alert(\'Tên đăng nhập hoặc mật khẩu không đúng.\')</script>';
            }
        }
    }
    dang_nhap();

    function dang_ky () {
        global $conn_vn;
        global $action;
        $action_email = new action_email();
        if (isset($_POST['dang_ky'])) {
            $admin_name = $_POST['admin_name'];
            $admin_login = $_POST['admin_login'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $admin_email = $_POST['admin_email'];
            $admin_phone = $_POST['admin_phone'];
            $admin_phone_2 = $_POST['admin_phone_2'];
            $admin_address = $_POST['admin_address'];
            $moi_gioi = $_POST['moi_gioi'];

            $loai_bds = $_POST['loai_bds'];
            $city_id = $_POST['city_id'];
            $district_id = $_POST['district_id'];

            $note = mysqli_real_escape_string($conn_vn, $_POST['note']);

            $now = date('Y-m-d H:i:s');

            $code_otp = generateRandomString();

            $checkUser = $action->getDetail('admin','admin_login',$admin_login);
            $ok = 1;
            if ($checkUser != '') {
                $ok = 0;
                echo '<script>alert(\'Tên đăng nhập đã tồn tại.\')</script>';
            }

            $checkUser_email = $action->getDetail('admin','admin_email',$admin_email);
            if ($checkUser_email != '') {
                $ok = 0;
                echo '<script>alert(\'Email đã tồn tại.\')</script>';
            }

            $checkUser_phone = $action->getDetail('admin','admin_phone',$admin_phone);
            if ($checkUser_phone != '') {
                $ok = 0;
                echo '<script>alert(\'Số điện thoại đã tồn tại.\')</script>';
            }

            if ($pass1 != $pass2) {
                $ok = 0;
                echo '<script>alert(\'Mật khẩu không khớp.\')</script>';
            }

            if ($ok == 1) {
                $admin_password = password_hash($pass1, PASSWORD_DEFAULT);

                $sql = "INSERT INTO admin (admin_name, admin_login, admin_password, admin_email, admin_phone, admin_state, admin_role, code_otp, admin_address, admin_phone_2, moi_gioi, loai_bds, city_id, district_id, ngay_tao, note) VAlUES ('$admin_name', '$admin_login', '$admin_password', '$admin_email', '$admin_phone', '1', '2', '$code_otp', '$admin_address', '$admin_phone_2', '$moi_gioi', '$loai_bds', '$city_id', '$district_id', '$now', '$note')";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                    $admin_id = mysqli_insert_id($conn_vn);
                    $_SESSION['admin_id_home'] = $admin_id;
                    echo '<script>alert(\'Bạn đã đăng ký thành công.\');location.href = "/xac-thuc-otp";</script>';
                    $action_email->email_send($admin_email, 'Mã OTP', $code_otp);
                } else {
                    echo '<script>alert(\'Có lỗi xảy ra.\')</script>';
                }
            }
        }
    }
    dang_ky();

    if(!isset($_COOKIE['user_id_trichdan'])) {
      // echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
      // echo "Cookie '" . $cookie_name . "' is set!<br>";
      // echo "Value is: " . $_COOKIE[$cookie_name];
      $remember_me = explode(":", $_COOKIE['user_id_trichdan']);
      $remember_me_identify = $remember_me[0];
      $remember_me_token = $remember_me[1];
      $sql_me = "SELECT * FROM admin WHERE remember_me_identify = '$remember_me_identify' and remember_me_token = '$remember_me_token'";
      $result_me = mysqli_query($conn_vn, $sql_me);
      $num_me = mysqli_num_rows($result_me);
      if (!empty($num_me)) {
        $row_me = mysqli_fetch_assoc($result_me);
        $_SESSION['admin_id_home'] = $row_me['admin_id'];
      }
    }

    $productcat = $action->getList('productcat', '', '', 'productcat_id', 'asc', '', '', '');

    $city = $action->getList('city', '', '', 'id', 'asc', '', '', '');

    $bat_buoc = '(<span style="color:red;">*</span>)';
?>
<style>
.content-main {
    width: 100% !important;
}
.container {
    width: 1000px;
}
img {
  max-width: 100%;
  height: auto;
}
body {
    font-size: 12px;
    padding: 0;
    margin: 0;
    background-repeat: repeat-x;
    /*font-family: Arial,Verdana,sans-serif;*/
    background-image: url(/images/background.jpg);
    background-repeat: repeat-x;
    background-position: top left;
    line-height: 16px;
    /*position: relative;*/
}
.content-main {
    width: 1000px;
    margin: auto;
    background: #fff;
    box-shadow: 0 0 15px #969696;
    /*position: relative;*/
    z-index: 100;
    /*padding-top: 40px;*/
}


.gb-main-menu_ldpvinhome .cssmenu>ul>li>a {
  text-transform: unset;
  
}
.gb-main-menu_ldpvinhome {
  background: #eb3002;
}
.gb-header-between_ruouvang {
  background: #eb3002;
}

.da-thich {
  color: red !important;
}

.gb-main-menu_ldpvinhome .cssmenu ul ul li a {
  font-size: 13px;
}

.gb-main-menu_ldpvinhome .cssmenu ul ul {
  top: 95%;
}

.quen-mat-khau {
  /*width: 100%;*/
  color: red;
  margin-top: 10px;
  margin-bottom: 10px;
  /*display: block;*/
}
#dangky input:hover {
  border: 1px solid red;
}
@media screen and (min-width: 991px) {
  .set-width-header {
      width: 1250px;
      text-align: center;
  }
}

#show-dang-ky {
  color: green;
  margin-bottom: 20px;
  cursor: pointer;
}
</style>
<!--MENU MOBILE-->
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<?php include_once DIR_MENU."MS_MENU_H2D_0002.php"; ?>
<!-- End menu mobile-->
<!--MENU DESTOP-->
<header class="">
    <div class="gb-header-ruouvang">
        <div class="gb-top-header_ruouvang">
            <div class="gb-header-between_ruouvang">
                <div class="container1">
                    <div class="row">
                       
                        <div class="col-md-12 col-sm-12">
                           <div class="row">
                              <div class="container set-width-header" style="">
                                <?php include DIR_MENU."MS_MENU_H2D_0001.php";?>
                              </div>
                                
                                <a href="/"><img src="/images/logo-bds-1.png" alt="logo" style="position: absolute;top: 55px;left: 20px;width: 150px;z-index: 9999;"></a>
                           </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="container">
                <?php include_once DIR_HEADER."MS_HEADER_CHOVIET_0001.php"; ?>
            </div>
            
        </div>
    </div>
</header>
<!-- /header -->
<script src="/plugin/sticky/jquery.sticky.js"></script>
<script>
$(document).ready(function() {

    $(".sticky-menu").sticky({ topSpacing: 0 });

});
</script>

<!-- Modal -->
<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="dong-dang-nhap">&times;</button>
        <h4 class="modal-title">Đăng nhập</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="form-dang-nhap">
          <div class="form-group">
            <label for="email">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="email-dang-nhap" name="name" required="">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd-dang-nhap" name="password" required="">
          </div>
          <div class="form-group">
            <label class="checkbox-inline"><input type="checkbox" value="1" name="rememberme">Duy trì đăng nhập</label>
          </div>
          <p><a href="/quen-mat-khau" title="" class="quen-mat-khau">Quên mật khẩu?</a> &nbsp;&nbsp;&nbsp; <span id="show-dang-ky" onclick="show_dang_ky()">Đăng ký</span></p>
          
          
          <button type="submit" name="dang_nhap" class="btn btn-default">Đăng nhập</button>

          <div>

            <br>
            <a href="/login-go.html" title=""><img src="/images/google-sign-in-button.png" alt="login" width="200"></a>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="dangky" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;color: #b5b500;font-size: 20px;">Đăng ký thành viên</h4>
        <br>
        <p style="color: red;">Lưu ý: Giả mạo thông tin của cá nhân, tổ chức để tham gia hoạt động thương mại điện tử nhằm gây ảnh hưởng đến uy tín, cuộc sống của cá nhân, tổ chức có thể bị phạt tới 30 triệu đồng.<br>
Xem thêm NĐ 52/2013/NĐ-CP. Thông tin người đăng thật sự có thể được xác định thông qua địa chỉ ip của máy tính, điện thoại,...</p>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          
          <div class="form-group">
            <label for="email">Tên đăng nhập<?= $bat_buoc ?></label>
            <input type="text" class="form-control" id="email" name="admin_login" placeholder="Tên đăng nhập" required="">
          </div>
          <div class="form-group">
            <label for="email">Mật khẩu<?= $bat_buoc ?></label>
            <input type="password" class="form-control" id="pwd" name="pass1" placeholder="Mật khẩu" required="">
          </div>
          <div class="form-group">
            <label for="email">Nhập lại mật khẩu<?= $bat_buoc ?></label>
            <input type="password" class="form-control" id="pwd" name="pass2" placeholder="Nhập lại mật khẩu" required="">
          </div>
          <div class="form-group">
            <label for="email">Họ tên<?= $bat_buoc ?></label>
            <input type="text" class="form-control" id="email" name="admin_name" placeholder="Họ tên" required="">
          </div>
          <div class="form-group">
            <label for="email">Địa chỉ Email<?= $bat_buoc ?></label>
            <input type="email" class="form-control" id="email" name="admin_email" placeholder="Địa chỉ E-Mail" required="">
          </div>
          <div class="form-group">
            <label for="email">Nhập số điện thoại<?= $bat_buoc ?></label>
            <input type="number" class="form-control" id="email" name="admin_phone" placeholder="Nhập số điện thoại" required="">
          </div>
          <div class="form-group">
            <label for="email">Nhập số điện thoại 2</label>
            <input type="number" class="form-control" id="email" name="admin_phone_2" placeholder="Nhập số điện thoại 2" >
          </div>
          <div class="form-group">
            <label for="email">Nhập địa chỉ<?= $bat_buoc ?></label>
            <input type="text" class="form-control" id="email" name="admin_address" placeholder="Nhập địa chỉ" required="">
          </div>
          <div class="form-group">
            <label for="email">Loại tài khoản<?= $bat_buoc ?></label>
            <select class="form-control" id="sel1" name="moi_gioi" onchange="chon_moi_gioi(this.value)">
              <option value="0">Cá nhân</option>
              <option value="1">Nhà môi giới</option>
            </select>
          </div>
          <div id="info-moi-gioi" style="display: none;">
            <div class="form-group">
              <label for="email">Loại BĐS môi giới chính<?= $bat_buoc ?></label>
              <select class="form-control" id="sel1" name="loai_bds">
                <option value="0">Loại BĐS</option>
                <?php foreach ($productcat as $item) { ?>
                <option value="<?= $item['productcat_id'] ?>"><?= $item['productcat_name'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Khu vực hoạt động chỉnh<?= $bat_buoc ?></label>
              <select class="form-control" id="sel1" name="city_id" onchange="chon_tinh(this.value)">
                <option value="0">Tình/Thành</option>
                <?php foreach ($city as $item) { ?>
                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                <?php } ?>
              </select>
              <br>
              <select class="form-control" id="huyen_id" name="district_id">
                <option value="0">Quận/Huyện</option>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Giới thiệu</label>
              <textarea class="form-control" rows="5" id="comment" name="note"></textarea>
            </div>
          </div>
          <button type="submit" name="dang_ky" class="btn btn-default">Đăng ký mới</button>
          <p style="color: red;margin-top: 10px;">Số điện thoại hỗ trợ <em>0798 666 239</em></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  function show_dang_ky () {
    // alert('dangky');
    document.getElementById('dong-dang-nhap').click();

    const myTimeout = setTimeout(myGreeting, 1000);
  }

  function chon_moi_gioi (val) {
    var box_info_moi_gioi = document.getElementById('info-moi-gioi');
    if (val == 1) {
      box_info_moi_gioi.style.display = 'block';
    } else {
      box_info_moi_gioi.style.display = 'none';
    }
  }
</script>

<script>


function myGreeting() {
  document.getElementById('mo-dang-ky').click();
}
</script>

<script>
$(document).ready(function () {
  $("#form-dang-nhap").submit(function (event) {
    var formData = {
      name: $("#email-dang-nhap").val(),
      password: $("#pwd-dang-nhap").val(),
      // superheroAlias: $("#superheroAlias").val(),
    };

    $.ajax({
      type: "POST",
      url: "/functions/ajax/dang-nhap.php",
      data: formData,
      // dataType: "json",
      // encode: true,
    }).done(function (data) {
      // console.log(data);
      // alert(data);
      if (data == 1) {
        alert('Đăng nhập thành công.');
        location.href = "/quan-ly-ca-nhan";
      } else {
        alert('Tên đăng nhập hoặc mật khẩu không đúng.');
      }
    });

    event.preventDefault();
  });
});
</script>