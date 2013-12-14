<?php
/** @var CActiveForm $form */
/** @var Adventure $parent */
/** @var integer $index */
$inputElementPrefix = '[' . $index . ']';
?>
<div class="form">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<?= $form->hiddenField($model, $inputElementPrefix . 'id') ?>
	<?= $form->hiddenField($model, $inputElementPrefix . 'adventure') ?>

	<div class="row">
		<?=$form->labelEx($model,'name'); ?>
		<?=$form->textField($model,$inputElementPrefix . 'name',array('size'=>60,'maxlength'=>256)); ?>
		<?=$form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'description'); ?>
		<?=$form->textArea($model,$inputElementPrefix . 'description',array('rows'=>6, 'cols'=>50)); ?>
		<?=$form->error($model,'description'); ?>
		<div class="small">
			<i>(use <a href="http://daringfireball.net/projects/markdown/syntax">Markdown</a>-Syntax)</i>
		</div>

	</div>

	<div class="row">
		<?=$form->labelEx($model,'stepId'); ?>
		<?=$form->textField($model,$inputElementPrefix . 'stepId',array('size'=>32,'maxlength'=>32)); ?>
		<?=$form->error($model,'stepId'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'startingPoint'); ?>
		<?=$form->checkBox($model,$inputElementPrefix . 'startingPoint'); ?>
		<?=$form->error($model,'startingPoint'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'endingPoint'); ?>
		<?=$form->checkBox($model,$inputElementPrefix . 'endingPoint'); ?>
		<?=$form->error($model,'endingPoint'); ?>
	</div>

</div><!-- form -->
