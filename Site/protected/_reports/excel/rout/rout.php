<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2013 PHPExcel
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
 * @copyright  Copyright (c) 2006 - 2013 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.9, 2013-06-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/Moscow');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
spl_autoload_unregister(array('YiiBase','autoload'));
Yii::import('application.extensions.Classes.PHPExcel', true);
spl_autoload_register(array('YiiBase','autoload'));

// Create new PHPExcel object
//$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load(dirname(__FILE__)."/rout.xlsx");

// Set document properties
$objPHPExcel->getProperties()->setCreator($manager->getFIO())
                             ->setLastModifiedBy($manager->getFIO())
                             ->setTitle($medpred->getFIO())
                             ->setSubject("Маршрутный лист")
                             ->setDescription("Список поликлиник в маршруте понедельно")
                             ->setKeywords("маршрут; поликлиники")
                             ->setCategory("Отчет");

//Set width and heigth
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); //setWidth(2);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setTitle('rout');

// Add some data
$objPHPExcel->getActiveSheet()
        ->mergeCells('A1:C1')
        ->getRowDimension(1)->setRowHeight(30);
$objPHPExcel->getActiveSheet()
        ->setCellValue('A1', 'ФИО сотрудника/округ');

$objPHPExcel->getActiveSheet()
        ->mergeCells('A2:C2')
        ->getRowDimension(2)->setRowHeight(30);;
$objPHPExcel->getActiveSheet()
        ->setCellValue('A2', 'Мобильный телефон');

$objPHPExcel->getActiveSheet()
        ->mergeCells('A3:C3')
        ->getRowDimension(3)->setRowHeight(30);;
$objPHPExcel->getActiveSheet()
        ->setCellValue('A3', 'Время выхода на территорию');

$objPHPExcel->getActiveSheet()
        ->setCellValue('D1', $medpred->getFIO());

$objPHPExcel->getActiveSheet()
        ->getStyle('A1:D3')
            ->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                       ->getStartColor()->setRGB('CCFFFF');

$objPHPExcel->getActiveSheet()
        ->getStyle('A1:D3')
            ->getFont()->setBold(true)
                       ->setItalic(true);

$objPHPExcel->getActiveSheet()
        ->getStyle('A1:D3')
            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$DOW = array(
    "Monday"    => "ПОНЕДЕЛЬНИК",
    "Tuesday"   => "ВТОРНИК",
    "Wednesday" => "СРЕДА",
    "Thursday"  => "ЧЕТВЕРГ",
    "Friday"    => "ПЯТНИЦА"
);

$imei = $medpred->IMEI;
$curWeek = date ('W', strtotime("now"));
$nextMon = strtotime("next Monday");
$y = date ('Y', $nextMon);
$m = date ('m', $nextMon);
$d = date ('d', $nextMon);
$date = new DateTime();
$date->setDate($y, $m, $d);
//echo $date->format('d.m.Y');

$sql = "SELECT oh.NAME, oh.ADRESS
          FROM {{h_planneritem}} ohp
             , {{hospital}} oh
             , (      
                SELECT ABS(:CUR_WEEK + 1 - os.WEEK_OF_START) MOD 3 AS WK
                     , os.IMEI
                  FROM {{setts}} os
                 WHERE os.IMEI = :IMEI  
              ) setts
        WHERE ohp.IMEI = setts.IMEI
          AND ohp.WEEKNUM = setts.WK
          AND oh.IMEI = ohp.IMEI
          AND oh.HOSPITAL_ID = ohp.HOSPITAL_ID
          AND ohp.DAY_OF_WEEK = :DOW";
$command=Yii::app()->db->createCommand($sql);
$command->bindParam(":CUR_WEEK", $curWeek, PDO::PARAM_INT);
$command->bindParam(":IMEI", $imei, PDO::PARAM_STR);
$row = 4;
foreach ($DOW as $dow_en => $dow_ru) {
//    echo 'Key: '.$key, ' Value: '.$value, ' Date: '. $date->format('d.m.Y') .'<br/>';
    $objPHPExcel->getActiveSheet()->getStyle('A'.($row))->getAlignment()
              ->setTextRotation(90)
              ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
              ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
              ->setWrapText(true);
//    $objPHPExcel->getActiveSheet()->getStyle('A'.($row))->getFont()->setSize(8);
    
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, 'название ЛПУ')
                                  ->setCellValue('D'.$row, 'адрес ЛПУ')
                                  ->getRowDimension($row)->setRowHeight(36);
    
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row.':D'.$row)->getAlignment()
              ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
              ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
    $command->bindParam(":DOW", $dow_en , PDO::PARAM_STR);
    $dataReader = $command->queryAll();
    if (empty($dataReader)) {
        $rangeStart = 'A'.$row;
        $rangeEnd   = 'A'.($row + 3);
        $objPHPExcel->getActiveSheet()
                ->mergeCells($rangeStart.':'.$rangeEnd);
        $objPHPExcel->getActiveSheet()
                ->setCellValue($rangeStart, "$dow_ru\n". $date->format('d.m.Y'));
        $objPHPExcel->getActiveSheet()
                ->getStyle($rangeStart.':'.$rangeEnd)
                    ->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                               ->getStartColor()->setRGB('CCFFFF');
//        $objPHPExcel->getActiveSheet()
//                ->getStyle($rangeStart.':'.$rangeEnd)
//                    ->getAlignment()->setTextRotation(90)
//                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
//                                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
//                                    ->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getRowDimension($row + 4)->setRowHeight(7);
        $row = $row + 5;         
    } else {
        $rNum=0;
        $rangeStart = 'A'.$row;
        $rangeEnd   = 'A'.($row + count($dataReader) + 1);
        $objPHPExcel->getActiveSheet()->mergeCells($rangeStart.':'.$rangeEnd);
        $objPHPExcel->getActiveSheet()->getStyle($rangeStart.':'.$rangeEnd)
                ->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                           ->getStartColor()->setRGB('CCFFFF');
//        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':A'.($row+count($dataReader)))->getBorders()
//              ->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->setCellValue($rangeStart, "$dow_ru\n". $date->format('d.m.Y'));
        foreach ($dataReader as $dR) {
            $row = $row + 1;
            $rNum=$rNum+1;
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $rNum)
                                          ->setCellValue('C'.$row, $dR['NAME'])
                                          ->setCellValue('D'.$row, $dR['ADRESS']);
        }
        $objPHPExcel->getActiveSheet()->getRowDimension($row + 2)->setRowHeight(7);
        $row = $row + 3; 
    }
//    var_dump($dataReader);
//    echo '<ul/>';
    $date->modify('+1 day'); 
}

$objPHPExcel->getActiveSheet()
        ->getStyle('A1:D3')
            ->getBorders()
                ->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

$objPHPExcel->getActiveSheet()
        ->getStyle('A4:D'.($row-1))
            ->getBorders()
                ->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()
        ->getPageSetup()
            ->setPrintArea('A1:D'.($row-1));


$objPHPExcel->getActiveSheet()
        ->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW)
                        ->setZoomScale(80);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Маршрутный_лист('.$medpred->getFIO().').xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;