<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'map-section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'createdAt'); ?>
		<?php echo $form->textField($model,'createdAt'); ?>
		<?php echo $form->error($model,'createdAt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'changedAt'); ?>
		<?php echo $form->textField($model,'changedAt'); ?>
		<?php echo $form->error($model,'changedAt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdBy'); ?>
		<?php echo $form->textField($model,'createdBy'); ?>
		<?php echo $form->error($model,'createdBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'changedBy'); ?>
		<?php echo $form->textField($model,'changedBy'); ?>
		<?php echo $form->error($model,'changedBy'); ?>
	</div>

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