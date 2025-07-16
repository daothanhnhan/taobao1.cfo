<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function thuong_hieu ($id) {
		global $conn_vn;
		if (isset($_POST['add_trademark'])) {
			$src= "../images/";
			// $src = "uploads/";
			$image = '';

			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

				uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
				$image = $_FILES['image']['name'];

			}

			$name = $_POST['name'];

			if ($image == '') {
				$sql = "UPDATE trademark SET name = '$name' WHERE id = $id";
			} else {
				$sql = "UPDATE trademark SET name = '$name', image = '$image' WHERE id = $id";
			}

			$result = mysqli_query($conn_vn, $sql);
			if ($result) {
				echo '<script type="text/javascript">alert(\'Bạn đã sửa thương hiệu thành công.\')</script>';
			} else {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	thuong_hieu($_GET['id']);

	function getThuongHieu ($id) {
		global $conn_vn;
		$sql = "SELECT * FROM trademark WHERE id = $id";
		$result = mysqli_query($conn_vn, $sql) or die('loi');
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	$get_thuong_hieu = getThuongHieu($_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin thương hiệu<br /><br /></p>  
            <p class="subLeftNCP"><a href="index.php?page=thuong-hieu">Quay lại</a><br /><br /></p>   
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên thương hiệu</p>
            <input type="text" class="txtNCP1" name="name" value="<?= $get_thuong_hieu['name'] ?>" required/>
            <p class="titleRightNCP">Ảnh thương hiệu</p>
            <input type="file" class="txtNCP1" name="image"/>
            <img src="/images/<?= $get_thuong_hieu['image'] ?>" width="100">
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_trademark">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Phát Triển Thương Hiệu Cafe Link Việt Nam</p>