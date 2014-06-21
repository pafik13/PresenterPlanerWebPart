<?php

class ProcessDemonstration
{
    public function Process ($ufile) {
        $err = '';
        $eDemon = '';
        $eDdemo = '';
        $eDshow = '';
        if (isset($ufile)) {
            //$ret = TRUE;
//            $f_id = (int)$ufile->ID;
//            $imei =      $ufile->IMEI; 
            $hxml = simplexml_load_string($ufile->FILE);
            //echo $hxml->getName();
            if ($hxml->getName() === 'ArrayOfDemonstration') {
                $demonstratons = $hxml->children();
                foreach ($demonstratons as $d) {
                    $pos1 = strpos($d->visitTime,'T');
                    $pos2 = strpos($d->visitTime,'.');
                    $time = substr($d->visitTime, $pos1 + 1, $pos2 - $pos1 - 1);
                    //echo 'pos1 = '.$pos1.'  pos2 = '.$pos2.' time = '.$time.'</br>';
                    $newDemonstraton = new Demonstration();
                    $newDemonstraton->IMEI          =      $ufile->IMEI;
                    $newDemonstraton->DOCTOR_ID     = (int)$d->doctorID;
                    $newDemonstraton->VISIT_DATE    =      $d->visitDate;
                    $newDemonstraton->VISIT_TIME    =      $time;
                    $newDemonstraton->VISIT_ANALYZE =      $d->analyze;
                    $newDemonstraton->FILE_ID       = (int)$ufile->ID;
                    if ($newDemonstraton->validate()) {
                        try {
                            $newDemonstraton->save(false);
                            $eDemon = '';
                        } catch (CDbException $exc) {
                            $eDemon = $exc->getMessage();
                        }
                    } else {
                        $eDemon = ProcessDemonstration::MakeErrorsTextH($newDemonstraton);
                    }
                    
                    if ($eDemon === '') {
                        $d_demos = $d->demos->children();
                        foreach ($d_demos as $d_d) {
                            $newDDemo = new DDemo();
                            $newDDemo->SLIDE_KEY        = $d_d->slideKey;
                            $newDDemo->DEMONSTRATION_ID = $newDemonstraton->DEMONSTRATION_ID;
                            if ($newDDemo->validate()) {
                                try {
                                    $newDDemo->save(false);
                                    $eDdemo = '';
                                } catch (CDbException $exc) {
                                    $eDdemo = $exc->getMessage();
                                }
                            } else {
                                $eDdemo = ProcessDemonstration::MakeErrorsTextH($newDDemo);
                            } 
                            
                            if ($eDdemo === '') {
                                $d_shows = $d_d->shows->children();
                                foreach ($d_shows as $d_s) {
                                    $newDShow = new DShow();
                                    $newDShow->NUMBER     =   (int)$d_s->number;
                                    $newDShow->TIME       = (float)$d_s->time;
                                    $newDShow->LONGTITUDE = (float)$d_s->coord->longtitude;
                                    $newDShow->LATITUDE   = (float)$d_s->coord->latitude;
                                    $newDShow->DEMO_ID    =        $newDDemo->DEMO_ID;
                                    if ($newDShow->validate()) {
                                        try {
                                            $newDShow->save(false);
                                            $eDshow = '';
                                        } catch (CDbException $exc) {
                                            $eDshow = $exc->getMessage();
                                        }
                                    } else {
                                        $eDshow = ProcessDemonstration::MakeErrorsTextH($newDShow);
                                    }
                                    
                                    if ($eDdemo!=='') {
                                        $err = $err . "\n\n[DShow] : " . $eDshow;
                                    }
                                }
                            } else {
                                $err = $err . "\n\n[DDemo] : " . $eDdemo;
                            }
                        }
                    } else {
                        $err = $err . '[DEMONSTRATION] : ' . $eDemon;
                    }
                }
            } else {
                $err = 'Файл не соответствует типу [ArrayOfDemonstration]';
            }
            return $err;
        }
        return 'HospitalDB FILE NOT FOUND';
    }

    function TryToSave ($model) {
        if ($model->validate()) {
            try {
                $model->save(false); $err = '';
            } catch (CDbException $exc) {
                $err = $exc->getMessage();
            }
        } else {
            $err = ProcessDemonstration::MakeErrorsTextH($model);
        }
        return $err;
    }
    
    
    function MakeErrorsTextH ($model) {
        $errors = $model->getErrors();
        $colon_separated = array();
        foreach ($errors as $key => $value) {
            foreach ($value as $k => $v) {
                $colon_separated[] = "$key: [$k = $v]";
            }
        }
        $result = "{DOCTOR_ID = ".$model->DOCTOR_ID."}\n";
        $result = $result.implode("\n", $colon_separated);
        $result = $result."\n\n";
        return $result;  
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

