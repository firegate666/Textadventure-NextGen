<div class="wide form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));
?>

	<div class="row">
		<?=$form->label($model, 'id'); ?>
		<?=$form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'name'); ?>
		<?=$form->textField($model, 'name'); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'isAdmin'); ?>
		<?=$form->checkBox($model, 'isAdmin'); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'defaultRegisterGroup'); ?>
		<?=$form->checkBox($model, 'defaultRegisterGroup'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
