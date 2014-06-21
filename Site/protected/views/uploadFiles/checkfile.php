<?php
/* @var $this UploadFilesController */
/* @var $model UploadFiles */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'upload-files-checkfile-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'IMEI'); ?>
		<?php echo $form->textField($model,'IMEI'); ?>
		<?php echo $form->error($model,'IMEI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TYPE'); ?>
		<?php echo $form->textField($model,'TYPE'); ?>
		<?php echo $form->error($model,'TYPE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HASH'); ?>
		<?php echo $form->textField($model,'HASH'); ?>
		<?php echo $form->error($model,'HASH'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->