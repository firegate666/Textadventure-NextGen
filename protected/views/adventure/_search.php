<div class="wide form">

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'post',
	'htmlOptions' => array(
		'name' => 'adventureSearch'
	)
));
?>

	<?= CHtml::hiddenField('limit', $limit) ?>

	<div class="row">
		<?=$form->label($model, 'id'); ?>
		<?=$form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'name'); ?>
		<?=$form->textField($model, 'name',array('size' => 60, 'maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'description'); ?>
		<?=$form->textArea($model, 'description',array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'adventureId'); ?>
		<?=$form->textField($model, 'adventureId',array('size' => 32, 'maxlength' => 32)); ?>
	</div>


	<div class="row">
		<?=$form->labelEx($model, 'state'); ?>
		<?=$form->dropDownList($model, 'state', Adventure::validStates()); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'startDate'); ?>
		<?=$form->textField($model, 'startDate',array('size' => 12,'maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'stopDate'); ?>
		<?=$form->textField($model, 'stopDate',array('size' => 12,'maxlength' => 10)); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
