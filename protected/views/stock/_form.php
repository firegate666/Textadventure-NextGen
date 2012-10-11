<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stock-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'storageId'); ?>
		<?php echo $form->textField($model,'storageId'); ?>
		<?php echo $form->error($model,'storageId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resourceId'); ?>
		<?php echo $form->textField($model,'resourceId'); ?>
		<?php echo $form->error($model,'resourceId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->