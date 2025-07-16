<?php
/**
* 
*/
include_once dirname(__FILE__).DIR_FUNCTIONS."library.php";
include_once dirname(__FILE__).DIR_FUNCTIONS_PAGING."Pagination.php";
class action extends library{
    // function showabc(){
    //     global $conn_vn;
    //     $sql = "SELECT * from newscat_languages where languages_code = 'vn' AND friendly_url = 'tin-tuc'";
    //     echo $sql;
    //     $result = mysqli_query($conn_vn,$sql);
    //     $total_record = mysqli_num_rows($result);
    //     echo $total_record;
    // }
	function showCategoriesULLI($categories, $parent_id = 0, $char = ''){
        global $conn_vn;
		$categories = $this->getList("productcat","","","id_productCat","desc","","","");
		$cate_child = array();
	    foreach ($categories as $key => $item)
	    {
	        // Nếu là chuyên mục con thì hiển thị
	        if ($item['id_parent'] == $parent_id)
	        {
	        	$cate_child[] = $item;
	            // Xóa chuyên mục đã lặp
	            unset($categories[$key]);
	        }
	    }
	    if ($cate_child) {
        	echo '<ul class="pull-left">';
        	foreach ($cate_child as $key => $item) {
        		echo '<li class="pull-left">';
	                echo '<a href="index.php?page=productCat&id_productCat='.$item['id_productCat'].'" title="">'.$char.$item['name_productCat'].'</a>';
	                $this->showCategoriesULLI($categories, $item['id_productCat'], $char);
	            echo '</li>';
        	}
        	echo '</ul>';
        }
	}

	function getListChildCat($id_parent){
        global $conn_vn;
		$list = $this->getList("productcat","id_parent", $id_parent,"id_productCat","desc","","","");
		foreach ($list as $key => $value) {
			$this->list_id .= $value['id_productCat'].',';
			unset($list[$key]);
			$this->getListChildCat($value['id_productCat']);
		}
		return $this->list_id;
	}

	public function getListProduct($table, $name_idCat, $id_Cat, $price1, $price2, $order_name, $order_state, $trang, $limit, $page, $slug = ''){
        global $conn_vn;
		$list_id = $this->getListChild('productcat', 'productcat_parent', $id_Cat, 'productcat_id', 'productcat_id', 'desc');
        $list_id[] = $id_Cat;
        $this->refreshList();
	    $list_id[] = $id_Cat;

        $list_id = implode(',', $list_id);

        if ($id_Cat != "" && $name_idCat != "") {
            $cond = "&".$name_idCat."=".$id_Cat;
            $where = " where productcat_id in ($list_id)";
        }else{
            $cond = "";
        }
        if ($order_name != "" && $order_state != "") {
            $order = "order by $order_name $order_state ";
        }
        if ($limit != "" && $trang == '') {
        	$limit1 = "limit ".$limit;
        }

        if ($price1 != '' && $price2 != '') {
            $between = 'and between '.$price1.' and '.$price2;
        }
        $rows = array();
        $sql = "SELECT * From $table $where $between $order $limit1";
        $result = mysqli_query($conn_vn,$sql);
        $total_record = mysqli_num_rows($result);
        if ($trang != "" && $limit != "") {
            $config = array(
                'current_page'=> $trang != "" ? $trang : 1,
                'total_record'=> $total_record,
                'limit' => $limit,
                'link_full'=> $slug != '' ? $slug.'/{trang}' : 'index.php?page='.$page.$cond.'&trang={trang}',
                'link_first'=> $slug != '' ? $slug : 'index.php?page='.$page.$cond,
                'range'=> 3
            );
            $paging = new Pagination();
            $paging->init($config);
            $start = $paging->_config['start'];
            $limit = $paging->_config['limit'];
            $sql = "SELECT * from $table $where $between $order limit $start, $limit";

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

	public function getListProductSearch($search, $trang, $limit){
        global $conn_vn;
		$rows = array();
		$textsearch = "'%{$search}%'";
		$sql = "SELECT * FROM product where name_product like $textsearch";
        $result = mysqli_query($conn_vn,$sql);
        $total_record = mysqli_num_rows($result);
		
		$config = array(
            'current_page'  => $trang != "" ? $trang : 1, // Trang hiện tại
            'total_record'  => $total_record, // Tổng số record
            'limit'         => $limit,// limit
            'link_full'     => 'index.php?search='.$search.'&trang={trang}',// Link full có dạng như sau: domain/com/page/{page}
            'link_first'    => 'index.php?search='.$search,// Link trang đầu tiên
            'range'         => 3 // Số button trang bạn muốn hiển thị 
        );
        $paging = new Pagination();
		$paging->init($config);
		$start = $paging->_config['start'];
		$limit = $paging->_config['limit'];
		$sql = "SELECT * FROM product where name_product like $textsearch order by id_product DESC LIMIT $start, $limit"; 
        $result = mysqli_query($conn_vn,$sql);
		while($row = mysqli_fetch_array($result)){
			$rows[] = $row;
		}
		$p = $paging->htmlPaging();
		$rows1 = array("data"=>$rows,"paging"=>$p, "total_record"=>$total_record);
		return $rows1;

		//return $rows;
	}

    public function getListProductSearch1 ($search, $position) {
        global $conn_vn;
        $sql_total_record = "SELECT * FROM product WHERE product_name like '%$search%' or product_code like '%$search%'";
        $result_total_record = mysqli_query($conn_vn, $sql_total_record);
        $total_record = mysqli_num_rows($result_total_record);
        
        $sql = "SELECT * From product Where product_name like '%$search%' or product_code like '%$search%' limit $position,12";
        $result = mysqli_query($conn_vn,$sql);
        
        $rows = array();
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $rows[] = $row;
        }

        $rows1 = array("data"=>$rows,"paging"=>"", "total_record"=>$total_record);
        return $rows1;
    }

    public function showCategoriesList($list, $name_parent, $value_parent = 0, $page, $name_id, $name_text, $state, $lang, $level = 0){
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
            echo '<ul class="list-unstyled menu-'.($level+1).'">';
            foreach ($cate_child as $key => $item) {
                $url = '';
                $row_lang2 = $this->getDetail_New('menu_languages', array('menu_id', 'languages_code'), array(&$item[$name_id], &$lang), 'is');
                $name = $row_lang2['lang_menu_name'];
                switch ($item['menu_type_id']) {
                    case '1':
                        $url = '/';
                        break;
                    case '2':
                        $url = '/san-pham';
                        break;
                    case '3':
                        $procat = $this->getDetail_New('productcat', array('productcat_id'), array(&$item['productcat_id']), 'i');
                        $url = '/'.$procat['friendly_url'];
                        break;
                    case '4':
                        $pro = $this->getDetail_New('product', array('product_id'), array(&$item['product_id']), 'i');
                        $procat = $this->getDetail_New('productcat',array('productcat_id'), array(&$pro['productcat_id']),'i');
                        $url = '/'.$procat['friendly_url'].''.$pro['friendly_url'];
                        break;
                    case '5':
                        $url = '/tin-tuc';
                        break;
                    case '6':
                        $slugCat = $this->getDetail_New('productcat',array('productcat_id'),array(&$item['productcat_id']),'i')['friendly_url'];
                        $news = $this->getDetail_New('news', array('news_id'), array(&$item['news_id']), 'i');
                        $url = '/tin-tuc/'.$news['friendly_url'];
                        break;
                    case '7':
                        $page = $this->getDetail_New('page', array('page_id'), array(&$item['page_id']), 'i');
                        $url = '/'.'bai-viet'.'/'.$page['friendly_url'];
                        break;
                    case '8':
                        $url = '/'.$item['menu_url'];
                        break;

                    case '9':
                        $url = '/lien-he';
                        break;
                    default:
                        
                        break;
                }
                echo '<li>';
                    echo '<a href="'.$url.'" title="" >'.$name.'</a>';
                    $this->showCategoriesList($list, $name_parent, $item[$name_id], $page, $name_id, $name_text, $state, $lang, $level+1);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    public function getMinPrice($productcat_id){
        global $conn_vn;
        $list_id = $this->getListChild('productcat', 'productcat_parent', $productcat_id, 'productcat_id', 'productcat_id', 'desc');
        $this->refreshList();
        $list_id[] = $productcat_id;

        $list_id = implode(',', $list_id);

        if ($productcat_id != '') {
            $where = "where productcat_id in ($list_id)";
        }
        $sql = "SELECT MIN(product_price) as price from product $where";
        $result = mysqli_query($conn_vn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }

    public function getMaxPrice($productcat_id){
        global $conn_vn;
        $list_id = $this->getListChild('productcat', 'productcat_parent', $productcat_id, 'productcat_id', 'productcat_id', 'desc');
        $this->refreshList();
        $list_id[] = $productcat_id;

        $list_id = implode(',', $list_id);

        if ($productcat_id != '') {
            $where = "where productcat_id in ($list_id)";
        }
        $sql = "SELECT MAX(product_price) as price from product $where";
        $result = mysqli_query($conn_vn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }

    public function getParent1($productcat_id){
        global $conn_vn;

        $row = $this->getDetail('productcat','productcat_id',$productcat_id);
        if ($row['productcat_parent'] == 0) {
            return $row;
            // break;
        }else{
            global $conn_vn;
            $row = $this->getDetail('productcat','productcat_id',$row['productcat_parent']);
            if ($row['productcat_parent'] == 0) {
                return $row;
                // break;
            }else{
                global $conn_vn;
                $row = $this->getDetail('productcat','productcat_id',$row['productcat_parent']);
                if ($row['productcat_parent'] == 0) {
                    return $row;
                    // break;
                }else{
                    global $conn_vn;
                    $row = $this->getDetail('productcat','productcat_id',$row['productcat_parent']);
                    if ($row['productcat_parent'] == 0) {
                        return $row;
                        // break;
                    }
                }
            }
        }
    }

    public function getParent2($productcat_id){
        global $conn_vn;
        $row = $this->getDetail('productcat','productcat_id',$productcat_id);
        if ($row['productcat_parent'] == 0) {
            $ab = $row['productcat_id'];
        }else{
            $this->getParent($row['productcat_parent']);
        }
    }

    public function getParent($productcat_id){
        $list = $this->getList('productcat','productcat_parent','0','productcat_id','desc','','','');

        foreach ($list as $key => $value) {
            $list_child = $this->getListChild('productcat', 'productcat_parent', $value['productcat_id'], 'productcat_id', 'productcat_id', 'desc');
            $this->refreshList();
            if (in_array($productcat_id, $list_child) || $productcat_id == $value['productcat_id']) {
            	return $value;
            	break;
            }

        }
    }

    public function showCategoriesListFilter($list, $name_parent, $value_parent = 0, $level = 0){
        $cate_child = array();
        // echo $value_parent;
        foreach ($list as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item[$name_parent] == $value_parent) {

                $cate_child[] = $item;
                // Xóa chuyên mục đã lặp
                unset($list[$key]);
            }
        }

        if ($cate_child) {
            // print_r($cate_child);
            echo '<ul class="list-unstyled pull-left col-lg-12" '.($level>0 ? 'style="padding-left:20px;"' : '').'>';
            foreach ($cate_child as $key => $item) {
                // print_r($item);
            	// echo $item['productcat_id'].', ' ;
            	$list_child1 = $this->getListChild('productcat','productcat_parent',$item['productcat_id'],'productcat_id','productcat_id','asc');
                $this->refreshList();
            	// // print_r($list_child1);
                $list_child1[] = $item['productcat_id'];
            	$list_child1 = implode(',', $list_child1);
            	$count = $this->countProOnCat($list_child1);
                // echo $count['count'] .' )'.', ';
                echo '<li style="width:100%">';
                    echo '<a href="/'.$item['friendly_url'].'" title="" >'.$item['productcat_name'].'( '.$count['count'].' )</a>';
                    $this->showCategoriesListFilter($list, $name_parent, $item['productcat_id'], $level+1);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    public function countProOnCat($productcat_id){
    	global $conn_vn;
    	$sql = "SELECT COUNT(product_id) as count from product where productcat_id in ($productcat_id)";
        // echo $sql;
    	$result = mysqli_query($conn_vn, $sql);
    	if (mysqli_num_rows($result) > 0) {
    		return mysqli_fetch_assoc($result);
    	}
    }

    public function checkUsername(){

        global $conn_vn;
        $user = isset($_POST['username']) ? $_POST['username'] : '';
        if ($user != '') {
            $sql = "SELECT * from user where user_name = ?";
            $stmt = $conn_vn->prepare($sql);
            $stmt->bind_param('s', $user);
            $stmt->execute();
            $stmt->store_result();
            $total_record = $stmt->num_rows;
            if ($total_record > 0) {
                echo json_encode(array('error'=>'đã tồn tại'));
            }else{
                echo json_encode(array('success'=>'ok'));
            }
        }else{
            echo json_encode(array('error'=>'đã tồn tại'));
        }
    }

    public function regForm(){
        global $conn_vn;

        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirmpassword = isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $date = $this->get_Date('Y-m-d H:m:s');
        $insert = $this->Insert_1('user', 
                                   array('user_name',
                                         'user_email',
                                         'user_phone',
                                         'user_address',
                                         'user_password',
                                         'created_date'),
                                   array(&$username,
                                         &$email,
                                         &$phone,
                                         &$address,
                                         &$password_hash,
                                         &$date),
                                   'ssssss');
        if ($insert != '') {
            echo json_encode(array('success'=>'Tạo tài khoản thành công','url'=>'/dang-nhap'));
        }else{
            echo json_encode(array('error'=>'Lỗi, mời thử lại'));
        }
    }   

    public function loginForm(){
        global $conn_vn;

        $user = isset($_POST['username']) ? $_POST['username'] : '';
        $pass = isset($_POST['password']) ? $_POST['password'] : '';

        $remember = isset($_POST['remember']) ? $_POST['remember'] : "";
        $sql = "SELECT user_id, user_password, state From user where user_name = ? limit 1";
        $stmt = $conn_vn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($user_id, $user_password, $state);
        $stmt->store_result();
        if ($stmt->num_rows() == 1) {
            if ($stmt->fetch()) {
                if (password_verify($pass, $user_password)) {
                    if ($state == '2') {
                        echo json_encode(array('error'=>'Tài khoản bị khóa'));
                    }else{
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_name'] = $user_name;


                        if ($remember == "1" || $remember =="on") {
                            setcookie('user_id', $user_id, time() + (3600 * 24 * 30));
                            setcookie('user_name', $user_name, time() + (3600 * 24 * 30));
                     
                        }
                        header('location: /');
                    }
                }else{
                    header('location: /dang-nhap');
                }
            }
        }else{
            header('location: /dang-nhap');
        }
    }

    //////////////// url /////////////////
    public function curPageURL () {
         $pageURL = 'http';
         if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") {
          $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
         } else {
          $pageURL .= $_SERVER["SERVER_NAME"];
         }
         return $pageURL;
    }

    public function curPageURL1 () {
         $pageURL = 'http';
         if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") {
          $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         } else {
          $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
         }
         return $pageURL;
    }

    public function seo_info ($url) {
        global $conn_vn;
        global $title;
        global $meta_des;
        global $meta_key;
        $sql = "SELECT * FROM seo_info WHERE url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $meta_des = $row['des'];
            $meta_key = $row['keyword'];
        }
    }

}

?>
