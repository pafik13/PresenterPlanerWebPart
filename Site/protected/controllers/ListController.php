<?php

class ListController extends Controller
{
	public function actionLists()
	{
		$this->render('lists');
	}

	public function actionPresenters()
	{
            $pr_id = filter_input(INPUT_GET, 'pr_id');
            if (isset($pr_id) and $pr_id != '') {
                $project = Project::model()->findByPk($pr_id);
//                $sql = 'CALL one.PRESENTERS(:pr_id)';
                $sql = '  SELECT ou.*
                            FROM cross_project_user crossPU
                            LEFT JOIN {{user}} ou USING (USER_ID)
                           WHERE crossPU.PROJECT_ID = :pr_id
                             AND ou.MANAGER_ID <> 0;';
                $mpreds = User::model()->findAllBySql($sql, array('pr_id'=>$pr_id));
            } else {
                $m_id = Yii::app()->user->getId();
                $mpreds = User::model()->findAll('MANAGER_ID = :m_id', array('m_id'=>$m_id));
            }
            $this->render('presenters', array('data'=>$mpreds, 'project'=>$project));
	}

	public function actionProjects()
	{
            
//            $sql = 'CALL one.PROJECTS(:m_id)';
            $sql = '  SELECT op.*
                        FROM cross_project_user crossPU
                        LEFT JOIN {{project}} op USING (PROJECT_ID)
                       WHERE crossPU.USER_ID = :m_id;';
            $m_id = Yii::app()->user->getId();
            $projects = Project::model()->findAllBySql($sql, array('m_id'=>$m_id));
            $this->render('projects', array('data'=>$projects));
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