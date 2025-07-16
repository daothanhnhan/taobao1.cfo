<?php 

/**

* 

*/

date_default_timezone_set('Asia/Ho_Chi_Minh'); /* Set múi giờ */
class library{
	
	/*--- thao tác trên table config và config_languages ---*/
	public $nameTable_config = 'config';
	public $nameColId_config = 'config_id';
	public $nameColWebName_config = 'web_name';
	public $nameColWebDes_config = 'web_des';
	public $nameColWebKeyword_config = 'web_keyword';
	public $nameColWebLogo_config = 'web_logo';
	public $nameColWebHotline_config = 'web_hotline';
	public $nameColWebPhone_config = 'web_phone';

	public $nameTable_configLanguage = 'config_languages';
	public $nameColId_configLanguage = 'config_id';
	public $nameColType_configLanguage = 'languages_code';
	public $nameColWebName_configLanguage = 'lang_web_name';
	public $nameColWebDes_configLanguage = 'lang_web_des';
	public $nameColWebKeyword_configLanguage = 'lang_web_keyword';
	public $nameColWebLogo_configLanguage = 'lang_web_logo';
	public $nameColWebHotline_configLanguage = 'lang_web_hotline';
	public $nameColWebPhone_configLanguage = 'lang_web_phone';

	/*--- thao tác trên table menu ---*/
    public $nameTable_menu = 'menu';
    public $nameColParent_menu = 'menu_parent'; 
    public $nameColID_menu = 'menu_id';
    public $nameColTitle_menu = 'menu_name';
    public $nameColStateEnable_menu = 'state';
    public $nameColTypeId_menu = 'menu_type_id';
    public $nameColOrder_menu='menu_sort_order';
    public $nameColProductCatId_menu='productcat_id';    
    public $nameColProductId_menu='product_id';
    public $nameColNewsCatId_menu='newscat_id';    
    public $nameColNewsId_menu='news_id';
    public $nameColPageId_menu='page_id';
    public $nameColServiceId_menu='service_id';
    public $nameColServiceCatId_menu='servicecat_id';  
    public $nameColStateMain_menu='state';
    public $nameColStateHeader_menu='state_menuHeader';

    /*--- thao tác trên table menu_languages---*/
    public $nameColTitle_menuLanguage = 'lang_menu_name';
    public $nameColUrl_menuLanguage = 'urlFriendly_menu';
    public $nameTable_menuLanguage = 'menu_languages';
    public $nameColType_menuLanguage= 'languages_code';
    public $nameColIdMenu_menuLanguage= 'menu_id';
    
	/*--- thao tác trên table menu_type_languages---*/
    public $nameTable_menuTypeLanguage = 'menu_type_languages';
    public $nameColType_menuTypeLanguage= 'languages_code';

    public $nameColIdMenuType_menuTypeLanguage= 'menu_type_id';
    public $nameColMenuTypeName_menuTypeLanguage= 'menu_type_name';
    public $nameColUrl_menuTypeLanguage= 'friendly_url';



    /*--- thao tác trên các table product va product languages ---*/
    public $nameTable_product = 'product';
    public $nameColId_product = 'product_id';
    public $nameColIdProductCat_product = 'productcat_id';
    public $nameColPriceSale_product = 'product_price_sale';
    public $nameColHot_product = 'product_hot';
    public $nameColNew_product = 'product_new';

    public $nameTable_productLanguage = 'product_languages';
    public $nameColType_productLanguage = 'languages_code';
    public $nameColIdProduct_productLanguage = 'product_id';
    public $nameColUrlProduct_productLanguage = 'friendly_url';
    public $nameColLangProductName_productLanguage = 'lang_product_name';


    /*--- thao tác trên các table productCat va productCat languages ---*/
    public $nameTable_productCat = 'productcat';
    public $nameColId_productCat = 'productcat_id';
    public $nameColId_productCatParent = 'productcat_parent';
    public $nameColStateProductCat_productCat  = 'state';
    public $nameColOrder_productCat = 'productcat_sort_order';
    public $nameColParent_productCat = 'productcat_parent';
    //public $nameColIdParent_productCat = 'productcat_parent';

    public $nameTable_productCatLanguage = 'productcat_languages';
    public $nameColTitle_productCatLanguage = 'lang_productcat_name';
    public $nameColType_productCatLanguage = 'languages_code';
    public $nameColIdProductCat_productCatLanguage = 'productcat_id';
    public $nameColUrlProductCat_productCatLanguage = 'friendly_url';    

    /*--- thao tác trên các table producer và producer languages ---*/
    public $nameTable_producer = 'product_producer';
    public $nameColOrder_producer = 'producer_sort_order';
    public $nameColParent_producer = 'producer_parent';
    public $nameColId_producer = 'producer_id';    
    public $nameColTitle_producer = 'producer_name'; 
    public $nameColStateProducer_producer = 'state';
	public $nameTable_producerLanguage = 'product_producer_languages';
	public $nameColType_producerLanguage = 'languages_code';
	public $nameColTitle_producerLanguage = 'lang_producer_name';
	public $nameColUrlProducer_producerLanguage = 'friendly_url';
    public $nameColIdProducer_producerLanguage = 'producer_id';

    /*--- thao tác trên các table News va News languages ---*/
    public $nameTable_news = 'news';
    public $nameColId_news = 'news_id';
    public $nameTable_newsLanguage = 'news_languages';
    public $nameColType_newsLanguage = 'languages_code';
    public $nameColIdNews_newsLanguage = 'news_id';
    public $nameColUrlNews_newsLanguage = 'friendly_url'; 
    public $nameColIdNewsCat_news = 'newscat_id';
    public $nameColLangNewsName_newsLanguage = 'lang_news_name';

    /*--- thao tác trên các table News CAT va News CAT languages ---*/
    public $nameTable_newsCat = 'newscat';
    public $nameColId_newsCat = 'newscat_id';
    public $nameColId_newsCatParent = 'newscat_parent';

    public $nameTable_newsCatLanguage = 'newscat_languages';
    public $nameColType_newsCatLanguage = 'languages_code';
    public $nameColIdNewsCat_newsCatLanguage = 'newscat_id';
    public $nameColUrlNewsCat_newsCatLanguage = 'friendly_url'; 
    public $nameColLangNewsCatName_newsCatLanguage = 'lang_newscat_name';

    /*--- thao tác trên các table Service va Service languages ---*/
    public $nameTable_service = 'service';
    public $nameColId_service = 'service_id';

    public $nameTable_serviceLanguage = 'service_languages';
    public $nameColType_serviceLanguage = 'languages_code';
    public $nameColIdService_serviceLanguage = 'service_id';
    public $nameColUrlService_serviceLanguage = 'friendly_url';  
    public $nameColLangServiceName_serviceLanguage = 'lang_service_name';

    /*--- thao tác trên các table Service Cat va Service Cat languages ---*/
    public $nameTable_serviceCat = 'servicecat';

    public $nameColId_serviceCat = 'servicecat_id';
    public $nameColId_serviceCatParent = 'servicecat_parent';

    public $nameTable_serviceCatLanguage = 'servicecat_languages';
    public $nameColType_serviceCatLanguage = 'languages_code';
    public $nameColIdServiceCat_serviceCatLanguage = 'servicecat_id';
    public $nameColUrlServiceCat_serviceCatLanguage = 'friendly_url'; 
    public $nameColLangServiceCatName_serviceCatLang = 'lang_servicecat_name';

    /*--- thao tác trên các table page va page languages ---*/
    public $nameTable_page = 'page';
    public $nameColId_page = 'page_id';

    public $nameTable_pageLanguage = 'page_languages';
    public $nameColType_pageLanguage = 'languages_code';
    public $nameColId_pageLanguage = 'page_id';
    public $nameColUrl_pageLanguage = 'friendly_url'; 
    public $nameColLangPageName_pageLanguage = 'lang_page_name';
	
    public function getDate(){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
    	return date('Y-m-d');
    }

	/*----------- Tính % giá khuyến mãi ---------------*/



		function percent($num_amount, $num_total) {

			$count1 = $num_amount / $num_total;

			$count2 = $count1 * 100;

			$count = number_format($count2, 2);

			return round(100 - $count);

		}





	/*----------------- Lấy ngày -------------------*/



		public function get_Date($format){

			return date($format);

		}



	/*---------------- Upload image ----------------*/



		public function uploadPicture($src, $img_name, $img_temp){

			$src = $src.$img_name;

			if (!@getimagesize($src)){

				if (move_uploaded_file($img_temp, $src)) {

					return true;

				}

			}

		}



	/*-------------- Tạo thumbnails ---------------*/



		function createThumbnail($filepath, $thumbpath, $thumbnail_width, $thumbnail_height, $background=false) {

		    list($original_width, $original_height, $original_type) = getimagesize($filepath);

		    if ($original_width > $original_height) {

		        $new_width = $thumbnail_width;

		        $new_height = intval($original_height * $new_width / $original_width);

		    } else {

		        $new_height = $thumbnail_height;

		        $new_width = intval($original_width * $new_height / $original_height);

		    }

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

		    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height); // creates new image, but with a black background



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



		    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);

		    $imgt($new_image, $thumbpath);

		    return file_exists($thumbpath);

		}



	/*-------------- Tạo slug độc nhất -----------------*/



		public function GetFinalSlug($slug, $table, $id){

			global $conn_vn;

			if ($id != "") {

				$id = "and id_".$table." != '".$id."'";

			}

			$sql = "select * from ".$table." where friendly_url ='".$slug."' $id";

			$result = mysqli_query($conn_vn,$sql);

			if(mysqli_num_rows($result) > 0){

				for ($i=1; $i < 99999; $i++) { 

					$new_slug = $slug.'-'.$i;

					$sql1 = "SELECT * from $table where friendly_url = '".$new_slug."' limit 1";

					$result1 = mysqli_query($conn_vn,$sql1);

					if (mysqli_num_rows($result1) == 0) {

						return $new_slug;

						break;

					}

				}

			}else{

				return $slug;

			}

		}

		public function GetFinalSlug1($slug, $table, $id){

			global $conn_vn;

			if ($id != "") {

				$id = "and ".$table."_id != '".$id."'";

			}

			$sql = "select * from ".$table." where friendly_url ='".$slug."' $id";

			$result = mysqli_query($conn_vn,$sql);

			if(mysqli_num_rows($result) > 0){

				for ($i=1; $i < 99999; $i++) { 

					$new_slug = $slug.'-'.$i;

					$sql1 = "SELECT * from $table where friendly_url = '".$new_slug."' limit 1";

					$result1 = mysqli_query($conn_vn,$sql1);

					if (mysqli_num_rows($result1) == 0) {

						return $new_slug;

						break;

					}

				}

			}else{

				return $slug;

			}

		}

		public function GetFinalSlug2($slug, $table, $id){

			global $conn_vn;

			if ($id != "") {

				$id = "and ".$table."_id != '".$id."'";

			}

			$sql = "select * from ".$table." where friendly_url ='".$slug."' $id";

			$result = mysqli_query($conn_vn,$sql);

			if(mysqli_num_rows($result) > 0){

				for ($i=1; $i < 99999; $i++) { 

					$new_slug = $slug.'-'.$i;

					$sql1 = "SELECT * from $table where friendly_url = '".$new_slug."' limit 1";

					$result1 = mysqli_query($conn_vn,$sql1);

					if (mysqli_num_rows($result1) == 0) {

						echo json_encode(array('error' => 'Tên sản phẩm của bạn bị trùng.'));
						die();

					}

				}

			}else{

				return $slug;

			}

		}



	/*------------- Hàm Thêm mới ---------------*/



		public function Insert_1($table, $name, $value, $type){

			global $conn_vn;

			$string = array();

			$total = count($name);

			$name = implode(',', $name);



			for ($i=0; $i < $total; $i++) { 

				$string[] = '?';

			}



			$string = implode(',', $string);

			$sql = "INSERT into $table($name) values ($string)";



			$stmt = $conn_vn->prepare($sql);

			call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $value));



			

			if ($stmt->execute()) {

				if ($conn_vn->affected_rows > 0) {

					return $stmt->insert_id;

				}

			}

		}



	/*------------- Hàm cập nhật ---------------*/



		public function Update_1($table, $name, $value, $where_names, $type){

			global $conn_vn;

			$string = array();

			$where = array();

			foreach ($name as $key => $val) {

				$string[] = $val.' = ?';

			}



			foreach ($where_names as $key => $where_name) {

				$where[] = $where_name.' = ?';

			}



			$string = implode(',', $string);

			$where = implode(' and ', $where);



			$sql = "UPDATE $table set $string where $where";

			//echo $sql;

			// print_r($value);

			$stmt = $conn_vn->prepare($sql);

			call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $value));

			if ($stmt->execute()) {

				return true;

			}else{

				echo $stmt->error;

			}

		}



	/*-------------- Hàm xóa --------------*/



		public function Delete_1($table, $name, $value, $where_names, $type){

			global $conn_vn;

			$string = array();

			$where = array();

			foreach ($name as $key => $val) {

				$string[] = $val.' = ?';

			}



			foreach ($where_names as $key => $where_name) {

				$where[] = $where_name.' = ?';

			}



			$string = implode(',', $string);

			$where = implode(' and ', $where);



			$sql = "DELETE from $table where $where";

			// echo $sql;

			$stmt = $conn_vn->prepare($sql);

			call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $value));

			if ($stmt->execute()) {

				return true;

			}

		}



	/*------------- Hàm select list ----------------*/



		public function getList_New($table, $where_name, $where_value, $order_name, $order_value, $type, $trang, $limit, $page, $slug = ''){

			global $conn_vn;

	        $string = array();

	        $where = array();

	        $order = array();



	        foreach ($where_name as $key => $val) {

	            $where[] = $val.' = ?';

	        }



	        foreach ($order_name as $key => $val) {

	            $order[] = $val.' '.$order_value[$key];

	        }



	        $where = implode(' and ', $where);

	        $order = implode(', ', $order);



	        if ($trang == '' && $limit != '') {

	            $limit1 = 'limit '.$limit;

	        }



	        if ($where != '') {

	            $where1 = 'where '.$where;

	        }



	        if ($order != '') {

	            $order1 = 'order by '.$order;

	        }



	        $sql = "SELECT * from $table $where1 $order1 $limit1";

	        // echo $sql;

	        

	        $stmt = $conn_vn->prepare($sql);

	        call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $where_value));

	        $stmt->execute();



	        

	        $rows = array();

	        if ($trang != "" && $limit != "") {

	            $stmt->store_result();

	            $total_record = $stmt->num_rows;

	            $config = array(

	                'current_page'=> $trang != "" ? $trang : 1,

	                'total_record'=> $total_record,

	                'limit' => $limit,

	                'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',

	                'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page,

	                'range'=> 3

	            );

	            $paging = new Pagination();

	            $paging->init($config);

	            $start = $paging->_config['start'];

	            $limit = $paging->_config['limit'];

	            $sql = "SELECT * from $table $where1 $order1 limit $start, $limit";

	            $stmt = $conn_vn->prepare($sql);

	            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $where_value));

	            $stmt->execute();

	            $results = $stmt->get_result();

	            while($row = $results->fetch_assoc()){

	                $rows[] = $row;

	            }

	            

	            $p = $paging->htmlPaging();

	            $rows1 = array("data"=>$rows, "paging"=>$p);

	            return $rows1;

	        }else{

	            $results = $stmt->get_result();

	            while($row = $results->fetch_assoc()){

	                $rows[] = $row;

	            }

	            return $rows;

	        }

	    }



	    public function getList($table, $name_idCat, $id_Cat, $order_name, $order_state, $trang, $limit, $page, $slug = ''){

	    	global $conn_vn;

	        if ($id_Cat != "" && $name_idCat != "") {

	            $cond = "&".$name_idCat."=".$id_Cat;

	            // $cond = "";

	            $where = " where $name_idCat='".$id_Cat."'";

	        }else{

	            $cond = "";

	        }

	        if ($order_name != "" && $order_state != "") {

	            $order = "order by $order_name $order_state ";

	        }

	        $rows = array();

	        if ($trang == '' && $limit != '') {

	        	$limit1 = 'limit '.$limit;

	        }

	        $sql = "SELECT * From $table $where $order $limit1";

	        // echo $sql;

	        $result = mysqli_query($conn_vn,$sql);

	        $total_record = mysqli_num_rows($result);

	        if ($trang != "" && $limit != "") {

	            $config = array(

	                'current_page'=> $trang != "" ? $trang : 1,

	                'total_record'=> $total_record,

	                'limit' => $limit,

	                'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',

	                'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page,

	                // 'link_full'=> $slug != '' ? $slug.'/'.$page.$cond.'/{trang}',

	                // 'link_first'=> $slug != '' ? $slug : '/'.$page,

	                // 'link_full'=> $slug != '' ? $slug.'/{trang}' : '/'.$page.'/{trang}',

	                // 'link_first'=> $slug != '' ? $slug : '/'.$page,

	                'range'=> 3

	            );

	            $paging = new Pagination();

	            $paging->init($config);

	            $start = $paging->_config['start'];

	            $limit = $paging->_config['limit'];

	            $sql = "SELECT * from $table $where $order limit $start, $limit";

	            $result = mysqli_query($conn_vn,$sql);

	            while($row = mysqli_fetch_array($result)){

	                $rows[] = $row;

	            }

	            $p = $paging->htmlPaging();

	            $rows1 = array("data"=>$rows, "paging"=>$p);

	            return $rows1;

	        }else{

	            while($row = mysqli_fetch_array($result)){

	                $rows[] = $row;

	            }

	            return $rows;

	        }

	    }



	    public function getList_Loc_Web($table, $name_idCat, $id_Cat, $order_name, $order_state, $trang, $limit, $page, $slug = ''){

	    	global $conn_vn;

	        if ($id_Cat != "" && $name_idCat != "") {

	            $cond = "&".$name_idCat."=".$id_Cat;

	            // $cond = "";

	            $where = " where $name_idCat='".$id_Cat."'";

	        }else{

	            $cond = "";

	        }

	        if ($order_name != "" && $order_state != "") {

	            $order = "order by $order_name $order_state ";

	        }

	        $rows = array();

	        if ($trang == '' && $limit != '') {

	        	$limit1 = 'limit '.$limit;

	        }

	        $where = "WHERE 1=1";
	        if (isset($_GET['keyword'])) {
	        	if (!empty($_GET['keyword'])) {
	        		// $q = str_replace(" ", "-", $_GET['keyword']);
	        		$q = $_GET['keyword'];
	        		// $q = htmlentities($q);
	        		// $q = vi_en1($q);
	        		$cond .= "&keyword=".$q;
	        		$q_arr = explode(" ", $q);
	        		$where .= " AND ((1=1";
	        		foreach ($q_arr as $text) {

	        			$where .= " and product_name like '%$text%'";
	        		}
	        		$where .= ") OR (1=1";
	        		foreach ($q_arr as $text) {
	        			$text = htmlentities($text);
	        			$where .= " and product_content2 like '%$text%'";
	        		}
	        		$where .= ") OR (1=1";
	        		foreach ($q_arr as $text) {
	        			$text = htmlentities($text);
	        			$where .= " and product_content3 like '%$text%'";
	        		}
	        		$where .= ") OR (1=1";
	        		foreach ($q_arr as $text) {
	        			$where .= " and product_code like '%$text%'";
	        		}
	        		$where .= "))";
	        	}
	        }

	        if (isset($_GET['linh_vuc'])) {
	        	if (!empty($_GET['linh_vuc'])) {
	        		$linh_vuc = $_GET['linh_vuc'];
	        		$cond .= "&linh_vuc=".$linh_vuc;
	        		$where .= " AND linh_vuc_arr like '%$linh_vuc%'";
	        	}
	        }

	        if (isset($_GET['dang_web'])) {
	        	if (!empty($_GET['dang_web'])) {
	        		$dang_web = $_GET['dang_web'];
	        		$cond .= "&dang_web=".$dang_web;
	        		$where .= " AND productcat_ar like '%$dang_web%'";
	        	}
	        }

	        if (isset($_GET['tags'])) {
	        	if (!empty($_GET['tags'])) {
	        		$tags = $_GET['tags'];
	        		$cond .= "&tags=".$tags;
	        		$where .= " AND tags like '%\"$tags\"%'";
	        	}
	        }

	        if (isset($_GET['hoan_thien'])) {
	        	if (!empty($_GET['hoan_thien'])) {
	        		$hoan_thien = $_GET['hoan_thien'];
	        		$cond .= "&hoan_thien=".$hoan_thien;
	        		$where .= " AND hoan_thien_web_id = $hoan_thien";
	        	}
	        }

	        $sql = "SELECT * From $table $where $order $limit1";

	        // echo $sql;

	        $result = mysqli_query($conn_vn,$sql);

	        $total_record = mysqli_num_rows($result);

	        if ($trang != "" && $limit != "") {

	            $config = array(

	                'current_page'=> $trang != "" ? $trang : 1,

	                'total_record'=> $total_record,

	                'limit' => $limit,

	                'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',

	                'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page.$cond,

	                // 'link_full'=> $slug != '' ? $slug.'/'.$page.$cond.'/{trang}',

	                // 'link_first'=> $slug != '' ? $slug : '/'.$page,

	                // 'link_full'=> $slug != '' ? $slug.'/{trang}' : '/'.$page.'/{trang}',

	                // 'link_first'=> $slug != '' ? $slug : '/'.$page,

	                'range'=> 3

	            );

	            $paging = new Pagination();

	            $paging->init($config);

	            $start = $paging->_config['start'];

	            $limit = $paging->_config['limit'];

	            $sql = "SELECT * from $table $where $order limit $start, $limit";

	            $result = mysqli_query($conn_vn,$sql);

	            while($row = mysqli_fetch_array($result)){

	                $rows[] = $row;

	            }

	            $p = $paging->htmlPaging();

	            $rows1 = array("data"=>$rows, "paging"=>$p);

	            return $rows1;

	        }else{

	            while($row = mysqli_fetch_array($result)){

	                $rows[] = $row;

	            }

	            return $rows;

	        }

	    }



	/*------------ Hàm select chi tiết ---------------*/



		public function getDetail_New($table, $name, $value, $type){

			global $conn_vn;

	    	$string = array();

	    	$where = array();

	    	foreach ($name as $key => $val) {

	    	    foreach ($value as $i => $ii) {
	    	        if ($i == $key) {
			            $where[] = $val." = '$ii'";
                    }
                }

            }



			$where = implode(' and ', $where);

			$sql = "SELECT * from $table where $where limit 1";






			// print_r($value);

			// echo $where;

			// Lỗi mysqli::get_result;
			/*$stmt = $conn_vn->prepare($sql);

			call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $value));

//            $stmt->bind_param(array_merge(array($type), $value));

           $stmt->execute();



//            $results = $stmt->get_result();

			$row = $stmt->fetch();

           return $row;*/

            // value đâu????

		    $result = mysqli_query($conn_vn, $sql);

		    return mysqli_fetch_assoc($result);

	    }



	    public function getDetail($table, $name_id, $id){

	    	global $conn_vn;

	        $sql = "SELECT * from $table where $name_id = '".$id."' limit 1";

	        $result = mysqli_query($conn_vn,$sql);

	        if (mysqli_num_rows($result) > 0) {

	            $row = mysqli_fetch_assoc($result);

				return $row;

	        }

	    }



	/*-------------- Hàm tìm kiếm admin ---------------*/



		public function getSearchAdmin($table, $name_search, $value_search, $trang, $limit, $page){

			global $conn_vn;

	    	$where = array();

	    	$safe_search = $conn_vn->real_escape_string($value_search);

	    	$text_search = "'%".$safe_search."%'";

	    	$cond = '&search='.$value_search;

	    	foreach ($name_search as $key => $value) {

	    		$where[] =  $value.' like '.$text_search;

	    	}

	    	$where = implode(' OR ', $where);

	    	$sql = "SELECT * from $table where $where";

	    	$result = mysqli_query($conn_vn,$sql);

	        $total_record = mysqli_num_rows($result);

	        if ($trang != "" && $limit != "") {

	            $config = array(

	                'current_page'=> $trang != "" ? $trang : 1,

	                'total_record'=> $total_record,

	                'limit' => $limit,

	                'link_full'=> 'index.php?page='.$page.$cond.'&trang={trang}',

	                'link_first'=> 'index.php?page='.$page.$cond,

	                'range'=> 3

	            );

	            $paging = new Pagination();

	            $paging->init($config);

	            $start = $paging->_config['start'];

	            $limit = $paging->_config['limit'];

	            $sql = "SELECT * from $table where $where limit $start, $limit";

	            $result = mysqli_query($conn_vn,$sql);

	            while($row = mysqli_fetch_array($result)){

	                $rows[] = $row;

	            }

	            $p = $paging->htmlPaging();

	            $rows1 = array("data"=>$rows, 'total_record'=>$total_record, "paging"=>$p);

	            return $rows1;

	        }else{

	            while($row = mysqli_fetch_array($result)){

	                $rows[] = $row;

	            }

	            return $rows;

	        }

	    }



	/*------------ Lấy thông tin đăng nhập -----------------*/



		public function getLoginInfor(){

	    	$detail = '';

	        if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] != '') {

	            $admin_id = $_SESSION['admin_id'];

	        }else if(isset($_COOKIE['admin_id']) && $_COOKIE['admin_id'] != ''){

	            $admin_id = $_COOKIE['admin_id'];

	        }

	        //$GLOBALS['id_account_gb'] = $admin_id;



	        $detail = $this->getDetail('admin', 'admin_id', $admin_id); 

	        return $detail;        

	    }



	/*--------------- Danh mục đệ quy ---------------*/



		function showCategoriesTable($list, $name_parent, $value_parent = 0, $page, $name_id, $name_text, $state, $level = 0){

			$cate_child = array();

		    foreach ($list as $key => $item)

		    {

		        // Nếu là chuyên mục con thì hiển thị

		        if ($item[$name_parent] == $value_parent)

		        {

		        	$cate_child[] = $item;

		            // Xóa chuyên mục đã lặp

		            unset($list[$key]);

		        }

		    }

		    if ($cate_child) {

	        	foreach ($cate_child as $key => $item) {

	        		echo '<tr>';

		                echo '<td>';

		                    echo '<a href="index.php?page='.$page.'&id='.$item[$name_id].'" title="" style="padding-left: '.($level*20).'px">'.$item[$name_text].'</a>';

		                echo '</td>';

		                echo '<td>';

		                	$account = $this->getDetail('admin','admin_id',$item['created_id']);

		                	echo '<a href="index.php?page=$page&created='.$account['admin_id'].'" title="" >'.$account['admin_name'].'</a>';

		                echo '</td>';

		                echo '<td>';

		                	echo $item[$state] == 1 ? 'Hoạt động' : 'Không';

		                echo '</td>';

		                $this->showCategoriesTable($list, $name_parent, $item[$name_id], $page, $name_id, $name_text, $state, $level+1);

		            echo '</tr>';

	        	}

	        }

		}



		function getListChild($table, $parent_field, $parent_value, $name_id, $sort_name, $sort_value){

			global $conn_vn;

			$list = $this->getList($table, $parent_field, $parent_value, $sor_name, $sort_value, '', '', '');



			foreach ($list as $key => $value) {

				$this->list_id[] = $value[$name_id];

				unset($list[$key]);

				$this->getListChild($table, $parent_field, $value[$name_id], $name_id, $sort_name, $sort_value);

			}

			return $this->list_id;

			$this->list_id = '';

		}



		public function refreshList(){
			$this->list_id = '';

		}



		/*-----------------------------------------------------------*/
		function showProductCategoriesSelect($categories, $name_parent, $value_parent = 0, $selected, $name_id, $name_text, $level, $productcat_ar){

		    foreach ($categories as $key => $item){
		        // Nếu là chuyên mục con thì hiển thị
		        if ($item[$name_parent] == $value_parent){
		            ?>
		           	<label>
		           		<input type="checkbox" name="productCats[]" <?php $this->isProductCategory_returnString($productcat_ar, $item[$name_id]) ?> value="<?= $item[$name_id]?>" style="margin-left: <?= ($level*30)?>px; padding-top: 2px; padding-bottom: 2px;"/> 
		           	<?= $item[$name_text] ?></label><br>
		           	
		            <?php
		            // Xóa chuyên mục đã lặp
		           	unset($categories[$key]);                                                                                                                     // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
		            $this->showProductCategoriesSelect($categories, $name_parent, $item[$name_id], $selected, $name_id, $name_text, $level+1,$productcat_ar);
		        }
		    }
		}
		/*-----------------------------------------------------------*/
		function showProductLinhVucSelect($categories, $name_parent, $value_parent = 0, $selected, $name_id, $name_text, $level, $productcat_ar){

		    foreach ($categories as $key => $item){
		        // Nếu là chuyên mục con thì hiển thị
		        if ($item[$name_parent] == $value_parent){
		            ?>
		           	<label>
		           		<input type="checkbox" name="linhvucCats[]" <?php $this->isProductCategory_returnString($productcat_ar, $item[$name_id]) ?> value="<?= $item[$name_id]?>" style="margin-left: <?= ($level*30)?>px; padding-top: 2px; padding-bottom: 2px;"/> 
		           	<?= $item[$name_text] ?></label><br>
		           	
		            <?php
		            // Xóa chuyên mục đã lặp
		           	unset($categories[$key]);                                                                                                                     // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
		            $this->showProductLinhVucSelect($categories, $name_parent, $item[$name_id], $selected, $name_id, $name_text, $level+1,$productcat_ar);
		        }
		    }
		}
		/*----------------------------------------------------*/
		/*-----------------------------------------------------------*/
		function showProductTagsSelect($categories, $name_parent, $value_parent = 0, $selected, $name_id, $name_text, $level, $productcat_ar){

		    foreach ($categories as $key => $item){
		        // Nếu là chuyên mục con thì hiển thị
		        if ($item[$name_parent] == $value_parent){
		            ?>
		           	<label>
		           		<input type="checkbox" name="tags[]" <?php $this->isTags_returnString($productcat_ar, $item['id']) ?> value="<?= $item['id']?>" style="margin-left: <?= ($level*30)?>px; padding-top: 2px; padding-bottom: 2px;"/> 
		           	<?= $item['name'] ?></label><br>
		           	
		            <?php
		            // Xóa chuyên mục đã lặp
		           	unset($categories[$key]);                                                                                                                     // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
		            // $this->showProductTagsSelect($categories, $name_parent, $item[$name_id], $selected, $name_id, $name_text, $level+1,$productcat_ar);
		        }
		    }
		}
		/*----------------------------------------------------*/
		/*----------------------------------------------------*/
		function isProductCategory_returnString($productcat_ar, $value_productId){

			// $array = json_decode($productcat_ar, true);
			// 	foreach ($array as $key => $val) {
			//     $productcat = json_decode($val, true);
			//     if ($productcat != '')
			//     	if($productcat['product_cat'] == $value_productId) echo "checked";
			// }
			$product_cat = explode(',', $productcat_ar);
       		foreach ($product_cat as $key => $val) {
                if($val == $value_productId) echo "checked ";
            }
		}

		function isTags_returnString($productcat_ar, $value_productId){

			// $array = json_decode($productcat_ar, true);
			// 	foreach ($array as $key => $val) {
			//     $productcat = json_decode($val, true);
			//     if ($productcat != '')
			//     	if($productcat['product_cat'] == $value_productId) echo "checked";
			// }
			// $product_cat = explode(',', $productcat_ar);
			$product_cat = json_decode($productcat_ar, true);
       		foreach ($product_cat as $key => $val) {
                if($val == $value_productId) echo "checked ";
            }
		}

		/*----------------------------------------------------*/
		function isProductCategory_returnId($productcat_ar, $value_productId){

			$array = json_decode($productcat_ar, true);
       		foreach ($array as $key => $val) {
                $productcat = json_decode($val, true);

                if ($productcat != '')
                	if($productcat['product_cat'] == $value_productId) echo "checked";
            }
		}

		/*-------------------------------------------------------*/
		function showCategoriesSelect($categories, $name_parent, $value_parent = 0, $selected, $name_id, $name_text, $level){



		    foreach ($categories as $key => $item){



		        // Nếu là chuyên mục con thì hiển thị

		        if ($item[$name_parent] == $value_parent){

		            ?>

		           	<option value="<?= $item[$name_id]?>" <?php if($selected == $item[$name_id]){echo "selected";}?> style="padding-left: <?= ($level*20)?>px; padding-top: 2px; padding-bottom: 2px;">

		                <?= $item[$name_text] ?>

		            </option>

		            <?php

		            // Xóa chuyên mục đã lặp

		            unset($categories[$key]);                                                                                                                                                                                        

		            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp

		            $this->showCategoriesSelect($categories, $name_parent, $item[$name_id], $selected, $name_id, $name_text, $level+1);

		        }

		    }

		}



		function showCategoriesSelect2($categories, $name_parent, $value_parent = 0, $selected, $name_id, $name_text, $level){



		    foreach ($categories as $key => $item){



		        // Nếu là chuyên mục con thì hiển thị

		        if ($item[$name_parent] == $value_parent){

		            ?>

		           	<option value="<?= $item[$name_id]?>" <?php if($selected == $item[$name_id]){echo "selected";}?> style="padding-top: 2px; padding-bottom: 2px;">

		                <?= $level.$item[$name_text] ?>

		            </option>

		            <?php

		            // Xóa chuyên mục đã lặp

		            unset($categories[$key]);                                                                                                                                                                                        

		            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp

		            $this->showCategoriesSelect2($categories, $name_parent, $item[$name_id], $selected, $name_id, $name_text, $level.'---');

		        }

		    }

		}



		function update_service_lang ($title, $des, $content, $url, $lang, $id) {
			global $conn_vn;
			$sql = "UPDATE service_languages SET lang_service_name = '$title', lang_service_des = '$des', lang_service_content = '$content', friendly_url = '$url' Where languages_code = '$lang' And service_id = $id";
			$result = mysqli_query($conn_vn, $sql);
		}


		function getTypePage_byUrl($urlFriendly,$lang){


			
		    global $conn_vn;  

		    // /*--- Kiểm tra Url có phải là trang chi tiết giỏ hàng không? ---*/		   		 
		    // if ($urlFriendly == 'order-detail') {$_GET['slug'] = $urlFriendly; return $urlFriendly;}	

		    // /*--- Kiểm tra Url có phải là trang thanh toán không? ---*/		   		 
		    // if ($urlFriendly == 'order-payment') {$_GET['slug'] = $urlFriendly; return $urlFriendly;}	

		    /*--- Kiểm tra Url có thuộc danh mục sản phẩm không? --*/		    
		    $type = 0;
		    $table = $this->nameTable_productCatLanguage;
		    $nameColTypeLanguage = $this->nameColType_productCatLanguage;
		    $nameColUrlFriendly = $this->nameColUrlProductCat_productCatLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";		    
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql) or die('error:' . mysqli_error($conn_vn));
		    $total_record = mysqli_num_rows($result);
		    $rows = array();
		    while ($row = mysqli_fetch_assoc($result)) {
		    	$rows[] = $row;
		    }
		    // var_dump($rows);die;
		    $type = $type + $total_record;		   
		    if ($type == 1) {$_GET['slug'] = $urlFriendly; return $table;}	


		    /*--- Kiểm tra Url có thuộc danh sách bài viết sản phẩm không? --*/
		    $type = 0;
		    $table = $this->nameTable_productLanguage;
		    $nameColTypeLanguage = $this->nameColType_productLanguage;
		    $nameColUrlFriendly = $this->nameColUrlProduct_productLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    $type = $type + $total_record;		   
		    if ($type == 1) { 
			    $_GET['slug'] = $urlFriendly; 
			    $row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row[$this->nameColTitle_productCatLanguage];
			    return $table;
			}


		    /*--- Kiểm tra Url có thuộc danh mục tin tức không? --*/
		    $type = 0;
		    $table = $this->nameTable_newsCatLanguage;		    
		    $nameColTypeLanguage = $this->nameColType_newsCatLanguage;
		    $nameColUrlFriendly = $this->nameColUrlNewsCat_newsCatLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    // echo $sql;
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    // echo $total_record;
		    $type = $type + $total_record;
		    if ($type == 1) { 
		    	$_GET['slug'] = $urlFriendly;
		    	$row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row['lang_newscat_name'];
		    	return $table;
		    }

		    /*--- Kiểm tra Url có thuộc danh sách bài viết tin tức không? --*/

		    $type = 0;
		    $table = $this->nameTable_newsLanguage;
		    $nameColTypeLanguage = $this->nameColType_newsLanguage;
		    $nameColUrlFriendly = $this->nameColUrlNews_newsLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    if (mysqli_num_rows($result) > 0) $row = mysqli_fetch_assoc($result);
		    // echo $total_record;
		    $type = $type + $total_record;		   
		    if ($type == 1) { 
		    	$_GET['slug'] = $urlFriendly; 
		    	$row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row['lang_news_name'];
		    	return $table;}


		    /*--- Kiểm tra Url có thuộc danh mục dịch vụ không? --*/
		    $type = 0;
		    $table = $this->nameTable_serviceCatLanguage;
		    $nameColTypeLanguage = $this->nameColType_serviceCatLanguage;
		    $nameColUrlFriendly = $this->nameColUrlServiceCat_serviceCatLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    $type = $type + $total_record;		    
		    if ($type == 1) {
		    	$_GET['slug'] = $urlFriendly; 
		    	$row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row['lang_servicecat_name'];
		    	return $table;}

		    /*--- Kiểm tra Url có thuộc danh sách bài viết dịch vụ không? --*/
		    $type = 0;
		    $table = $this->nameTable_serviceLanguage;
		    $nameColTypeLanguage = $this->nameColType_serviceLanguage;
		    $nameColUrlFriendly = $this->nameColUrlService_serviceLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    $type = $type + $total_record;		    
		    if ($type == 1) {
		    	$_GET['slug'] = $urlFriendly; 
		    	$row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row['lang_service_name'];
		    	return $table;}

		    /*--- Kiểm tra Url có thuộc các page không --*/
		    $type = 0;
		    $table = $this->nameTable_pageLanguage;
		    $nameColTypeLanguage = $this->nameColType_pageLanguage;
		    $nameColUrlFriendly = $this->nameColUrl_pageLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    $type = $type + $total_record;		   
		    if ($type == 1) { 
		    	$_GET['slug'] = $urlFriendly;
		    	$row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row['lang_page_name']; 
			    //echo "THUY HANG page";
		    	return 'page_language';}

		    /*--- Kiểm tra Url có thuộc các linh vuc không --*/
		    $type = 0;
		    $table = "linh_vuc";
		    $nameColTypeLanguage = $this->nameColType_pageLanguage;
		    $nameColUrlFriendly = $this->nameColUrl_pageLanguage;
		    $where = "where $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    $type = $type + $total_record;		   
		    if ($type == 1) { 
		    	$_GET['slug'] = $urlFriendly;
		    	$row = mysqli_fetch_assoc($result);
			    // $_GET['breadCrumb'] = $row['lang_page_name']; 
			    //echo "THUY HANG page";
		    	return 'linh_vuc';}

			/*--- Kiểm tra Url thuộc các trang đặc biệt trên menu --*/
		    // $type = 0;
		    // echo "8";
		    // $table = $this->nameTable_menuLanguage;
		    // $nameColTypeLanguage = $this->nameColType_menuLanguage;
		    // $nameColUrlFriendly = $this->nameColUrl_menuLanguage;
		    // $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    // $sql = "SELECT * from $table $where";
		    // echo $sql;
		    // $result = mysqli_query($conn_vn,$sql);
		    // $total_record = mysqli_num_rows($result);
		    // if (mysqli_num_rows($result) > 0) $row = mysqli_fetch_assoc($result);
		    // $type = $type + $total_record;
		    // if ($type == 1) { echo $row[$nameColUrlFriendly]; return $row[$nameColUrlFriendly];}

		    /*--- Kiểm tra Url thuộc các trang đặc biệt trên menu --*/
		    $type = 0;
		    $table = $this->nameTable_menuTypeLanguage;
		    $nameColTypeLanguage = $this->nameColType_menuTypeLanguage;
		    $nameColUrlFriendly = $this->nameColUrl_menuTypeLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";
		    $sql = "SELECT * from $table $where";
		    // echo $sql;
		    $result = mysqli_query($conn_vn,$sql) or die(mysqli_error($conn_vn));
		    $total_record = mysqli_num_rows($result);
		    // echo $total_record;
		    if (mysqli_num_rows($result) > 0) $row = mysqli_fetch_assoc($result);
		    $type = $type + $total_record;
		    // echo $total_record;
		    if ($type == 1) {
		    	$_GET['slug'] = $urlFriendly; 
		    	// $row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row['lang_menu_name'];
			    // echo "THUY HANG menu";
			    // var_dump($row);
		    	return $row[$nameColUrlFriendly];}

		    // /*--- Kiểm tra Url thuộc các trang đặc biệt trên menu --*/	
		    /*--- Kiểm tra Url có thuộc danh mục sản phẩm không? --*/	
		    $type = 0;
		    $table = $this->nameTable_producerLanguage;
		    $nameColTypeLanguage = $this->nameColType_producerLanguage;
		    $nameColUrlFriendly = $this->nameColUrlProducer_producerLanguage;
		    $where = "where $nameColTypeLanguage = '".$lang."' AND $nameColUrlFriendly = '".$urlFriendly."'";		    
		    $sql = "SELECT * from $table $where";
		    $result = mysqli_query($conn_vn,$sql);
		    $total_record = mysqli_num_rows($result);
		    $type = $type + $total_record;		   
		    if ($type == 1) {
		    	$_GET['slug'] = $urlFriendly;
		    	$row = mysqli_fetch_assoc($result);
			    $_GET['breadCrumb'] = $row['lang_productcat_name']; 
		    	return $table;}	

		    /*--- Các trường hợp đặc biệt ---*/
		    $_GET['slug'] = $urlFriendly;
		    //echo "THUY HANG1";
		    return $_GET['slug'];

		}

		

}



