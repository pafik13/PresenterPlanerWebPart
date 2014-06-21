<?php

define('EXCEL_REPORTS_PATH', 'protected/_reports/excel');

class UserController extends Controller
{
	public function actionList(){
            $this->render('list');
	}
        
        public function actionProfile($mp_id, $pr_id) {
            if (isset($pr_id)) {
                $project = Project::model()->findByPk($pr_id);
            }
            $medpred = User::model()->findByPk($mp_id);
            $this->render('profile', array('medpred'=>$medpred, 'project'=>$project));
        }

        public function actionVisitsReport($mp_id, $pr_id)
	{
            if (isset($pr_id)) {
                $project = Project::model()->findByPk($pr_id);
            }
            $medpred = User::model()->findByPk($mp_id);
            $firstDate = filter_input(INPUT_POST, 'firstDate');
            if (!isset($firstDate)) {
                $f_Date = date('Y-m-d');
            } else {
                $f_Date = date('Y-m-d', CDateTimeParser::parse($firstDate, 'dd.MM.yyyy'));
            }
            
            $lastDate = filter_input(INPUT_POST, 'lastDate');
            if (!isset($lastDate)) {
                $l_Date = date('Y-m-d');
            } else {
                $l_Date = date('Y-m-d', CDateTimeParser::parse($lastDate, 'dd.MM.yyyy'));
            }
//            $sql = 'CALL one.REPORT(:imei, :f_date, :l_date)';
            $sql = $this->getSQL();
            $command=Yii::app()->db->createCommand($sql);
            $command->bindParam(":imei", $medpred->IMEI, PDO::PARAM_STR);
            $command->bindParam(":f_date", $f_Date, PDO::PARAM_STR);
            $command->bindParam(":l_date", $l_Date, PDO::PARAM_STR);
            $dataReader = $command->queryAll();
            if (isset($_POST['dl'])) {
                $manager = User::model()->findByPk(Yii::app()->user->getID());
                $this->generateReport($dataReader, $manager, $medpred, $firstDate, $lastDate);
            } else {
                $this->render('report', array('data'      => $dataReader, 
                                              'medpred'   => $medpred, 
                                              'firstDate' => $firstDate, 
                                              'lastDate'  => $lastDate, 
                                              'project'   => $project));
            }
	}
        
        public function actionVisitsList($mp_id) {
            $m = User::model()->findByPk(Yii::app()->user->getId());
            $medpred = User::model()->findByPk($mp_id);
            $imei = $medpred->IMEI;
            require EXCEL_REPORTS_PATH.'/visit/list.php';            
        }
        
        function generateReport($data, $m, $mp, $f_d, $l_d) {
            require EXCEL_REPORTS_PATH.'/visit/report.php';
            //spl_autoload_register(array('YiiBase','autoload'));            
        }
        
        public function actionRout($mp_id) {
            $manager = User::model()->findByPk(Yii::app()->user->getId());
            $medpred = User::model()->findByPk($mp_id);
            //echo $manager->getFIO();
            //echo $medpred->getFIO();
            require EXCEL_REPORTS_PATH.'/rout/rout.php';
//            require 'newEmptyPHP.php';
        }
        
        function getSQL () {
            $sql = 'SELECT 
                        dem.DEMONSTRATION_ID,
                        dem.IMEI,
                        dem.DOCTOR_ID,
                        dem.VISIT_DATE,
                        dem.VISIT_TIME,
                        dem.VISIT_ANALYZE,
                        dem.INSERT_TIME,
                        dem.FILE_ID,
                        d.IMEI,
                        d.DOCTOR_ID,
                        d.SNCHAR,
                        d.SECOND_NAME,
                        d.FIRST_NAME,
                        d.THIRD_NAME,
                        d.HOSPITAL_ID,
                        d.TEL,
                        d.EMAIL,
                        d.POSITION_,
                        d.SPECIALITY,
                        d.FILE_ID,
                        h.IMEI,
                        h.HOSPITAL_ID,
                        h.NAME,
                        h.ADRESS,
                        h.NEAREST_METRO,
                        h.REG_PHONE,
                        h.FILE_ID, 
                        WEEKOFYEAR(dem.VISIT_DATE) AS WEEKNUM,
                        (SELECT IFNULL(ROUND(SUM(ds.TIME)/60,1), 0) 
                           FROM {{d_demo}} dd LEFT JOIN {{d_show}} ds ON dd.DEMO_ID = ds.DEMO_ID
                          WHERE dd.DEMONSTRATION_ID = dem.DEMONSTRATION_ID 
                            AND ds.TIME > 5) AS DURATION
                      FROM {{demonstration}} dem
                      LEFT JOIN {{doctor}} d USING (IMEI, DOCTOR_ID)
                      LEFT JOIN {{hospital}} h USING (IMEI, HOSPITAL_ID)
                     WHERE dem.IMEI = :imei
                       AND dem.VISIT_DATE BETWEEN :f_date AND :l_date
                     ORDER BY dem.VISIT_DATE, dem.VISIT_TIME, h.NAME, d.SECOND_NAME';
            return $sql;
        }
        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}