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
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
session_start();
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

require_once dirname(__FILE__) . '/../database.php';
// require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . "/../library.php";
require_once dirname(__FILE__) . '/../pagination/Pagination.php';
require_once dirname(__FILE__) . "/../action.php";
// require_once dirname(__FILE__) . '/../action_kiotviet.php';
$action = new action();
function build_pc () {
	global $conn_vn;
	// $kiotviet = new action_kiotviet();
	$action = new action();
	$rows = array();
	if (!empty($_SESSION['shopping_cart'])) {
		foreach ($_SESSION['shopping_cart'] as $item) {
			$product = $action->getDetail('product', 'product_id', $item['product_id']);
			$rows[] = $product;
		}
	}
	return $rows;
}
$list = build_pc();//var_dump($list);
// die;
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

///////////
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
///////////
$d = 1;
foreach ($list as $item) {
	$d++;
	$objPHPExcel->getActiveSheet()->getStyle('C'.$d)->getAlignment()->setWrapText(true);
}


// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'STT')
            ->setCellValue('B1', 'Mã sản phẩm')
            ->setCellValue('C1', 'Tên sản phẩm')
            ->setCellValue('D1', 'Bảo hành')
            ->setCellValue('E1', 'Đơn giá');
            // ->setCellValue('F1', 'Đơn giá');
            // ->setCellValue('G1', 'Thành tiền');

// Miscellaneous glyphs, UTF-8
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A4', 'Miscellaneous glyphs')
//             ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
            
$i = 1;
$total = 0;
foreach ($list as $item) {
	$i++;
	// $total += $action->percent1($item['product_price'], $item['product_price_sale']);
	$total += $item['product_price'];
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $i-1)
            ->setCellValue('B'.$i, $item['product_code'])
            ->setCellValue('C'.$i, $item['product_name'])
            ->setCellValue('D'.$i, $item['product_shape'])
            // ->setCellValue('E'.$i, 1)
            ->setCellValue('E'.$i, number_format($item['product_price']).' đ');
            // ->setCellValue('G'.$i, number_format($item['basePrice']).' đ');
}
$i++;
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('D'.$i, 'Tổng tiền')
			->setCellValue('E'.$i, number_format($total).' đ');
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
// header('Content-Type: application/vnd.ms-excel');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cauhinhpc.xlsx"');

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
