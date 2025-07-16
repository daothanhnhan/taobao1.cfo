<meta charset="utf-8">
<?php
function set ($name) {

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://caosim-5596.restdb.io/rest/simdienthoai",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n\"name\": \"$name\",\n\"type\": 111\n}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: b8eadcfb-f743-c095-c85b-93a83152fc98",
    "x-apikey: dd155a4117e3989a8d20fd2462b66268f31cb"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
}

}

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

    function check_product_has ($product_name, $tong_sim) {
        global $conn_vn;

        $sql = "SELECT * FROM product WHERE product_name = '$product_name'";
        $result = mysqli_query($conn_vn, $sql);
        $num = mysqli_num_rows($result);

        if ($num != 0) {
            $sql = "UPDATE product SET tong_sim = '$tong_sim' WHERE product_name = '$product_name'";
            $result = mysqli_query($conn_vn, $sql);
        }

        return $num;
    }

    function hoa_hong ($price) {
        $percent = 0;
        if ($price < 1000000) {
            $percent = 30;
        }
        if ($price >= 1000000 && $price < 5000000) {
            $percent = 25;
        }
        if ($price >= 5000000 && $price < 10000000) {
            $percent = 20;
        }
        if ($price >= 10000000 && $price < 20000000) {
            $percent = 15;
        }
        if ($price >= 20000000) {
            $percent = 10;
        }

        return $percent;
    }

    function hoa_hong_1 ($price, $admin_id) {
        $percent = 0;
        global $conn_vn;
        $sql = "SELECT * FROM hoa_hong WHERE price_1 <= $price AND price_2 >= $price AND admin_id = $admin_id";
        $result = mysqli_query($conn_vn, $sql);
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $percent = $row['percent'];
        } else {
            $percent = 0;
        }

        return $percent;
    }

    function set_productcat ($price, $phone) {
        $arr = array();
        if ($price < 500000) {
            $arr[] = 185;
        }
        if ($price >= 500000 && $price < 1000000) {
            $arr[] = 184;
        }
        if ($price >= 1000000 && $price < 3000000) {
            $arr[] = 183;
        }
        if ($price >= 3000000 && $price < 5000000) {
            $arr[] = 182;
        }
        if ($price >= 5000000 && $price < 10000000) {
            $arr[] = 181;
        }
        if ($price >= 10000000 && $price < 50000000) {
            $arr[] = 180;
        }
        if ($price >= 50000000 && $price < 100000000) {
            $arr[] = 179;
        }
        if ($price >= 100000000 && $price < 200000000) {
            $arr[] = 178;
        }
        if ($price >= 200000000 && $price < 500000000) {
            $arr[] = 177;
        }
        if ($price >= 500000000) {
            $arr[] = 176;
        }
        //////////////////////
        // luc quy 
        $luc_quy = substr($phone, -6, 6);
        $luc_quy_state = 0;
        if ($luc_quy == '000000') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '111111') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '222222') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '333333') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '444444') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '555555') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '666666') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '777777') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '888888') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        if ($luc_quy == '999999') {
            $arr[] = 239;
            $luc_quy_state = 1;
        }
        // ngu quy 
        $ngu_quy_state = 0;
        if ($luc_quy_state == 0) {
            $ngu_quy = substr($phone, -5, 5);
            if ($ngu_quy == '00000') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '11111') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '22222') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '33333') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '44444') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '55555') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '66666') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '77777') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '88888') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
            if ($ngu_quy == '99999') {
                $arr[] = 238;
                $ngu_quy_state = 1;
            }
        }
        // tu quy 
        $tu_quy_state = 0;
        if ($luc_quy_state == 0 && $ngu_quy_state == 0) {
            $tu_quy = substr($phone, -4, 4);
            if ($tu_quy == '0000') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '1111') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '2222') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '3333') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '4444') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '5555') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '6666') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '7777') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '8888') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
            if ($tu_quy == '9999') {
                $arr[] = 237;
                $tu_quy_state = 1;
            }
        }
        // tam hoa
        $tam_quy_state = 0;
        if ($luc_quy_state == 0 && $ngu_quy_state == 0 && $tu_quy_state == 0) {
            $tam_quy = substr($phone, -3, 3);
            if ($tam_quy == '000') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '111') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '222') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '333') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '444') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '555') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '666') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '777') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '888') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
            if ($tam_quy == '999') {
                $arr[] = 236;
                // $tu_quy_state = 1;
            }
        }
        // sim loc phat
        $duoi = substr($phone, -2, 2);
        if ($duoi == '86') {
            $arr[] = 234;
        }
        if ($duoi == '68') {
            $arr[] = 234;
        }
        // sim thần tài
        if ($duoi == '79') {
            $arr[] = 233;
        }
        if ($duoi == '39') {
            $arr[] = 233;
        }
        // sim ông địa
        if ($duoi == '78') {
            $arr[] = 232;
        }
        if ($duoi == '38') {
            $arr[] = 232;
        }
        // sim số kép
        $duoi_1 = substr($phone, -1, 1);
        $duoi_2 = substr($phone, -2, 1);
        $duoi_3 = substr($phone, -3, 1);
        $duoi_4 = substr($phone, -4, 1);
        $duoi_5 = substr($phone, -5, 1);
        $duoi_6 = substr($phone, -6, 1);
        if ($duoi_1 == $duoi_2) {
            $arr[] = 231;
        }
        if ($duoi_3 == $duoi_2) {
            $arr[] = 231;
        }
        // sim số lặp
        if ($duoi_1 == $duoi_3 && $duoi_2 == $duoi_4) {
            $arr[] = 230;
        }
        // sim duoi gánh
        if ($duoi_1 == $duoi_3) {
            $arr[] = 229;
        }
        // sim số đảo
        if ($duoi_1 == $duoi_6 && $duoi_2 == $duoi_5 && $duoi_3 == $duoi_4) {
            $arr[] = 228;
        }
        // sim số tiến
        if ($duoi_6 > $duoi_5 && $duoi_5 > $duoi_4 && $duoi_4 > $duoi_3 && $duoi_3 > $duoi_2 && $duoi_2 > $duoi_1) {
            $arr[] = 227;
        }
        // sim tam hoa kép
        if ($duoi_6 == $duoi_5 && $duoi_5 == $duoi_4 && $duoi_3 == $duoi_2 && $duoi_2 == $duoi_1) {
            $arr[] = 245;
        }
        // sim taxi
        if ($duoi_1 == $duoi_3 && $duoi_3 == $duoi_5 && $duoi_2 == $duoi_4 && $duoi_4 == $duoi_6) {
            $arr[] = 235;
        }
        if ($duoi_1 == $duoi_4 && $duoi_2 == $duoi_5 && $duoi_3 == $duoi_6) {
            $arr[] = 235;
        }
        $duoi_4_1 = substr($phone, -4, 4);
        $duoi_4_2 = substr($phone, -8, 4);
        if ($duoi_4_1 == $duoi_4_2) {
            $arr[] = 235;
        }
        // sim số sảnh
        $duoi = substr($phone, -3, 3);
        if ($duoi == '012') {
            $arr[] = 246;
        }
        if ($duoi == '123') {
            $arr[] = 246;
        }
        if ($duoi == '234') {
            $arr[] = 246;
        }
        if ($duoi == '345') {
            $arr[] = 246;
        }
        if ($duoi == '456') {
            $arr[] = 246;
        }
        if ($duoi == '567') {
            $arr[] = 246;
        }
        if ($duoi == '678') {
            $arr[] = 246;
        }
        if ($duoi == '789') {
            $arr[] = 246;
        }
        $duoi = substr($phone, -4, 4);
        if ($duoi == '8910') {
            $arr[] = 246;
        }
        // sim đặc biệt
        $duoi = substr($phone, -4, 4);
        if ($duoi == '1102') {
            $arr[] = 240;
        }
        if ($duoi == '4078') {
            $arr[] = 240;
        }
        if ($duoi == '4953') {
            $arr[] = 240;
        }
        if ($duoi == '1368') {
            $arr[] = 240;
        }
        // sim taxi

        ////////////////////
        // sim itelecom
        $dau_so = substr($phone, 0, 3);
        if ($dau_so == '087') {
            $arr[] = 241; 
        }
        // sim viettel
        if ($dau_so == '086') {
            $arr[] = 198; 
        }
        if ($dau_so == '096') {
            $arr[] = 198; 
        }
        if ($dau_so == '097') {
            $arr[] = 198; 
        }
        if ($dau_so == '098') {
            $arr[] = 198; 
        }
        if ($dau_so == '032') {
            $arr[] = 198; 
        }
        if ($dau_so == '033') {
            $arr[] = 198; 
        }
        if ($dau_so == '034') {
            $arr[] = 198; 
        }
        if ($dau_so == '035') {
            $arr[] = 198; 
        }
        if ($dau_so == '036') {
            $arr[] = 198; 
        }
        if ($dau_so == '037') {
            $arr[] = 198; 
        }
        if ($dau_so == '038') {
            $arr[] = 198; 
        }
        if ($dau_so == '039') {
            $arr[] = 198; 
        }
        // sim vinaphone
        if ($dau_so == '088') {
            $arr[] = 199; 
        }
        if ($dau_so == '091') {
            $arr[] = 199; 
        }
        if ($dau_so == '094') {
            $arr[] = 199; 
        }
        if ($dau_so == '083') {
            $arr[] = 199; 
        }
        if ($dau_so == '084') {
            $arr[] = 199; 
        }
        if ($dau_so == '085') {
            $arr[] = 199; 
        }
        if ($dau_so == '081') {
            $arr[] = 199; 
        }
        if ($dau_so == '082') {
            $arr[] = 199; 
        }
        // sim mobifone
        if ($dau_so == '089') {
            $arr[] = 200; 
        }
        if ($dau_so == '090') {
            $arr[] = 200; 
        }
        if ($dau_so == '093') {
            $arr[] = 200; 
        }
        if ($dau_so == '070') {
            $arr[] = 200; 
        }
        if ($dau_so == '079') {
            $arr[] = 200; 
        }
        if ($dau_so == '077') {
            $arr[] = 200; 
        }
        if ($dau_so == '076') {
            $arr[] = 200; 
        }
        if ($dau_so == '078') {
            $arr[] = 200; 
        }
        // sim vietnammobile
        if ($dau_so == '092') {
            $arr[] = 190; 
        }
        if ($dau_so == '056') {
            $arr[] = 190; 
        }
        if ($dau_so == '058') {
            $arr[] = 190; 
        }
        // sim Gmobile
        if ($dau_so == '099') {
            $arr[] = 201; 
        }
        if ($dau_so == '059') {
            $arr[] = 201; 
        }
        /////////////////////
        $nam = substr($phone, -4, 4);
        if ($nam == 1994) {
            $arr[] = 193;
        }
        if ($nam == 1995) {
            $arr[] = 191;
        }
        if ($nam == 1996) {
            $arr[] = 192;
        }
        if ($nam == 1997) {
            $arr[] = 209;
        }
        if ($nam == 1998) {
            $arr[] = 212;
        }
        if ($nam == 1999) {
            $arr[] = 213;
        }
        if ($nam == 2000) {
            $arr[] = 214;
        }
        if ($nam == 2001) {
            $arr[] = 215;
        }
        if ($nam == 2002) {
            $arr[] = 216;
        }
        if ($nam == 2003) {
            $arr[] = 217;
        }
        if ($nam == 2004) {
            $arr[] = 218;
        }
        if ($nam == 2005) {
            $arr[] = 219;
        }
        if ($nam == 2006) {
            $arr[] = 220;
        }
        if ($nam == 2007) {
            $arr[] = 221;
        }
        if ($nam == 2008) {
            $arr[] = 222;
        }
        if ($nam == 2009) {
            $arr[] = 223;
        }
        if ($nam == 2010) {
            $arr[] = 224;
        }
        if ($nam == 2011) {
            $arr[] = 225;
        }
        if ($nam == 2012) {
            $arr[] = 226;
        }
        return implode(",", $arr);
    }
$import_admin_id = $_GET['admin_id'];
// $admin_info = $action->getDetail('admin', 'admin_id', $_GET['admin_id']);
$them_so = $admin_info['them_so'];
// die('tuan');
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

                    // include_once dirname(__FILE__) . "/PHPExcel/PHPExcel/Reader/Excel2007.php";
                    include_once dirname(__FILE__) . "/PHPExcel/IOFactory.php";
                    try {
                        //Load the excel(.xls/.xlsx) file
                        // echo $file;
                        // echo 'tuan';
                        // echo '<pre>';
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                        // echo 'tuan1';
                    } catch (Exception $e) {
                         die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                        // die ('loi.');
                    }
                    // die('tuan');
                    //An excel file may contains many sheets, so you have to specify which one you need to read or work with.
                    $sheet = $objPHPExcel->getSheet(0);
                    //It returns the highest number of rows
                    $total_rows = $sheet->getHighestRow();
                    $tong_sim = $total_rows;
                    //It returns the highest number of columns
                    $total_columns = $sheet->getHighestColumn();//echo $total_columns;
                          
                    echo '<h4>Data from excel file</h4>';
                    echo '<table cellpadding="5" cellspacing="1" border="1" class="responsive">';
                  
                    // $query = "insert into `user_details` (`id`, `name`, `mobile`, `country`) VALUES ";
                    $query = "insert into `product` (`product_name`, `product_content`, `product_des2`, `product_date`, `state`, kich_co_id) VALUES ";
                    //Loop through each row of the worksheet
                    $amount = 0;

                    for($row =1; $row <= $total_rows; $row++) {
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
                    //////////////////////////
                    $ngay_up_kho = date('Y-m-d');
                    $sql = "UPDATE admin SET tong_sim = '$tong_sim', ngay_up_kho = '$ngay_up_kho' WHERE admin_id = $import_admin_id";
                    $result = mysqli_query($conn_vn, $sql);
                    ///////////////////////////
                    for($row =1; $row <= $total_rows; $row++) {
                        $query = "insert into `product` (productcat_ar, `product_name`, product_img, product_price, product_type, friendly_url, title_seo, state, product_price_sale, ten_dai_ly, phone_contact, dia_chi, product_created_date, tong_sim, admin_id, keyword, des_seo) VALUES ";
                        //Read a single row of data and store it as a array.
                        //This line of code selects range of the cells like A1:D1
                        $single_row = $sheet->rangeToArray('A' . $row . ':' . $total_columns . $row, NULL, TRUE, FALSE);
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

                        if ($row == 3) {
                            // break;
                        }

                        $run = 1;
                        // var_dump($single_row[0]);
                        foreach($single_row[0] as $key=>$value) {
                            $d++;

                            if ($d == 1) {
                                if (empty($value)) {
                                    $run = 0;
                                } else {
                                    // $product_has = check_product_has($value, $tong_sim);
                                    // if ($product_has != 0) {
                                    //     $run = 0;
                                    // }
                                }
                                
                                $product_name = $value;
                                set($product_name);
                                continue;
                                $title_seo = "sim $value, mua bán sim $value";
                                $keyword = "$value, sim số đẹp $value, mua bán sim $value, tìm sim $value";
                                $des_seo = "mua sim số đẹp $value tại caosim.net với giá rẻ nhất, đăng ký sim $value chính chủ , giao sim $value trong thời gian ngắn nhất. Hy vọng khi quý khách chọn sim $value sẽ đem đến sự hài lòng, thoải mái, bình an và may mắn trong cuộc sống. caosim.net rất vui được phục vụ quý khách. Mọi thắc mắc vui lòng LH 0973808080";
                                $url = vi_en1($value);//echo $value;
                            }
                            
                            if ($d == 2) {
                                $value = str_replace('.', '', $value);
                                $value = str_replace(',', '', $value);
                                $value = preg_replace("/[^0-9]/", "",$value);
                                if ($them_so != 0) {
                                    $them_so_1 = 10 ** $them_so;
                                    $product_price = (int)$value;
                                    $product_price = $product_price * $them_so_1;
                                } else {
                                    $product_price = (int)$value;
                                }
                                
                                // $dia_chi = $value;
                            }
                            $dia_chi = '';

                            if ($d == 3) {
                                // if ($value == '') {
                                //     $productcat_ar = 0;
                                // } else {
                                //     $productcat_ar = $value;
                                // }
                                // $phone_contact = '0'.$value;
                            }
                            $phone_contact = '';

                            if ($d == 4) {
                                // $product_price = (int)$value;
                            }

                            if ($d == 5) {
                                // $ten_dai_ly = $value;
                            }
                            $ten_dai_ly = '';

                            $product_img = 'sim-cam-on.jpg';

                            $productcat_ar = set_productcat($product_price, $url);

                            $product_type = 1;

                            $product_price_sale = hoa_hong_1($product_price, $import_admin_id);

                            $now = date("Y-m-d H:i:s");
                            
                        }
                        continue;
                        if ($run == 0) {
                            continue;
                        }
                        $query .= "'$productcat_ar', '$product_name', '$product_img', '$product_price', '$product_type', '$url', '$title_seo', '1', '$product_price_sale', '$ten_dai_ly', '$phone_contact', '$dia_chi', '$now', '$tong_sim', '$import_admin_id', '$keyword', '$des_seo'";
                        $query1 .= "'$product_name', '$url', '$title_seo', '$keyword', '$des_seo',";

                        // $query = substr($query, 0, -1);
                        $query .= ")";
                        echo "</tr>";
                        // echo $query.'<br>';
                        mysqli_query($conn_vn, $query);
                        // echo mysqli_error($conn_vn);
                        $product_id = mysqli_insert_id($conn_vn);
                        $sql_vn = "INSERT INTO product_languages (lang_product_name, friendly_url, title_seo, keyword, des_seo, languages_code, product_id) VALUES ".$query1."'vn', $product_id)";//echo $sql_vn.'<br>';
                         mysqli_query($conn_vn, $sql_vn);
                         // echo $sql_vn;
                         // echo mysqli_error($conn_vn);
                        $sql_en = "INSERT INTO product_languages (lang_product_name, friendly_url, title_seo, keyword, des_seo, languages_code, product_id) VALUES ".$query1."'en', $product_id)";//echo $sql_en.'<br>';
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
<?php 
    if (empty($_GET['admin_id'])) {
        // die('có lỗi');
    }
    // $admin_info = $action->getDetail('admin', 'admin_id', $_GET['admin_id']);
?>
<p style="width: 100%;font-size: 20px;font-weight: bold;">Tên đại lý: <?= $admin_info['admin_name'] ?></p>
<p style="width: 100%;font-size: 20px;font-weight: bold;">Địa chỉ: <?= $admin_info['admin_address'] ?></p>
<p style="width: 100%;">Thêm số: <input type="number" name="" value="<?= $admin_info['them_so'] ?>" placeholder="vidu: 3" onchange="them_so(this.value, <?= $_GET['admin_id'] ?>)"></p>
<form action="" method="post" enctype="multipart/form-data">
    Upload excel file SIM : 
    <input type="file" name="uploadFile" value="" />
    <input type="submit" name="submit" value="Upload" />
</form>

<script>
    function them_so (so, admin_id) {
        // alert(so);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             // document.getElementById("demo").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "/functions/ajax/them_so.php?so="+so+"&admin_id="+admin_id, true);
          xhttp.send();
    }
</script>