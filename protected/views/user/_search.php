<div class="wide form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method'=>'post',
	'htmlOptions' => array(
		'name' => 'userSearch'
	)
));
?>
	<?= CHtml::hiddenField('limit', $limit) ?>

	<div class="row">
		<?=$form->label($model, 'id'); ?>
		<?=$form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'username'); ?>
		<?=$form->textField($model, 'username',array('size' => 60, 'maxlength' => 128)); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'email'); ?>
		<?=$form->textField($model, 'email',array('size' => 60, 'maxlength' => 128)); ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'groupId'); ?>
		<?=$form->textField($model, 'groupId'); ?>
	</div>

	<div class="row buttons">
		<?=CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
