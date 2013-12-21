<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resource-production-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?= $form->labelEx($model,'islandId'); ?>
		<?= $form->textField($model,'islandId'); ?>
		<?= $form->error($model,'islandId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'resourceId'); ?>
		<?= $form->textField($model,'resourceId'); ?>
		<?= $form->error($model,'resourceId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'growthFactor'); ?>
		<?= $form->textField($model,'growthFactor'); ?>
		<?= $form->error($model,'growthFactor'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'productionValue'); ?>
		<?= $form->textField($model,'productionValue'); ?>
		<?= $form->error($model,'productionValue'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
