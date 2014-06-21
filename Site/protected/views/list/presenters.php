<?php
/* @var $this ListController */

//header
if(isset($project)) {
    $this->breadcrumbs=array(
        'Проекты'=>array('list/projects'),
	'Медпредставители',
    );
    echo "<h1>";
    echo 'Проект "'.$project->NAME.'"'; 
    echo "</h1>\n";

} else {
    $this->breadcrumbs=array(
            'Медпредставители',
    );
    echo "<h1>";
    echo 'Все медицинские представители'; 
    echo "</h1>\n";    
}

//content
echo '<ul class="list">';
foreach ($data as $mp) {
   echo '<li class="list"><a href="/index.php?r=user/profile&mp_id='.$mp->USER_ID.'&pr_id='.$project->PROJECT_ID.'">'.$mp->getFIO().'</a> </li>';     
}
echo '</ul>';
