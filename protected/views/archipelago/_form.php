<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'archipelago-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'name'); ?>
		<?= $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?= $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'xPos'); ?>
		<?= $form->textField($model,'xPos'); ?>
		<?= $form->error($model,'xPos'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'yPos'); ?>
		<?= $form->textField($model,'yPos'); ?>
		<?= $form->error($model,'yPos'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'magnitude'); ?>
		<?= $form->textField($model,'magnitude'); ?>
		<?= $form->error($model,'magnitude'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'mapSectionId'); ?>
		<?= $form->textField($model,'mapSectionId'); ?>
		<?= $form->error($model,'mapSectionId'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
