<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'map-section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'leftSectionId'); ?>
		<?= $form->textField($model,'leftSectionId'); ?>
		<?= $form->error($model,'leftSectionId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'rightSectionId'); ?>
		<?= $form->textField($model,'rightSectionId'); ?>
		<?= $form->error($model,'rightSectionId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'worldId'); ?>
		<?= $form->textField($model,'worldId'); ?>
		<?= $form->error($model,'worldId'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
