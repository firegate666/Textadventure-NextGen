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
		<?= $form->label($model,'islandId'); ?>
		<?= $form->textField($model,'islandId'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'resourceId'); ?>
		<?= $form->textField($model,'resourceId'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'growthFactor'); ?>
		<?= $form->textField($model,'growthFactor'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'productionValue'); ?>
		<?= $form->textField($model,'productionValue'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
