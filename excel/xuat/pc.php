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
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
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

// image
$objPHPExcel->getActiveSheet()->mergeCells('A1:B4');

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('Untitled-1-01.png');
$objDrawing->setCoordinates('A1');                      
// //setOffsetX works properly
$objDrawing->setOffsetX(5); 
$objDrawing->setOffsetY(5);                
// //set width, height
$objDrawing->setWidth(200); 
$objDrawing->setHeight(100); 
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// thong tin cong ty
$objPHPExcel->getActiveSheet()->mergeCells('C1:F1');
$objPHPExcel->getActiveSheet()->mergeCells('C2:F3');
$objPHPExcel->getActiveSheet()->mergeCells('C4:F4');
// $objPHPExcel->getActiveSheet()->mergeCells('C4:E4');
$objPHPExcel->getActiveSheet()
    ->getStyle('C1:F4')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('hex' => '#C10000'),
        'size'  => 15,
        'name'  => 'Verdana'
    ));

// $objPHPExcel->getActiveSheet()->getCell('A1')->setValue('Some text');
// $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(15)
                                ->getColor()->setRGB('C10000');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Công ty TNHH Máy tính Đông Anh')
            ->setCellValue('C2', 'Số 15, xóm Trại, thôn Thượng Phúc, xã Bắc Hồng, huyện Đông Anh, thành phố Hà Nội')
            ->setCellValue('C4', 'Website: https://maytinhdonganh.vn');
            // ->setCellValue('C4', 'Tổng');

$objPHPExcel->getActiveSheet()->mergeCells('A6:F7');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A6', 'BẢNG BÁO GIÁ THIẾT BỊ');
$objPHPExcel->getActiveSheet()->getStyle("A6")->getFont()->setBold(true)
                                ->setName('Verdana')
                                ->setSize(15)
                                ->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()
    ->getStyle('A6')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A11', 'STT')
            ->setCellValue('B11', 'Tên sản phẩm')
            ->setCellValue('C11', 'Bảo hành')
            ->setCellValue('D11', 'Số lượng')
            ->setCellValue('E11', 'Giá')
            ->setCellValue('F11', 'Tổng');
            // ->setCellValue('F1', 'Đơn giá');
            // ->setCellValue('G1', 'Thành tiền');
 $objPHPExcel->getActiveSheet()->getStyle('A11:F11')->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => '00FF00'
        )
    ));
// Miscellaneous glyphs, UTF-8
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A4', 'Miscellaneous glyphs')
//             ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
            
$i = 11;
$k = 0;
$total = 0;
foreach ($_SESSION['shopping_cart'] as $item) {
	$i++;
    $k++;
    $objPHPExcel->getActiveSheet()
                ->getStyle('C'.$i)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()
                ->getStyle('D'.$i)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// $total += $action->percent1($item['product_price'], $item['product_price_sale']);
    $product = $action->getDetail('product', 'product_id', $item['product_id']);
	$total += $item['product_price']*$item['product_quantity'];
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $k)
            ->setCellValue('B'.$i, $item['product_name'])
            ->setCellValue('C'.$i, $product['product_shape'])
            ->setCellValue('D'.$i, $item['product_quantity'])
            ->setCellValue('E'.$i, number_format($item['product_price']).' đ')
            // ->setCellValue('E'.$i, 1)
            ->setCellValue('F'.$i, number_format($item['product_price']*$item['product_quantity']).' đ');
            // ->setCellValue('G'.$i, number_format($item['basePrice']).' đ');
}
$i++;
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('E'.$i, 'Tổng tiền')
			->setCellValue('F'.$i, number_format($total).' đ');
////////////////
$i++;
$i++;
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':F'.$i);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'CHÂN THÀNH CÁM ƠN !');
$objPHPExcel->getActiveSheet()->getStyle("A".$i)->getFont()->setBold(false)
                                ->setName('Verdana')
                                ->setSize(13)
                                ->getColor()->setRGB('000000');
$i++;
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':F'.$i);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'Để biết thêm chi tiết, vui lòng liên hệ');
$i++;
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':F'.$i);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'Hotline: 09839.66661 - 096.250.1886 (8h - 21h30 hàng ngày)');
$i++;
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':F'.$i);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'maytinhdonganh.vn');
$objPHPExcel->getActiveSheet()->getStyle("A".$i)->getFont()->setBold(false)
                                
                                ->getColor()->setRGB('217ff3');
$i++;
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':F'.$i);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'Cám ơn quý khách hàng đã quan tâm và sự dụng dịch vụ của chúng tôi.');
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
// header('Content-Type: application/vnd.ms-excel');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="giohang.xlsx"');

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
