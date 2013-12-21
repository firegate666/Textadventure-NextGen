<?php
/** @var Adventure $model */
/** @var AdventureStep[] $adventureSteps */
Yii::import('ext.krichtexteditor.KRichTextEditor');

$panels = array();
?>
<div class="form">

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'adventure-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<div class="row">
		<?=$form->labelEx($model, 'name'); ?>
		<?=$form->textField($model, 'name',array('size' => 60, 'maxlength' => 256)); ?>
		<?=$form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'description'); ?>
		<?php
		$this->widget('KRichTextEditor', array(
			'model' => $model,
			'value' => $model->description,
			'htmlOptions' => array(
				'rows' => 25,
				'style' => 'width: 100%'
			),
			'attribute' => 'description',
			'options' => array(
				'theme' => 'advanced',
				'theme_advanced_toolbar_location' => 'top',
				'theme_advanced_toolbar_align' => 'left',
				'theme_advanced_buttons1' => "formatselect,bold,italic,underline,strikethrough",
				'theme_advanced_buttons2' => "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,cleanup,code,|,forecolor,backcolor",
				'theme_advanced_buttons3' => '',
			),
		));
		?>
		<?=$form->error($model, 'description'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'adventureId'); ?>
		<?=$form->textField($model, 'adventureId',array('size' => 32,'maxlength' => 32)); ?>
		<?=$form->error($model, 'adventureId'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'state'); ?>
		<?=$form->dropDownList($model, 'state', Adventure::validStates()); ?>
		(set to "Published"	if you want to play it)
		<?=$form->error($model, 'state'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'startDate'); ?>
		<?=$this->widget('zii.widgets.jui.CJuiDatePicker', array('language' => 'sv',  'name' => 'startDate', 'model' => $model, 'attribute' => 'startDate'), true) ?>
		(z.B. <?=date('Y-m-d')?>)


		<?=$form->error($model, 'startDate'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'stopDate'); ?>
		<?=$this->widget('zii.widgets.jui.CJuiDatePicker', array('language' => 'sv',  'name' => 'stopDate', 'model' => $model, 'attribute' => 'stopDate'), true) ?>
		(z.B. <?=date('Y-m-d', time() + 60*60*24)?>)
		<?=$form->error($model, 'stopDate'); ?>
	</div>

	<?php if (!empty($adventureSteps)) : ?>

		<?php
			foreach($adventureSteps as $index => $step) {
				$step->adventure = $model->id;
				$panels[$step->name] = $this->renderPartial('/adventureStep/_formrow', array(
					'model' => $step,
					'parent' => $model,
					'form' => $form,
					'index' => $index
				), true);
			}
		?>

		<h2>Adventure Steps</h2>

		<?php $this->widget('zii.widgets.jui.CJuiAccordion', array(
			'panels' => $panels,
			// additional javascript options for the accordion plugin
			'options' => array(
				'animated' => 'bounceslide',
			),
		)); ?>

	<?php endif ?>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?=CHtml::submitButton($model->isNewRecord ? 'Create and return' : 'Save and return', array('name' => 'save_and_return')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
