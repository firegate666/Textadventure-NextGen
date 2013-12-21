<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tech-tree-entry-research-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'userId'); ?>
		<?= $form->textField($model,'userId'); ?>
		<?= $form->error($model,'userId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'techId'); ?>
		<?= $form->textField($model,'techId'); ?>
		<?= $form->error($model,'techId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'start'); ?>
		<?= $form->textField($model,'start'); ?>
		<?= $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'end'); ?>
		<?= $form->textField($model,'end'); ?>
		<?= $form->error($model,'end'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'finished'); ?>
		<?= $form->textField($model,'finished'); ?>
		<?= $form->error($model,'finished'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
