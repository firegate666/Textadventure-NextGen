<div class="form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-group-form',
	'enableAjaxValidation'=>false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name'); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'isAdmin'); ?>
		<?php echo $form->checkBox($model, 'isAdmin'); ?>
		<?php echo $form->error($model, 'isAdmin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'defaultRegisterGroup'); ?>
		<?php echo $form->checkBox($model, 'defaultRegisterGroup'); ?>
		<?php echo $form->error($model, 'defaultRegisterGroup'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
