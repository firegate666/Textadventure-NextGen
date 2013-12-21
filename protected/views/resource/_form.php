<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resource-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<?php e<?=>labelEx($model,'name'); ?>
		<?= $fo<?=eld($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?= $form->err<?='name'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($m<?=ription'); ?>
		<?= $form->textArea($model,'<?=n',array('rows'=>6, 'cols'=>50)); ?>
		<?= $form->error($model,'descriptio<?=/div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
