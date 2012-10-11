<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'archipelago-form',
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'xPos'); ?>
		<?php echo $form->textField($model,'xPos'); ?>
		<?php echo $form->error($model,'xPos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'yPos'); ?>
		<?php echo $form->textField($model,'yPos'); ?>
		<?php echo $form->error($model,'yPos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'magnitude'); ?>
		<?php echo $form->textField($model,'magnitude'); ?>
		<?php echo $form->error($model,'magnitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mapSectionId'); ?>
		<?php echo $form->textField($model,'mapSectionId'); ?>
		<?php echo $form->error($model,'mapSectionId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->