<?php 
	include dirname(__FILE__) . "/../database.php";
	include dirname(__FILE__) . "/../library.php";
	include dirname(__FILE__) . "/../action.php";

	$action = new action();

	$tour = $_POST['tour'];
	$tour_id = $_POST['tour_id'];
	$tour_price = $_POST['tour_price'];
	$quantity = $_POST['quantity'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$note = $_POST['note'];

	$insert = $action->Insert_1('book_tour', 

	    							   array('tour', 

	    							   		 'tour_id', 

	    							   		 'tour_price', 

	    							   		 'quantity', 

	    							   		 'fullname', 

	    							   		 'email', 

	    							   		 'phone', 

	    							   		 'address', 

	    							   		 'note'), 

	    							   array(&$tour, 

	    							   		 &$tour_id, 

	    							   		 &$tour_price, 

	    							   		 &$quantity, 

	    							   		 &$fullname, 

	    							   		 &$email, 

	    							   		 &$phone, 

	    							   		 &$address, 

	    							   		 &$note

	    							   		 ),

	    							   'siiisssss');

	if($insert != ''){
		echo 'Bạn đã đặt tour thành công.';
	} else {
		
		echo 'Lỗi, mời bạn thử lại.';
	}

?>
<?php 
	$home_chay = $action->getList_New('product', array('clear_stock', 'state'), array(&$clear_stock, &$state), array('product_id'), array(&$desc), 'ii', '', '20', '');
?>