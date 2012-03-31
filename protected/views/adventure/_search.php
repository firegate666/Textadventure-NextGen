<div class="wide form">

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
));
?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'name'); ?>
		<?php echo $form->textField($model, 'name',array('size' => 60, 'maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description',array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'adventureId'); ?>
		<?php echo $form->textField($model, 'adventureId',array('size' => 32, 'maxlength' => 32)); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model, 'state'); ?>
		<?php echo $form->dropDownList($model, 'state', Adventure::validStates()); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'startDate'); ?>
		<?php echo $form->textField($model, 'startDate',array('size' => 12,'maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'stopDate'); ?>
		<?php echo $form->textField($model, 'stopDate',array('size' => 12,'maxlength' => 10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
