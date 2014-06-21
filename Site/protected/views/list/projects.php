<?php
/* @var $this ListController */
$this->pageTitle=Yii::app()->name . ' - Проекты';
$this->breadcrumbs=array(
	'Проекты',
);

echo '<ul class="list">';
foreach ($data as $pr) {
   echo '<li class="list"><a href="/index.php?r=list/presenters&pr_id='.$pr->PROJECT_ID.'">'.$pr->NAME.'</a> </li>';     
}
echo '</ul>';