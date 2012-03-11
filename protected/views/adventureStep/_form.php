<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'adventure-step-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'adventure'); ?>
		<?php echo $form->textField($model,'adventure'); ?>
		<?php echo $form->error($model,'adventure'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'stepId'); ?>
		<?php echo $form->textField($model,'stepId',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'stepId'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'startingPoint'); ?>
		<?php echo $form->checkBox($model,'startingPoint'); ?>
		<?php echo $form->error($model,'startingPoint'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
