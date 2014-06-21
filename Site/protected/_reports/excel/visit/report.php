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
//require_once '../Classes/PHPExcel.php';


// Create new PHPExcel object

spl_autoload_unregister(array('YiiBase','autoload'));
Yii::import('application.extensions.Classes.PHPExcel', true);
spl_autoload_register(array('YiiBase','autoload'));

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load(dirname(__FILE__)."/report.xlsx");

// Set document properties
$objPHPExcel->getProperties()->setCreator($m->getFIO())
                             ->setLastModifiedBy($m->getFIO())
                             ->setTitle($mp->getFIO())
                             ->setSubject("Отчет о посещениях")
                             ->setDescription("Отчет о посещениях поликлиник медицинским представителям за период.")
                             ->setKeywords("песещения; поликлиники")
                             ->setCategory("Отчет");


// Add some data
    $objPHPExcel->getActiveSheet()->setCellValue('C2', $mp->getFIO())
                                  ->setCellValue('G2', 'Москва');
$baserow = 5;
$r = 1;
foreach($data as $d) {
    $row = $baserow + $r;
    $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
    
    $sql = "SELECT GROUP_CONCAT(Y.SUBQUERY_DEMO_STATS SEPARATOR ', ') AS DEMO_STATS
              FROM (
                    SELECT X.DEMONSTRATION_ID, CONCAT(X.DEMO_NAME, ' (', ROUND(SUM(X.TIME)/60, 1), ' мин.)') AS SUBQUERY_DEMO_STATS
                      FROM (
                            SELECT dd.DEMONSTRATION_ID, LEFT(dd.SLIDE_KEY, LOCATE('_',dd.SLIDE_KEY) - 1) AS DEMO_NAME, ds.TIME 
                              FROM {{d_demo}} dd LEFT JOIN {{d_show}} ds ON dd.DEMO_ID = ds.DEMO_ID
                             WHERE dd.DEMONSTRATION_ID = :DEMONSTRATION_ID
                               AND ds.TIME > 5
                           ) AS X
                     GROUP BY X.DEMO_NAME
                   ) AS Y
             GROUP BY Y.DEMONSTRATION_ID";
    $command=Yii::app()->db->createCommand($sql);
    $command->bindParam(":DEMONSTRATION_ID", $d['DEMONSTRATION_ID'], PDO::PARAM_INT);
    //echo $command->text;
    $dR = $command->queryRow();  
    
    
    $sql = "SELECT 
                   CASE
                     WHEN hosp.E_LAT IS NULL THEN 'НЕТ ДАННЫХ'
                     WHEN (ABS(hosp.E_LAT  - dem.A_LAT ) < 0.001) 
                      AND (ABS(hosp.E_LONG - dem.A_LONG) < 0.001) THEN 'ИСТИНА'
                     ELSE 'ЛОЖЬ' 
                   END AS T_F
            FROM (
                  SELECT od.DOCTOR_ID, od.IMEI, oh.EXT_LATITUDE E_LAT, oh.EXT_LONGTITUDE E_LONG
                    FROM {{doctor}} od
                    JOIN {{hospital}} oh
                   USING ( IMEI, HOSPITAL_ID )
                 ) hosp
            JOIN (
                  SELECT od.IMEI, od.DOCTOR_ID, AVG(ods.LATITUDE) A_LAT, AVG(ods.LONGTITUDE) A_LONG
                    FROM (
                    {{demonstration}} od
                    JOIN {{d_demo}} odd
                    USING ( DEMONSTRATION_ID )
                    )
                    JOIN {{d_show}} ods
                    USING ( DEMO_ID )
                   WHERE od.DEMONSTRATION_ID = :DEMONSTRATION_ID
                     AND ods.LATITUDE <> 0
                   GROUP
                      BY od.IMEI, od.DOCTOR_ID
                 ) dem
            USING ( IMEI, DOCTOR_ID )";
    
    $command=Yii::app()->db->createCommand($sql);
    $command->bindParam(":DEMONSTRATION_ID", $d['DEMONSTRATION_ID'], PDO::PARAM_INT);
    //echo $command->text;
    $T_F = $command->queryRow();    
    
    $objPHPExcel->getActiveSheet()/*->setCellValue('A'.$row, trim($d['DEMONSTRATION_ID']))*/
                                  ->setCellValue('B'.$row, $r)
                                  ->setCellValue('C'.$row, trim($d['NAME']))
                                  ->setCellValue('D'.$row, trim($d['ADRESS']))
                                  ->setCellValue('E'.$row, trim($T_F['T_F']))
                                  ->setCellValue('F'.$row, trim($d['NEAREST_METRO'])) 
                                  ->setCellValue('G'.$row, trim($d['REG_PHONE']))
                                  ->setCellValue('H'.$row, trim($d['SECOND_NAME'].' '.$d['FIRST_NAME'].' '.$d['THIRD_NAME']))
                                  ->setCellValue('J'.$row, trim($d['SPECIALITY']))
                                  ->setCellValue('K'.$row, trim($d['WEEKNUM']))
                                  ->setCellValue('L'.$row, date('d.m.Y', CDateTimeParser::parse($d['VISIT_DATE'], 'yyyy-MM-dd')))
                                  ->setCellValue('M'.$row, trim($d['VISIT_TIME']))
                                  ->setCellValue('N'.$row, trim($d['DURATION']))
                                  ->setCellValue('O'.$row, trim($dR['DEMO_STATS']))
                                  ->setCellValue('P'.$row, trim($d['VISIT_ANALYZE']));
    $r = $r + 1;
}

$objPHPExcel->getActiveSheet()->removeRow(5,1);

$conditionalTrue = new PHPExcel_Style_Conditional();                                                                                
$conditionalTrue->setConditionType(PHPExcel_Style_Conditional::CONDITION_CONTAINSTEXT);                                             
$conditionalTrue->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_CONTAINSTEXT);                                               
$conditionalTrue->setText('ИСТИНА');                                                                                                    
$conditionalTrue->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);            
$conditionalTrue->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getEndColor()->setARGB('FFCCFFFF');               

$conditionalFalse = new PHPExcel_Style_Conditional();                                                                                
$conditionalFalse->setConditionType(PHPExcel_Style_Conditional::CONDITION_CONTAINSTEXT);                                             
$conditionalFalse->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_CONTAINSTEXT);                                               
$conditionalFalse->setText('ЛОЖЬ');                                                                                                    
$conditionalFalse->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKRED);            
$conditionalFalse->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getEndColor()->setARGB('FFDA9694');

$conditionalNoData = new PHPExcel_Style_Conditional();                                                                                
$conditionalNoData->setConditionType(PHPExcel_Style_Conditional::CONDITION_CONTAINSTEXT);                                             
$conditionalNoData->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_CONTAINSTEXT);                                               
$conditionalNoData->setText('НЕТ ДАННЫХ');                                                                                                    
$conditionalNoData->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKYELLOW);            
$conditionalNoData->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getEndColor()->setARGB('FFFFEBA5');

if (!isset($row)) { $row = 6; }

$conditionalStyles = $objPHPExcel->getActiveSheet()->getStyle('E5:E'.$row)->getConditionalStyles();
array_push($conditionalStyles, $conditionalTrue);
array_push($conditionalStyles, $conditionalFalse);
array_push($conditionalStyles, $conditionalNoData);
$objPHPExcel->getActiveSheet()->getStyle('E5:E'.$row)->setConditionalStyles($conditionalStyles);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
$f_date = date('d_m_Y', CDateTimeParser::parse($f_d, 'dd.MM.yyyy'));
$l_date = date('d_m_Y', CDateTimeParser::parse($l_d, 'dd.MM.yyyy'));
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.'Отчет о посещениях('.$mp->getFIO().'_'.$f_date.'_'.$l_date.').xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
