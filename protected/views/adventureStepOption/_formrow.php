<?php
/** @var CActiveForm $form */
/** @var AdventureStep $parent */
/** @var integer $index */
/** @var AdventureStepOption $model */
$inputElementPrefix = '[' . $index . ']';
?><div class="form">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<?= $form->hiddenField($model, $inputElementPrefix . 'id') ?>
	<?= $form->hiddenField($model, $inputElementPrefix . 'parent') ?>

	<div class="row">
		<?=$form->labelEx($model,'target'); ?>
		<?=$form->dropDownList($model, $inputElementPrefix . 'target', $adventureStepList); ?>
		<?=$form->error($model,'target'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'name'); ?>
		<?=$form->textField($model, $inputElementPrefix . 'name',array('size'=>60,'maxlength'=>256)); ?>
		<?=$form->error($model,'name'); ?>
	</div>

</div><!-- form -->
