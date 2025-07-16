<meta charset="utf-8">
<?php
function vi_en1($str)
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
        // $str = str_replace(' ', '-', $str);
        $str = preg_replace('/[^a-zA-Z0-9\s]/', '', $str);
        //$str = preg_replace('/(---|--)/', '-', $str);
            $str = strtolower($str);
            $str = str_replace(' ', '-', $str);
            while (strpos($str, '--') !== false) {
                $str = str_replace('--', '-', $str);
            }
        return $str;
    }


if(isset($_POST['submit'])) {
     if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] != "") {
        $allowedExtensions = array("xls","xlsx");
        $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
        if(in_array($ext, $allowedExtensions)) {
           $file_size = $_FILES['uploadFile']['size'] / 1024;
           if($file_size < 50 || true) {
               // $file = "uploads/".$_FILES['uploadFile']['name'];
                // echo dirname(__FILE__);
                $file = dirname(__FILE__)."/uploads/".$_FILES['uploadFile']['name'];
               $isUploaded = copy($_FILES['uploadFile']['tmp_name'], $file);
               if($isUploaded) {
                    // include("db.php");
                    include_once dirname(__FILE__) . "/../../../functions/database.php";
                    // include("Classes/PHPExcel/IOFactory.php");
                    // include("PHPExcel/IOFactory.php");
                    // require('PHPExcel/Autoloader.php');
                    include_once dirname(__FILE__) . "/PHPExcel/IOFactory.php";
                    try {
                        //Load the excel(.xls/.xlsx) file
                        // echo $file;
                        // echo 'tuan';
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                        // echo 'tuan1';
                    } catch (Exception $e) {
                         die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                        // die ('loi.');
                    }
                    
                    //An excel file may contains many sheets, so you have to specify which one you need to read or work with.
                    $sheet = $objPHPExcel->getSheet(0);
                    //It returns the highest number of rows
                    $total_rows = $sheet->getHighestRow();
                    //It returns the highest number of columns
                    $total_columns = $sheet->getHighestColumn();//echo $total_columns;
                          
                    echo '<h4>Data from excel file</h4>';
                    echo '<table cellpadding="5" cellspacing="1" border="1" class="responsive">';
                  
                    // $query = "insert into `user_details` (`id`, `name`, `mobile`, `country`) VALUES ";
                    $query = "insert into `product` (`product_name`, `product_content`, `product_des2`, `product_date`, `state`, kich_co_id) VALUES ";
                    //Loop through each row of the worksheet
                    $amount = 0;
                    for($row =2; $row <= $total_rows; $row++) {
                        //Read a single row of data and store it as a array.
                        //This line of code selects range of the cells like A1:D1
                        $single_row = $sheet->rangeToArray('A' . $row . ':' . $total_columns . $row, NULL, TRUE, FALSE);
                        // echo "<tr>";
                        //Creating a dynamic query based on the rows from the excel file
                        // $query .= "(";
                        //Print each cell of the current row
                        $d = 0;
                        $quantity = 0;
                        $price = 0;
                        $total = 0;
                        foreach($single_row[0] as $key=>$value) {
                            $d++;
                            if ($d==2) {
                                $price = $value;
                            }
                            if ($d==3) {
                                $quantity = $value;
                            }
                            // echo "<td>".$value."</td>";
                            // $query .= "'".mysqli_real_escape_string($conn_vn, $value)."',";
                        }
                        $total = (int)$price * (int)$quantity;
                        $amount += $total;
                        // $query .= "'".$total."',";
                        // $query = substr($query, 0, -1);
                        // $query .= "),";
                        // echo "</tr>";
                    }
                    // $query = substr($query, 0, -1);
                    // echo '</table>';
                  	// echo $query;echo '<br>';
                    if (false) {
                        die;
                    $time = time();
                    $sql = "INSERT INTO cart (total_price, total_cart) VALUES ($amount, $time)";
                    $result = mysqli_query($conn_vn, $sql);
                    $sql = "SELECT * FROM cart WHERE total_cart = $time";
                    $result = mysqli_query($conn_vn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $cart_id = $row['id_cart'];
                }
$cart_id = 0;
                    for($row =2; $row <= $total_rows; $row++) {
                        $query = "insert into `product` (productcat_ar, xay_dung_id, product_code, `product_name`, product_img_1, product_price, `product_price_sale`, `product_shape`, product_stock, `product_sub_info3`, `product_sub_info2`, `product_content`, product_sub_info1, friendly_url, title_seo, product_new, product_hot, clear_stock) VALUES ";
                        //Read a single row of data and store it as a array.
                        //This line of code selects range of the cells like A1:D1
                        $single_row = $sheet->rangeToArray('B' . $row . ':' . $total_columns . $row, NULL, TRUE, FALSE);
                        echo "<tr>";
                        //Creating a dynamic query based on the rows from the excel file
                        $query .= "(";
                        $query1 = "(";
                        //Print each cell of the current row
                        $d = 0;
                        $quantity = 0;
                        $price = 0;
                        $total = 0;
                        $url = '';
                        $title_seo = '';
                        foreach($single_row[0] as $key=>$value) {
                            $d++;
                            if ($d == 2) {
                                if ($value == '') {
                                    $value = 0;
                                }
                            }

                            if ($d == 3) {
                                if ($value == 1) {
                                    $new = 1;
                                    $hot = 0;
                                    $clear = 0;
                                } elseif ($value == 2) {
                                    $new = 0;
                                    $hot = 1;
                                    $clear = 0;
                                } elseif ($value == 3) {
                                    $new = 0;
                                    $hot = 0;
                                    $clear = 1;
                                } else {
                                    $new = 0;
                                    $hot = 0;
                                    $clear = 0;
                                }
                            }

                            if ($d == 5) {
                                $title_seo = $value;
                                $url = vi_en1($value);
                            }
                            // if ($d==2) {
                            //     $price = $value;
                            // }
                            // if ($d==3) {
                            //     $quantity = $value;
                            // }

                            if ($d == 7) {
                                if ($value == '') {
                                    $value = 0;
                                }
                                $value = str_replace(",", "", $value);
                                $value = (int)$value;
                            }
                            if ($d == 8) {
                                if ($value == '') {
                                    $value = 0;
                                }
                                $value = str_replace(",", "", $value);
                                $value = (int)$value;
                            }
                            if ($d == 10) {
                                if ($value == 'Còn hàng') {
                                    $value = 1;
                                } else {
                                    $value = 0;
                                }
                            }

                            if ($d <=14) {
                                if ($d != 3) {
                                    echo "<td>".$value."</td>";
                                    $query .= "'".mysqli_real_escape_string($conn_vn, $value)."',";
                                    if ($d==4 || $d==5 || $d==11 || $d==12 || $d==13 || $d==14) {
                                        $query1 .= "'".mysqli_real_escape_string($conn_vn, $value)."',";
                                    }
                                }
                            }
                            
                            
                        }
                        // $total = (int)$price * (int)$quantity;
                        // $amount += $total;
                        // $date = date('Y-m-d');
                        // $query .= "'".$date."',";
                        // $query .= "'".$total."',";
                        // $query .= "'".$cart_id."',";
                        $query .= "'".$url."',";
                        $query .= "'".$title_seo."',";
                        $query .= "'".$new."',";
                        $query .= "'".$hot."',";
                        $query .= "'".$clear."',";
                        $query1 .= "'".$url."',";
                        $query1 .= "'".$title_seo."',";

                        $query = substr($query, 0, -1);
                        $query .= ")";
                        echo "</tr>";
                        // echo $query.'<br>';
                        mysqli_query($conn_vn, $query);
                        // echo mysqli_error($conn_vn);
                        $product_id = mysqli_insert_id($conn_vn);
                        $sql_vn = "INSERT INTO product_languages (lang_product_code, lang_product_name, lang_product_sub_info3, lang_product_sub_info2, lang_product_content, lang_product_sub_info1, friendly_url, title_seo, languages_code, product_id) VALUES ".$query1."'vn', $product_id)";//echo $sql_vn.'<br>';
                         mysqli_query($conn_vn, $sql_vn);
                        $sql_en = "INSERT INTO product_languages (lang_product_code, lang_product_name, lang_product_sub_info3, lang_product_sub_info2, lang_product_content, lang_product_sub_info1, friendly_url, title_seo, languages_code, product_id) VALUES ".$query1."'en', $product_id)";//echo $sql_en.'<br>';
                         mysqli_query($conn_vn, $sql_en);
                         // break;
                    }
                    // $query = substr($query, 0, -1);
                    echo '</table>';
                    // echo $query;echo '<br>';
                    // At last we will execute the dynamically created query an save it into the database
                    // mysqli_query($conn_vn, $query) or die('loi: ' . mysqli_error($conn_vn));
                    if(mysqli_affected_rows($conn_vn) > 0) {    
                        echo '<span class="msg">Database table updated!</span>';
                    } else {
                        echo '<span class="msg">Can\'t update database table! try again.</span>';
                    } 
                    // Finally we will remove the file from the uploads folder (optional) 
                    unlink($file);
                } else {
                    echo '<span class="msg">File not uploaded!</span>';
                }
            } else {
                echo '<span class="msg">Maximum file size should not cross 50 KB on size!</span>';	
            }
        } else {
            echo '<span class="msg">This type of file not allowed!</span>';
        }
    } else {
        echo '<span class="msg">Select an excel file first!</span>';
    }
}
?>
<!-- <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data"> -->
<form action="" method="post" enctype="multipart/form-data">
    Upload excel file : 
    <input type="file" name="uploadFile" value="" />
    <input type="submit" name="submit" value="Upload" />
</form>