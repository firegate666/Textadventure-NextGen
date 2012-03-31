<div class="form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-group-form',
	'enableAjaxValidation'=>false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<div class="row">
		<?=$form->labelEx($model, 'name'); ?>
		<?=$form->textField($model, 'name'); ?>
		<?=$form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'isAdmin'); ?>
		<?=$form->checkBox($model, 'isAdmin'); ?>
		<?=$form->error($model, 'isAdmin'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'defaultRegisterGroup'); ?>
		<?=$form->checkBox($model, 'defaultRegisterGroup'); ?>
		<?=$form->error($model, 'defaultRegisterGroup'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
