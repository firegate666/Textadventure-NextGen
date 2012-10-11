<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdAt'); ?>
		<?php echo $form->textField($model,'createdAt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'changedAt'); ?>
		<?php echo $form->textField($model,'changedAt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdBy'); ?>
		<?php echo $form->textField($model,'createdBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'changedBy'); ?>
		<?php echo $form->textField($model,'changedBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leftSectionId'); ?>
		<?php echo $form->textField($model,'leftSectionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rightSectionId'); ?>
		<?php echo $form->textField($model,'rightSectionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'worldId'); ?>
		<?php echo $form->textField($model,'worldId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->