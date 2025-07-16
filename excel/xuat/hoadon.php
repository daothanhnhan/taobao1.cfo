<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

require_once dirname(__FILE__) . '/../../../functions/database.php';
function cart ($id) {
		global $conn_vn;
		
		$sql = "SELECT * FROM cart WHERE id_cart = $id";
		$result = mysqli_query($conn_vn, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
	$info = cart($_GET['id']);// var_dump($list);

function cart_detail ($id) {
	global $conn_vn;
	$sql = "SELECT * FROM cartdetail WHERE id_cart = $id";
	$result = mysqli_query($conn_vn, $sql);
	$rows = array();
	$num = mysqli_num_rows($result);
	if ($num > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
	}
	return $rows;
}
$list_cart = cart_detail($_GET['id']);

function product ($id) {
	global $conn_vn;
	$sql = "SELECT * FROM product WHERE product_id = $id";
	$result = mysqli_query($conn_vn, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row['product_name'];
}
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);

// $styleArray = array(
//   'borders' => array(
//     'bottom' => array(
//       'style' => PHPExcel_Style_Border::BORDER_THIN
//     )
//   )
// );
$styleArray = array(
        'font' => array(
            'bold' => true,
            'size' => 15
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
            )
        )
    );
$chudam = array(
		'font' => array(
            'bold' => true
            
        ),
);

$headerchu = array(
		'font' => array(
            'bold' => true,
            'size' => 16
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
        // 'borders' => array(
        //     'allborders' => array(
        //         'style' => PHPExcel_Style_Border::BORDER_THIN,
        //         'color' => array('rgb' => '000000')
        //     )
        // )
);

$soluong = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        )
    );
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($headerchu);

// $objPHPExcel->getActiveSheet()->getStyle('A3:C3')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A9:C9')->applyFromArray($styleArray);
// $sheet->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
$objPHPExcel->getActiveSheet()->setCellValue('A1','XUẤT HÓA ĐƠN');
// Add some data
// $objPHPExcel->setActiveSheetIndex(0)
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($chudam);
$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($chudam);
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($chudam);
$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($chudam);
$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($chudam);
            // ->setCellValue('A1', 'XUẤT HÓA ĐƠN');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', 'Tên khách hàng')
            ->setCellValue('A4', 'Số điện thoại')
            ->setCellValue('A5', 'Địa chỉ')
            ->setCellValue('A6', 'Ngày xuất hóa đơn')
            ->setCellValue('A7', 'Số hóa đơn');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B3', $info['name_buyer'])
            ->setCellValue('B4', $info['phone_buyer'])
            ->setCellValue('B5', $info['address_buyer'])
            ->setCellValue('B6', date('d-m-Y'))
            ->setCellValue('B7', $info['id_cart']);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A9', 'Tên sản phẩm')
            ->setCellValue('B9', 'Số lượng')
            ->setCellValue('C9', 'Thành tiền');

// Miscellaneous glyphs, UTF-8
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A4', 'Miscellaneous glyphs')
//             ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
$i = 9;
foreach ($list_cart as $item) {
	$i++;
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, product($item['id_product']))
            ->setCellValue('B'.$i, $item['qyt_product'])
            ->setCellValue('C'.$i, number_format($item['totalprice_product']));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
// header('Content-Type: application/vnd.ms-excel');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="thongtin.xlsx"');

header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
