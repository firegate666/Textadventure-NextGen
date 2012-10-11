<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resource-production-form',
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
		<?php echo $form->labelEx($model,'islandId'); ?>
		<?php echo $form->textField($model,'islandId'); ?>
		<?php echo $form->error($model,'islandId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resourceId'); ?>
		<?php echo $form->textField($model,'resourceId'); ?>
		<?php echo $form->error($model,'resourceId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'growthFactor'); ?>
		<?php echo $form->textField($model,'growthFactor'); ?>
		<?php echo $form->error($model,'growthFactor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'productionValue'); ?>
		<?php echo $form->textField($model,'productionValue'); ?>
		<?php echo $form->error($model,'productionValue'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->