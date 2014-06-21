<?php
/* @var $this UserController */

if (isset($project)) {
    $this->breadcrumbs=array(
            $project->NAME=>array('/list/presenters','pr_id'=>$project->PROJECT_ID),
            $medpred->getFIO(),
    );
} else {
    $this->breadcrumbs=array(
            'Медпредставители'=>array('/list/presenters', 'pr_id'=>''),
            $medpred->getFIO(),
    );
}
?>

<h1><?php echo $medpred->getFIO(); ?></h1>

<?php 
echo '<ul>';
   echo '<li><a href="/index.php?r=user/visitsreport&mp_id='.$medpred->USER_ID.'&pr_id='.$project->PROJECT_ID.'">Отчет о посещениях</a> </li>';     
   echo '<li><a href="/index.php?r=user/visitslist&mp_id='.$medpred->USER_ID.'">Лист посещений</a> </li>'; 
   echo '<li><a href="/index.php?r=user/rout&mp_id='.$medpred->USER_ID.'">Маршрутный лист на след. неделю</a> </li>'; 
echo '</ul>';

 
