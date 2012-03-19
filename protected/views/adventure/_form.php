<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'adventure-form',
	'enableAjaxValidation' => false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name',array('size' => 60, 'maxlength' => 256)); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description',array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'adventureId'); ?>
		<?php echo $form->textField($model, 'adventureId',array('size' => 32,'maxlength' => 32)); ?>
		<?php echo $form->error($model, 'adventureId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'state'); ?>
		<?php echo $form->dropDownList($model, 'state', Adventure::validStates()); ?>
		<?php echo $form->error($model, 'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'startDate'); ?>
		<?php echo $form->textField($model, 'startDate',array('size' => 12,'maxlength' => 10)); ?>
		<?php echo $form->error($model, 'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'stopDate'); ?>
		<?php echo $form->textField($model, 'stopDate',array('size' => 12,'maxlength' => 10)); ?>
		<?php echo $form->error($model, 'stopDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
