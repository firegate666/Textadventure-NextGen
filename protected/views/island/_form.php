<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'island-form',
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
		<?= $form->labelEx($model,'size'); ?>
		<?= $form->textField($model,'size'); ?>
		<?= $form->error($model,'size'); ?>
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
		<?= $form->labelEx($model,'archipelagoId'); ?>
		<?= $form->textField($model,'archipelagoId'); ?>
		<?= $form->error($model,'archipelagoId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'ownerId'); ?>
		<?= $form->textField($model,'ownerId'); ?>
		<?= $form->error($model,'ownerId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'storageId'); ?>
		<?= $form->textField($model,'storageId'); ?>
		<?= $form->error($model,'storageId'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
