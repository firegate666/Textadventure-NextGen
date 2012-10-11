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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size'); ?>
		<?php echo $form->textField($model,'size'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'xPos'); ?>
		<?php echo $form->textField($model,'xPos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yPos'); ?>
		<?php echo $form->textField($model,'yPos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'archipelagoId'); ?>
		<?php echo $form->textField($model,'archipelagoId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ownerId'); ?>
		<?php echo $form->textField($model,'ownerId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'storageId'); ?>
		<?php echo $form->textField($model,'storageId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->