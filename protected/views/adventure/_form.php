<div class="form">

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'adventure-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<div class="row">
		<?=$form->labelEx($model, 'name'); ?>
		<?=$form->textField($model, 'name',array('size' => 60, 'maxlength' => 256)); ?>
		<?=$form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'description'); ?>
		<?=$form->textArea($model, 'description',array('rows' => 6, 'cols' => 50)); ?>
		<?=$form->error($model, 'description'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'adventureId'); ?>
		<?=$form->textField($model, 'adventureId',array('size' => 32,'maxlength' => 32)); ?>
		<?=$form->error($model, 'adventureId'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'state'); ?>
		<?=$form->dropDownList($model, 'state', Adventure::validStates()); ?>
		<?=$form->error($model, 'state'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'startDate'); ?>
		<?=$form->textField($model, 'startDate',array('size' => 12,'maxlength' => 10)); ?>
		<?=$form->error($model, 'startDate'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'stopDate'); ?>
		<?=$form->textField($model, 'stopDate',array('size' => 12,'maxlength' => 10)); ?>
		<?=$form->error($model, 'stopDate'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
