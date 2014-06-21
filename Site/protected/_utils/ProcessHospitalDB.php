<?php

class ProcessHospitalDB
{
    public function Process ($ufile) {
        $err = '';
        if (isset($ufile)) {
            //$ret = TRUE;
            $f_id = (int)$ufile->ID;
            $imei =      $ufile->IMEI; 
            $hxml = simplexml_load_string($ufile->FILE);
            //echo $hxml->getName();
            if ($hxml->getName() === 'ArrayOfHospital') {
    //            echo $imei.'<hr/>';
    //            echo 'c1 ='.HPlannerItem::model()->count('imei = '.$imei)."<hr/>";
                HPlannerItem::model()->deleteAll('IMEI = '.$imei);
    //            echo 'c1 ='.HPlannerItem::model()->count('imei = '.$imei)."<hr/>";
                $hospitals = $hxml->children();
                foreach ($hospitals as $h) {
                    $err = $err.ProcessHospitalDB::SaveHospital($f_id, $imei, $h);

                    $plannerItems = $h->planners->children();
                    foreach ($plannerItems as $pI) {
                        $err = $err.ProcessHospitalDB::SaveHPlannerItem($f_id, $imei, $h->ID, $pI); 
                    }
                }
            } else {
                $err = 'Файл не соответствует типу';
            }
            return $err;
        }
        return 'HospitalDB FILE NOT FOUND';
    }

    function SaveHospital($f_id, $imei, $xmlhospital) {
        $newHospital = Hospital::model()->find(array('condition' => 'IMEI = :i'
                                                             . ' AND HOSPITAL_ID = :h_id', 
                                                         'params' => array('i' => $imei,
                                                                        'h_id' => $xmlhospital->ID
                                                                           )
                                                     )
                                               );
        if (!isset($newHospital)) {
            $newHospital = new Hospital();
            $newHospital->IMEI        =      $imei;
            $newHospital->HOSPITAL_ID = (int)$xmlhospital->ID;
        }
            $newHospital->NAME          = $xmlhospital->Name;
            $newHospital->ADRESS        = $xmlhospital->Adress;
            $newHospital->NEAREST_METRO = $xmlhospital->NearestMetro;
            $newHospital->REG_PHONE     = $xmlhospital->RegPhone;
            $newHospital->FILE_ID = $f_id;
            if ($newHospital->validate()) {
                try {
                    $newHospital->save(false);
                    $result = '';
                } catch (CDbException $exc) {
                    $result = $exc->getMessage();
                }
            } else {
                $result = ProcessHospitalDB::MakeErrorsTextH($newHospital);
            }
            return $result;
        }
        
    function SaveHPlannerItem($f_id, $imei, $hospital_id, $xmlhpitem) {
        $newHPItem = new HPlannerItem();
        $newHPItem->IMEI        =      $imei;
        $newHPItem->HOSPITAL_ID = (int)$hospital_id;
        $newHPItem->WEEKNUM     = (int)$xmlhpitem->weekNum;
        $newHPItem->DAY_OF_WEEK =    $xmlhpitem->dayOfWeek;
        $newHPItem->FILE_ID     = $f_id;
        if ($newHPItem->validate()) {
            try {
                $newHPItem->save(false);
                $result = '';
            } catch (CDbException $exc) {
                $result = $exc->getMessage();
            }
        } else {
            $result = ProcessHospitalDB::MakeErrorsTextH($newHPItem);
        }
        return $result;
    }

    function MakeErrorsTextH ($model) {
        $errors = $model->getErrors();
        $colon_separated = array();
        foreach ($errors as $key => $value) {
            foreach ($value as $k => $v) {
                $colon_separated[] = "$key: [$k = $v]";
            }
        }
        $result = "{HOSPITAL_ID = ".$model->HOSPITAL_ID."\n";
        $result = $result.implode("\n", $colon_separated);
        $result = $result."\n}\n";
        return $result;  
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

