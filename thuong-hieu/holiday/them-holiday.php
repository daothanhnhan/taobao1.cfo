<?php 
    function uploadPicture($src, $img_name, $img_temp){

		$src = $src.$img_name;//echo $src;

		if (!@getimagesize($src)){

			if (move_uploaded_file($img_temp, $src)) {

				return true;

			}

		}

	}

	

	function holiday () {
		global $conn_vn;
		if (isset($_POST['add_trademark'])) {
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

				$sql = "INSERT INTO holiday (name, image, note) VALUES (?, ?, ?)";
				$stmt = $conn_vn->prepare($sql);
				$stmt->bind_param("sss", $name, $image, $note);
				$stmt->execute();
				echo '<script type="text/javascript">alert(\'Bạn đã thêm được một Holiday.\');window.location.href="index.php?page=holiday"</script>';
			}
			catch (Exception $e) {
				echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
			}
			
		}
	}

	holiday();
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
            <input type="text" class="txtNCP1" name="name" required/>
            <p class="titleRightNCP">Ảnh</p>
            <input type="file" class="txtNCP1" name="image" required/>
            <p class="titleRightNCP">Nội dung</p>
            <textarea name="note" class="txtNCP1 ckeditor" rows="6"></textarea>
        </div>
    </div><!--end rowNodeContentPage-->
    
    <button class="btn btnSave" type="submit" name="add_trademark">Lưu</button>
</form>
            
<p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ Cafelink Việt Nam</p>