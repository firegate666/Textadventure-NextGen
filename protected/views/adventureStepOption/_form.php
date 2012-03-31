<div class="form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'adventure-step-option-form',
	'enableAjaxValidation'=>false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<div class="row">
		<?=$form->labelEx($model,'parent'); ?>
		<?=$form->dropDownList($model, 'parent', $adventureStepList); ?>
		<?=$form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'target'); ?>
		<?=$form->dropDownList($model, 'target', $adventureStepList); ?>
		<?=$form->error($model,'target'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'name'); ?>
		<?=$form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
		<?=$form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
