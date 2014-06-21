<?php
/* @var $this ListController */
$this->pageTitle=Yii::app()->name . ' - Доступные списки';
if (Yii::app()->user->isGuest) {
    $this->redirect('index.php?r=site/login');
}

//echo 'Login:'.Yii::app()->user->login;
 
echo '<ul class="list">';
   echo '<li class="list"><a href="/index.php?r=list/projects">'.'Проекты'.'</a></li>';     
   echo '<li class="list"><a href="/index.php?r=list/presenters&pr_id">'.'Медпредставители'.'</a></li>'; 
echo '</ul>';  