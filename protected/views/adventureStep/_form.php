<div class="form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'adventure-step-form',
	'enableAjaxValidation'=>false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<div class="row">
		<?=$form->labelEx($model,'adventure'); ?>
		<?=$form->dropDownList($model, 'adventure', $adventureList); ?>
		<?=$form->error($model,'adventure'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'name'); ?>
		<?=$form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
		<?=$form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'description'); ?>
		<?=$form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?=$form->error($model,'description'); ?>
		<div class="small">
			<i>(use <a href="http://daringfireball.net/projects/markdown/syntax">Markdown</a>-Syntax)</i>
		</div>

	</div>

	<div class="row">
		<?=$form->labelEx($model,'stepId'); ?>
		<?=$form->textField($model,'stepId',array('size'=>32,'maxlength'=>32)); ?>
		<?=$form->error($model,'stepId'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'startingPoint'); ?>
		<?=$form->checkBox($model,'startingPoint'); ?>
		<?=$form->error($model,'startingPoint'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'endingPoint'); ?>
		<?=$form->checkBox($model,'endingPoint'); ?>
		<?=$form->error($model,'endingPoint'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
