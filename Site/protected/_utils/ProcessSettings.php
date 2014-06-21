<?php

class ProcessSettings
{
    public function Process ($ufile) {
        $err = '';
        if (isset($ufile)) {
            //$ret = TRUE;
            $f_id = (int)$ufile->ID;
            $imei =      $ufile->IMEI; 
            $hxml = simplexml_load_string($ufile->FILE);
            //echo $hxml->getName();
            if ($hxml->getName() === 'Setts') {
                Setts::model()->deleteAll('IMEI = '.$imei);
                $err = $err.ProcessSettings::SaveSettings($f_id, $imei, $hxml);
            } else {
                $err = 'Файл не соответствует типу';
            }
            return $err;
        }
        return 'Setts FILE NOT FOUND';
    }

    function SaveSettings($f_id, $imei, $settings) {
            $newSettings = new Setts();
            $newSettings->IMEI              = $imei;
            $newSettings->FILE_ID           = (int)$f_id;
            $newSettings->WEEK_OF_START     = (int)$settings->weekOfStart;
            $newSettings->DL_SITE           = $settings->dlSite;
            $newSettings->PACKAGE_NAME      = $settings->packageName;
            $newSettings->PHONE             = $settings->phone;
            $newSettings->VERSION_FILE_NAME = $settings->versionFileName;
            if ($newSettings->validate()) {
                try {
                    $newSettings->save(false);
                    $result = '';
                } catch (CDbException $exc) {
                    $result = $exc->getMessage();
                }
            } else {
                $result = ProcessSettings::MakeErrorsTextH($newSettings);
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
        $result = $result.implode("\n", $colon_separated);
        $result = $result."\n}\n";
        return $result;  
    }
}
