<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	//'User'=>array('/user'),
	//'List',
    'Список медпредставителей',
);
?>
<h1><?php echo 'Список медпредставителей'/*$this->id . '/' . $this->action->id;*/ ?></h1>



<?php echo 'Login:'.Yii::app()->user->login; 

$m_id = Yii::app()->user->getId();

$mpreds = User::model()->findAll('MANAGER_ID = :id', array('id'=>$m_id));
echo '<ul>';
foreach ($mpreds as $mp) {
   echo '<li><a href="/index.php?r=user/profile&mp_id='.$mp->USER_ID.'">'.$mp->getFIO().'</a> </li>';     
}
echo '</ul>';

 
