<?php 

	function resize_img ($filepath, $thumbpath, $thumbnail_width, $thumbnail_height, $background=false) {
		list($original_width, $original_height, $original_type) = getimagesize($filepath);

		    if ($original_width < 600) {
		    	return false;
		    }

		        $new_width = $thumbnail_width;

		        $new_height = intval($original_height * $new_width / $original_width);

		    

		    $dest_x = intval(($thumbnail_width - $new_width) / 2);

		    $dest_y = intval(($thumbnail_height - $new_height) / 2);



		    if ($original_type === 1) {

		        $imgt = "ImageGIF";

		        $imgcreatefrom = "ImageCreateFromGIF";

		    } else if ($original_type === 2) {

		        $imgt = "ImageJPEG";

		        $imgcreatefrom = "ImageCreateFromJPEG";

		    } else if ($original_type === 3) {

		        $imgt = "ImagePNG";

		        $imgcreatefrom = "ImageCreateFromPNG";

		    } else {

		        return false;

		    }



		    $old_image = $imgcreatefrom($filepath);

		    $new_image = imagecreatetruecolor($new_width, $new_height); // creates new image, but with a black background



		    // figuring out the color for the background

		    if(is_array($background) && count($background) === 3) {

		      list($red, $green, $blue) = $background;

		      $color = imagecolorallocate($new_image, $red, $green, $blue);

		      imagefill($new_image, 0, 0, $color);

		    // apply transparent background only if is a png image

		    } else if($background === 'transparent' && $original_type === 3) {

		      imagesavealpha($new_image, TRUE);

		      $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);

		      imagefill($new_image, 0, 0, $color);

		    }



		    imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

		    $imgt($new_image, $thumbpath);

		    return file_exists($thumbpath);
	}

	function compress($source, $destination) {

		$co_file = filesize($source);

	    $info = getimagesize($source);

	    if ($info['mime'] == 'image/jpeg') 
	        $image = imagecreatefromjpeg($source);

	    elseif ($info['mime'] == 'image/gif') 
	        $image = imagecreatefromgif($source);

	    elseif ($info['mime'] == 'image/png') 
	        $image = imagecreatefrompng($source);

	    if ($co_file > 100000) {
	    	imagejpeg($image, $destination, 50);//echo 'ok';
	    }
	    

	    return $destination;
	}

	function vi_en2($str)
    {
        if (!$str)
            return '';
        $coDau = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ",
            "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì",
            "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ",
            "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ",
            "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ",
            "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ",
            "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ",
            "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à");
        $khongDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
            "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
            "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A",
            "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E",
            "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U",
            "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a");
        $str = str_replace($coDau, $khongDau, $str);
        $str = str_replace(' ', '-', $str);
        $str = preg_replace('/[^a-zA-Z0-9--\.]/', '', $str);
        $str = preg_replace('/(---|--)/', '-', $str);
            $str = strtolower($str);
            $str = str_replace(' ', '-', $str);
        return $str;
    }

	$link_anh_resize = dirname(__FILE__).'/../../'.$src.$img_name;
		    	resize_img($link_anh_resize, $link_anh_resize, 600, 600);
		    	compress($link_anh_resize, $link_anh_resize);