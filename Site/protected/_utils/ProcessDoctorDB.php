<?php

class ProcessDoctorDB
{
    public function Process ($ufile) {
        $err = '';
        if (isset($ufile)) {
            //$ret = TRUE;
            $f_id = (int)$ufile->ID;
            $imei =      $ufile->IMEI; 
            $hxml = simplexml_load_string($ufile->FILE);
            //echo $hxml->getName();
            if ($hxml->getName() === 'ArrayOfDoctor') {
                $doctors = $hxml->children();
                foreach ($doctors as $d) {
                    $err = $err.ProcessDoctorDB::SaveDoctor($f_id, $imei, $d);
                }
            } else {
                $err = 'Файл не соответствует типу';
            }
            return $err;
        }
        return 'HospitalDB FILE NOT FOUND';
    }

    function SaveDoctor($f_id, $imei, $xmldoctor) {
        $newDoctor = Doctor::model()->find(array('condition' => 'IMEI = :i'
                                                             . ' AND DOCTOR_ID = :d_id', 
                                                         'params' => array('i' => $imei,
                                                                        'd_id' => $xmldoctor->ID
                                                                           )
                                                 )
                                           );
        if (!isset($newDoctor)) {
            $newDoctor = new Doctor();
            $newDoctor->IMEI      =      $imei;
            $newDoctor->DOCTOR_ID = (int)$xmldoctor->ID;
        }
            $newDoctor->SNCHAR      =      $xmldoctor->SNChar;
            $newDoctor->SECOND_NAME =      $xmldoctor->SecondName;
            $newDoctor->FIRST_NAME  =      $xmldoctor->FirstName;
            $newDoctor->THIRD_NAME  =      $xmldoctor->ThirdName;
            $newDoctor->HOSPITAL_ID = (int)$xmldoctor->HospitalID;
            $newDoctor->TEL         =      $xmldoctor->Tel;
            $newDoctor->EMAIL       =      $xmldoctor->Email;
            $newDoctor->POSITION_   =      $xmldoctor->Position;
            $newDoctor->SPECIALITY  =      $xmldoctor->Speciality;
            $newDoctor->FILE_ID     =      $f_id;
            if ($newDoctor->validate()) {
                try {
                    $newDoctor->save(false);
                    $result = '';
                } catch (CDbException $exc) {
                    $result = $exc->getMessage();
                }
            } else {
                $result = ProcessDoctorDB::MakeErrorsTextH($newDoctor);
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
        $result = "{DOCTOR_ID = ".$model->DOCTOR_ID."\n";
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

