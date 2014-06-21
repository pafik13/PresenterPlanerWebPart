<?php
/* @var $this UserController */
if (isset($project)) {
    $this->breadcrumbs=array(
            $project->NAME=>array('/list/presenters','pr_id'=>$project->PROJECT_ID),
            'Отчет о посещениях ('.$medpred->getFIO().')',
    );
    $actionlink = '/index.php?r=user/report&mp_id='.$medpred->USER_ID.'&pr_id='.$project->PROJECT_ID; 
} else {
    $this->breadcrumbs=array(
            'Медпредставители'=>array('/list/presenters', 'pr_id'=>''),
            'Отчет о посещениях ('.$medpred->getFIO().')',
    );
    $actionlink = '/index.php?r=user/visitsreport&mp_id='.$medpred->USER_ID.'&pr_id=';
}
echo '<h1>Отчет о посещениях</h1>';
?>          


<div class="form">
    <?php echo '<form action="'.$actionlink.'" method="POST">'; ?>
        
        <div class="row">
                <?php echo '<label for="firstDate">Даты визитов: </label>'?>
		<?php echo 'c'?>
                <?php   if (isset($firstDate)) { $fdval = $firstDate; } else { $fdval = date('d.m.Y'); }
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                    'name'=>'firstDate',
                                    'value'=> $fdval,
                                    'language'=>'ru',
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                    ),
                                    'htmlOptions'=>array(
                                        'style'=>'height:16px;width:68px;text-align: center;'
                                    ),
                                ));  ?>

		<?php echo 'по '?>
		<?php   if (isset($lastDate)) { $ldval = $lastDate; } else { $ldval = date('d.m.Y'); }
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                    'name'=>'lastDate',
                                    'value'=> $ldval,
                                    'language'=>'ru',
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                    ),
                                    'htmlOptions'=>array(
                                        'style'=>'height:16px;width:68px;text-align: center;'
                                    ),
                                ));  ?>
	</div>
        
	<div class="row buttons">
            <input type="submit" name="rf" value="Переформировать" />
            <input type="submit" name="dl" value="Скачать" />
	</div>
        
    </form>';
</div> 


<?php
$rowno = 0;

print "\n<table>
   <tr>
     <th>№</th>
     <th>Название ЛПУ</th>
     <th>Фактический адрес ЛПУ</th>
     <th>ФИО врача</th>
     <th>Специальность</th>
     <th>Должность</th>
     <th>Дата визита</th>
   </tr>";

foreach ($data as $d) {
    $rowno = $rowno + 1;
    echo '<tr>'
             .'<td>'. $rowno .'</td>'
             .'<td>'. $d['NAME'] .'</td>'
             .'<td>'. $d['ADRESS'] .'</td>'
             .'<td>'. $d['SECOND_NAME'].' '.$d['FIRST_NAME'].' '.$d['THIRD_NAME']. '</td>'
             .'<td>'. $d['SPECIALITY']. '</td>'
             .'<td>'. $d['POSITION_']. '</td>'
             .'<td>'. date('d.m.Y', CDateTimeParser::parse($d['VISIT_DATE'], 'yyyy-MM-dd')). '</td>'
        .'</tr>';
}
print "\n</table>";
