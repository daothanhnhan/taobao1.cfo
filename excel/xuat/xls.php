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
function register () {
		global $conn_vn;
		if (isset($_GET['check_in'])) {
			$check_in = $_GET['check_in'];
			$check_out = $_GET['check_out'];

			$sql = "SELECT * FROM cart WHERE date_cart between '$check_in' and '$check_out'";
		} elseif (isset($_GET['ma'])) {
			$ma = $_GET['ma'];
			$sql = "SELECT * FROM cart WHERE id_cart like '%$ma%'";
		} elseif (isset($_GET['name'])) {
			$name = $_GET['name'];
			$sql = "SELECT * FROM cart WHERE name_buyer like '%$name%'";
		} elseif (isset($_GET['phone'])) {
			$phone = $_GET['phone'];
			$sql = "SELECT * FROM cart WHERE phone_buyer like '%$phone%'";
		} else {
			$sql = "SELECT * FROM cart";
		}
		
		$result = mysqli_query($conn_vn, $sql) or die(mysqli_error($conn_vn));
		
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		// echo "string";
		return $rows;
		
	}
	$list = register();// var_dump($list);
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


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Ngày đặt')
            ->setCellValue('C1', 'khách hàng')
            ->setCellValue('D1', 'Số điện thoại')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Tổng tiền');

// Miscellaneous glyphs, UTF-8
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A4', 'Miscellaneous glyphs')
//             ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
$i = 1;
foreach ($list as $item) {
	$i++;
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $item['id_cart'])
            ->setCellValue('B'.$i, $item['date_cart'])
            ->setCellValue('C'.$i, $item['name_buyer'])
            ->setCellValue('D'.$i, $item['phone_buyer'])
            ->setCellValue('E'.$i, $item['mail_buyer'])
            ->setCellValue('F'.$i, $item['total_price'].' Tệ');
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
