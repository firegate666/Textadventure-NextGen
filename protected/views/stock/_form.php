<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stock-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'storageId'); ?>
		<?= $form->textField($model,'storageId'); ?>
		<?= $form->error($model,'storageId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'resourceId'); ?>
		<?= $form->textField($model,'resourceId'); ?>
		<?= $form->error($model,'resourceId'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
