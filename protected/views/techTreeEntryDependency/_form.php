<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tech-tree-entry-dependency-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'techId'); ?>
		<?= $form->textField($model,'techId'); ?>
		<?= $form->error($model,'techId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'dependencyId'); ?>
		<?= $form->textField($model,'dependencyId'); ?>
		<?= $form->error($model,'dependencyId'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
