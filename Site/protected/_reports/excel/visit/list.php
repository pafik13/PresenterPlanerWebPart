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
ini_set('max_execution_time', '30');
date_default_timezone_set('Europe/Moscow');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
//require_once '../Classes/PHPExcel.php';

$filename='Лист посещений('.$medpred->FIO.').xls';

$styleHT = ' <Style ss:ID="hT">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" ss:Color="#000000" ss:Bold="1"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <Protection x:HideFormula="1"/>
  </Style>';

$styleHD = ' <Style ss:ID="hD">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:Rotate="90"
    ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Arial Cyr" x:CharSet="204" ss:Color="#000000"/>
   <Interior ss:Color="#CCFFFF" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="[$-419]d\ mmm;@"/>
   <Protection x:HideFormula="1"/>
  </Style>';

$t = 'T00:00:00.000';
$d = new DateTime('2014-01-01');
$header  = '<Row ss:AutoFitHeight="0" ss:Height="66">
           ';
$headerF = '<Row>
           ';
$header = $header . '<Cell ss:StyleID="hT"><Data ss:Type="String">'.'№'.'</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>';
$header = $header . '<Cell ss:StyleID="hT"><Data ss:Type="String">'.'ФИО'.'</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>';
$header = $header . '<Cell ss:StyleID="hT"><Data ss:Type="String">'.'Специальность'.'</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>';
$header = $header . '<Cell ss:StyleID="hT"><Data ss:Type="String">'.'Название ЛПУ'.'</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>';
$header = $header . '<Cell ss:StyleID="hT"><Data ss:Type="String">'.'Фактический адрес ЛПУ'.'</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>';
$header = $header . '<Cell ss:StyleID="hT"><Data ss:Type="String">'.'Ближайшее метро'.'</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>';

$Dcnt = Doctor::model()->count('imei = :imei', array('imei'=>$imei));

$headerF = $headerF . '<Cell ss:StyleID="hT" ss:Formula="=COUNTA(R[1]C:R['.$Dcnt.']C)"/>';
$headerF = $headerF . '<Cell ss:StyleID="hT" ss:Formula="=COUNTA(R[1]C:R['.$Dcnt.']C)"/>';
$headerF = $headerF . '<Cell ss:StyleID="hT" ss:Formula="=COUNTA(R[1]C:R['.$Dcnt.']C)"/>';
$headerF = $headerF . '<Cell ss:StyleID="hT" ss:Formula="=COUNTA(R[1]C:R['.$Dcnt.']C)"/>';
$headerF = $headerF . '<Cell ss:StyleID="hT" ss:Formula="=COUNTA(R[1]C:R['.$Dcnt.']C)"/>';
$headerF = $headerF . '<Cell ss:StyleID="hT" ss:Formula="=COUNTA(R[1]C:R['.$Dcnt.']C)"/>';

for ($i = 1; $i <= 365; $i++) {
   $dText = date_format($d, 'Y-m-d');
   $header  = $header . '<Cell ss:StyleID="hD"><Data ss:Type="DateTime">'.$dText.$t.'</Data><NamedCell
      ss:Name="_FilterDatabase"/></Cell>';
   $headerF = $headerF. '<Cell ss:StyleID="hT" ss:Formula="=COUNTA(R[1]C:R['.$Dcnt.']C)"/>';
   //add_date($d, '1');
   $d->modify('+1 day');
}
 $header  = $header.'
              </Row>';
 $headerF = $headerF.'
              </Row>';

$styleCT = '
  <Style ss:ID="cT">
    <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="0"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior/>
    <Protection x:HideFormula="1"/>
  </Style>';

$styleCTwbl = '
  <Style ss:ID="cTwbl">
    <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="0"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior/>
    <Protection x:HideFormula="1"/>
  </Style>';

$styleNT = '
  <Style ss:ID="nT">
    <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior ss:Color="#FFC000" ss:Pattern="Solid"/>
    <NumberFormat/>
    <Protection x:HideFormula="1"/>
  </Style>';

$styleNTwbl = '
  <Style ss:ID="nTwbl">
    <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior ss:Color="#FFC000" ss:Pattern="Solid"/>
    <NumberFormat/>
    <Protection x:HideFormula="1"/>
  </Style>';

$styleNTwhite = '
  <Style ss:ID="nTwhite">
    <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior/>
    <NumberFormat/>
    <Protection x:HideFormula="1"/>
  </Style>';

$styleFIO = '
  <Style ss:ID="FIO">
    <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior/>
    <NumberFormat/>
    <Protection x:HideFormula="1"/>
  </Style>';

$styleFIOred = '
  <Style ss:ID="FIOred">
    <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior ss:Color="#FF0000" ss:Pattern="Solid"/>
    <NumberFormat/>
    <Protection x:HideFormula="1"/>
  </Style>';

$styleFIOwbl = '
  <Style ss:ID="FIOwbl">
    <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
    <Borders>
      <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
      <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
      <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
    </Borders>
    <Font ss:FontName="Arial Cyr" ss:Color="#000000"/>
    <Interior/>
    <NumberFormat/>
    <Protection x:HideFormula="1"/>
  </Style>';

$content = '';
//echo 'doc:'. date('d-m-Y H:i:s', time());
$sql = "SELECT doc.DOCTOR_ID
             , TRIM(CONCAT_WS(' ', doc.SECOND_NAME, doc.FIRST_NAME, doc.THIRD_NAME)) AS FIO
             , doc.SPECIALITY
             , hosp.NAME as H_NAME
             , hosp.ADRESS
             , hosp.NEAREST_METRO
          FROM {{doctor}} doc
          JOIN {{hospital}} hosp
         USING (IMEI, hospital_id)
         WHERE IMEI = :IMEI";
$command=Yii::app()->db->createCommand($sql);
$command->bindParam(":IMEI", $imei, PDO::PARAM_STR);
//echo $command->getText();
$doctors = $command->queryAll();  
    
foreach ($doctors as $doc) {
    $content = $content.'<Row>
           ';
   
    $sql = 'SELECT IFNULL(MAX(DATEDIFF(HIGH_DATE.VISIT_DATE , LOW_DATE.VISIT_DATE)),0) AS DATE_DIFF
              FROM (
                     SELECT dem1.VISIT_DATE, @rownum1 := @rownum1 + 1 AS RN
                       FROM {{demonstration}} dem1
                          , (SELECT @rownum1 := 1) r
                      WHERE dem1.IMEI = :IMEI
                        AND dem1.DOCTOR_ID = :DOC_ID
                        AND YEAR(dem1.VISIT_DATE) = 2014 
                      ORDER BY dem1.VISIT_DATE
                   ) LOW_DATE
              JOIN (
                     SELECT dem2.VISIT_DATE, @rownum2 := @rownum2 + 1 AS RN
                       FROM {{demonstration}} dem2
                          , (SELECT @rownum2 := 0) r
                      WHERE dem2.IMEI = :IMEI
                        AND dem2.DOCTOR_ID = :DOC_ID
                        AND YEAR(dem2.VISIT_DATE) = 2014 
                      ORDER BY dem2.VISIT_DATE
                   ) HIGH_DATE
             USING (RN);';
    $command=Yii::app()->db->createCommand($sql);
    $command->bindParam(":IMEI", $imei, PDO::PARAM_STR);
    $command->bindParam(":DOC_ID", $doc['DOCTOR_ID'], PDO::PARAM_INT);    
    
    $date_diff = $command->query()->readColumn(0);
    
   // echo 'DATE_DIFF  =  ' . $date_diff;
    
     if (($date_diff > 0) and ($date_diff < 14)) {
         $stFIO = 'FIOred';   
     } else {
         $stFIO = 'FIO';
     }
    
    if ($date_diff > 28) {
        $stCT = 'cTwbl';
        $stNT = 'nTwbl';
        $stFIO = 'FIOwbl';
    } else {
        $stCT = 'cT';
        $stNT = 'nT'; 
    }
    
    $emptyFIO = '<Cell ss:StyleID="'.$stFIO.'"/>';
    
    $content = $content . '<Cell ss:StyleID="'.$stCT.'"><Data ss:Type="String">'.$doc['DOCTOR_ID'].'</Data></Cell>';
    
    if (empty($doc['FIO'])) {
        $content = $content . $emptyFIO;
    } else {
        $content = $content . '<Cell ss:StyleID="'.$stFIO.'"><Data ss:Type="String">'.$doc['FIO'].'</Data></Cell>';
    }

    if (empty($doc['SPECIALITY'])) {
        $content = $content . $emptyFIO;
    } else {
        $content = $content . '<Cell ss:StyleID="'.$stFIO.'"><Data ss:Type="String">'.$doc['SPECIALITY'].'</Data></Cell>';
    }
    
    if (empty($doc['H_NAME'])) {
        $content = $content . $emptyFIO;
    } else {
        $content = $content . '<Cell ss:StyleID="'.$stFIO.'"><Data ss:Type="String">'.$doc['H_NAME'].'</Data></Cell>';
    }    
    
    if (empty($doc['ADRESS'])) {
        $content = $content . $emptyFIO;
    } else {
        $content = $content . '<Cell ss:StyleID="'.$stFIO.'"><Data ss:Type="String">'.$doc['ADRESS'].'</Data></Cell>';
    }      
    
    if (empty($doc['NEAREST_METRO'])) {
        $content = $content . $emptyFIO;
    } else {
        $content = $content . '<Cell ss:StyleID="'.$stFIO.'"><Data ss:Type="String">'.$doc['NEAREST_METRO'].'</Data></Cell>';
    }
    
    $sql = 'SELECT CASE 
                     WHEN AGGR.VN IS NULL THEN \'<Cell ss:StyleID="'.$stCT.'"/>\'
                     ELSE CONCAT(\'<Cell ss:StyleID="'.$stNT.'"><Data ss:Type="Number">\', AGGR.VN, \'</Data></Cell>\')
                   END AS CELL
               FROM {{dates}} d
               LEFT JOIN 
               ( SELECT dem.VISIT_DATE, @rownum := @rownum + 1 AS VN
                   FROM {{demonstration}} dem
                      , (SELECT @rownum := 0) r
                  WHERE dem.IMEI = :IMEI
                    AND dem.DOCTOR_ID = :DOC_ID
                    AND YEAR(dem.VISIT_DATE) = 2014
               GROUP BY dem.VISIT_DATE
                ) AS AGGR
             ON d.report_date = AGGR.VISIT_DATE
           ORDER BY d.report_date';
$command=Yii::app()->db->createCommand($sql);
$command->bindParam(":IMEI", $imei, PDO::PARAM_STR);
$command->bindParam(":DOC_ID", $doc['DOCTOR_ID'], PDO::PARAM_INT);
//echo 'sub: '.date('d-m-Y H:i:s', time());
//echo $command->getText();
$visits = $command->queryAll();  

foreach ($visits as $visit) {
    $content = $content . $visit['CELL'];
}

$content = $content.'
           </Row>';
    
}

$weeks = file_get_contents(dirname(__FILE__).'/weeks.txt');

$test='<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">
    <Styles>'
        .$styleHT
        .$styleHD
        .$styleCT
        .$styleCTwbl
        .$styleNT
        .$styleNTwbl
        .$styleNTwhite
        .$styleFIO
        .$styleFIOred 
        .$styleFIOwbl
   .'</Styles>
     <Worksheet ss:Name="manual">
       <Names>
          <NamedRange ss:Name="_FilterDatabase" ss:RefersTo="=manual!R2C1:R2C371" ss:Hidden="1"/>
       </Names>
         <Table ss:ExpandedColumnCount="371" ss:ExpandedRowCount="'.($Dcnt+3).'" x:FullColumns="1" x:FullRows="1">'
         .$weeks
         .$header
         .$headerF
         .$content
         .'</Table>
           <AutoFilter x:Range="R2C1:R2C371" xmlns="urn:schemas-microsoft-com:office:excel">
           </AutoFilter>
     </Worksheet>
</Workbook>';


header('Content-Description: File Transfer');
header('Pragma: public');
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="' . $filename.'"');
header("Content-Transfer-Encoding:­ binary");
header("Content-Length: " . strlen($test));

echo $test;

exit();
