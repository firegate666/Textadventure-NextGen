<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'map-section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'leftSectionId'); ?>
		<?php echo $form->textField($model,'leftSectionId'); ?>
		<?php echo $form->error($model,'leftSectionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rightSectionId'); ?>
		<?php echo $form->textField($model,'rightSectionId'); ?>
		<?php echo $form->error($model,'rightSectionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'worldId'); ?>
		<?php echo $form->textField($model,'worldId'); ?>
		<?php echo $form->error($model,'worldId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->