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
		<?php echo $form->label($model,'islandId'); ?>
		<?php echo $form->textField($model,'islandId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resourceId'); ?>
		<?php echo $form->textField($model,'resourceId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'growthFactor'); ?>
		<?php echo $form->textField($model,'growthFactor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'productionValue'); ?>
		<?php echo $form->textField($model,'productionValue'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->