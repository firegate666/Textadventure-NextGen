<div class="wide form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));
?>

	<div class="row">
		<?=$form->label($model,'id'); ?>
		<?=$form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'adventure'); ?>
		<?=$form->textField($model,'adventure'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'name'); ?>
		<?=$form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'description'); ?>
		<?=$form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'stepId'); ?>
		<?=$form->textField($model,'stepId',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'startingPoint'); ?>
		<?=$form->checkBox($model,'startingPoint'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'endingPoint'); ?>
		<?=$form->checkBox($model,'endingPoint'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
