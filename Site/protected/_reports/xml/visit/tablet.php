<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo '<?xml version="1.0" encoding="utf-8"?>'; echo "\n";
echo '<ArrayOfReport xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">'; echo "\n";
$currDocID = -1;
$isopen = false;
foreach ($dataReader as $value) {
    if ($currDocID != $value['DOCTOR_ID']) {
        if ($isopen) {
            echo '    </rItems>'; echo "\n";
            echo '    </Report>';echo "\n";
            echo '  <Report>';echo "\n";
            echo '    <doctorID>'.$value['DOCTOR_ID'].'</doctorID>'; echo "\n";
            echo '    <rItems>'; echo "\n";
        } else {
            echo '  <Report>'; echo "\n";
            echo '    <doctorID>'.$value['DOCTOR_ID'].'</doctorID>'; echo "\n";
            echo '    <rItems>'; echo "\n";
            $isopen = true;
        }
        $currDocID = $value['DOCTOR_ID'];
    }
    echo '      <ReportItem>'; echo "\n";
    echo '        <weekNum>'.$value['WEEK'].'</weekNum>'; echo "\n";
    echo '        <visitCount>'.$value['CNT'].'</visitCount>'; echo "\n";
    echo '      </ReportItem>'; echo "\n";
}
echo '    </rItems>'; echo "\n";
echo '    </Report>';echo "\n";
echo '</ArrayOfReport>'; echo "\n";

