<div class="form">

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'adventure-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<div class="row">
		<?=$form->labelEx($model, 'name'); ?>
		<?=$form->textField($model, 'name',array('size' => 60, 'maxlength' => 256)); ?>
		<?=$form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'description'); ?>
		<?=$form->textArea($model, 'description',array('rows' => 6, 'cols' => 50)); ?>
		<?=$form->error($model, 'description'); ?>
		<div class="small">
			<i>(use <a href="http://daringfireball.net/projects/markdown/syntax">Markdown</a>-Syntax)</i>
		</div>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'adventureId'); ?>
		<?=$form->textField($model, 'adventureId',array('size' => 32,'maxlength' => 32)); ?>
		<?=$form->error($model, 'adventureId'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'state'); ?>
		<?=$form->dropDownList($model, 'state', Adventure::validStates()); ?>
		(set to "Published"	if you want to play it)
		<?=$form->error($model, 'state'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'startDate'); ?>
		<?=$form->textField($model, 'startDate',array('size' => 12,'maxlength' => 10)); ?>
		(z.B. <?=date('Y-m-d')?>)
		<?=$form->error($model, 'startDate'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'stopDate'); ?>
		<?=$form->textField($model, 'stopDate',array('size' => 12,'maxlength' => 10)); ?>
		(z.B. <?=date('Y-m-d', time() + 60*60*24)?>)
		<?=$form->error($model, 'stopDate'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
