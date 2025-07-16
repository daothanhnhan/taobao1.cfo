<?php

    $db_host = 'localhost';
	$db_user_vn = 'taobao1_db';
	$db_pass = 'nUEQb4KR4';
	$db_name_vn = 'taobao1_db';
	
	 $conn_vn = NULL;
	 $result_vn = NULL;
	
	
	/*------------------------*/
	// private function connectdb(){		
	
		$sql = "SET NAMES 'utf8'";		
		$conn_vn =  mysqli_connect($db_host, $db_user_vn, $db_pass);
		if ($conn_vn){
			$select_db = mysqli_select_db($conn_vn,$db_name_vn);
			if(!$select_db){
				echo 'Not found database';
			}
		}
		else{
			echo 'Can not connect to database!';
		}
		mysqli_query($conn_vn,$sql);
		// echo 'tuan';die;						
	// }

	
	
	// public function disconnect(){
	// 	global $conn_vn;
	// 	if($conn_vn){
	// 		mysqli_close($conn_vn);
	// 	}
	// } 
	
	// public function query($sql){
	// 	global $conn_vn;
	// 	global $result_vn;
	// 	free_query();
	// 	$result_vn = mysqli_query($conn_vn,$sql);
	// }
	
	// public function free_query(){
	// 	global $conn_vn;
	// 	global $result_vn;
	// 	if($result_vn){
	// 		mysqli_free_result($result_vn);		
	// 	}
		
	// }
	
	// public function num_row(){
	// 	global $conn_vn;
	// 	global $result_vn;
	// 	if($result_vn){
	// 		$rows = mysqli_num_rows($result_vn);
	// 		return $rows;
	// 	}
		
	// }
	
	// public function fetch(){
	// 	global $conn_vn;
	// 	global $result_vn;
	// 	if($result_vn){
	// 		$row = mysqli_fetch_array($result_vn);
	// 		return $row;
	// 	}
				
	// }
	
	// public function fetch_one(){
	// 	global $conn_vn;
	// 	global $result_vn;
	// 	if($result_vn){
	// 		$row = mysqli_fetch_assoc($result_vn);
	// 		return $row;
	// 	}
		
	// }
