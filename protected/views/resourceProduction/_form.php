<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resource-production-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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