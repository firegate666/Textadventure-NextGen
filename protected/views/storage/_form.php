<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'storage-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'capacity'); ?>
		<?= $form->textField($model,'capacity'); ?>
		<?= $form->error($model,'capacity'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
