<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tech-tree-entry-form',
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
		<?= $form->labelEx($model,'description'); ?>
		<?= $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?= $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'costs'); ?>
		<?= $form->textField($model,'costs'); ?>
		<?= $form->error($model,'costs'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'categoryId'); ?>
		<?= $form->textField($model,'categoryId'); ?>
		<?= $form->error($model,'categoryId'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'typeId'); ?>
		<?= $form->textField($model,'typeId'); ?>
		<?= $form->error($model,'typeId'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
