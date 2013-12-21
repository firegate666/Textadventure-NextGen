<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?= $form->label($model,'id'); ?>
		<?= $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'createdAt'); ?>
		<?= $form->textField($model,'createdAt'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'changedAt'); ?>
		<?= $form->textField($model,'changedAt'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'createdBy'); ?>
		<?= $form->textField($model,'createdBy'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'changedBy'); ?>
		<?= $form->textField($model,'changedBy'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'name'); ?>
		<?= $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'xPos'); ?>
		<?= $form->textField($model,'xPos'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'yPos'); ?>
		<?= $form->textField($model,'yPos'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'magnitude'); ?>
		<?= $form->textField($model,'magnitude'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'mapSectionId'); ?>
		<?= $form->textField($model,'mapSectionId'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
