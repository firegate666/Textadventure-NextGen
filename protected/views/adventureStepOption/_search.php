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
		<?=$form->label($model,'parent'); ?>
		<?=$form->textField($model,'parent'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'target'); ?>
		<?=$form->textField($model,'target'); ?>
	</div>

	<div class="row">
		<?=$form->label($model,'name'); ?>
		<?=$form->textField($model,'name',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
