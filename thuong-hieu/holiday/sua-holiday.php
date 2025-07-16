<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function holiday ($id) {
		global $conn_vn;
		if (isset($_POST['add_holiday'])) {
			$src= "../images/";
			// $src = "uploads/";

			try {
				$image = '';
				if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

					uploadPicture($src, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
					$image = $_FILES['image']['name'];

				}

				$name = $_POST['name'];
				$note = $_POST['note'];
				$add = '';
				if ($image != '') {
					$add = ", image = ?";
				}

				$sql = "UPDATE holiday SET name = ?, note = ? $add WHERE id = $id";//echo $sql;
				$stmt = $conn_vn->prepare($sql);
				if ($image == '') {
					$stmt->bind_param("ss", $name, $note);
				} else {
					$stmt->bind_param("sss", $name, $note, $image);
				}
				
				$stmt->execute();
				echo '<script type="text/javascript">alert(\'Bạn đã sửa được một Holiday.\')</script>';
			}
			catch (Exception $e) {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	holiday($_GET['id']);
	$info = $action->getDetail('holiday', 'id', $_GET['id']);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="rowNodeContentPage">
        <div class="leftNCP">
            <span class="titLeftNCP">Nội dung </span>
            <p class="subLeftNCP">Nhập thông tin Holiday<br /><br /></p>     
            <p class="subLeftNCP"><a href="index.php?page=holiday">Quay lại</a><br /><br /></p>     
                    
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tên</p>
            <input type="text" class="txtNCP1" name="name" value="<?= $info['name'] ?>" required/>
            <p class="titleRightNCP">Ảnh</p>
            <input type="file" class="txtNCP1" name="image" />
            <p class="titleRightNCP">Nội dung</p>
            <textarea name="note" class="txtNCP1 ckeditor" rows="6"><?= $info['note'] ?></textarea>
            <img src="/images/<?= $info['image'] ?>" alt="" width="200">
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_holiday">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>