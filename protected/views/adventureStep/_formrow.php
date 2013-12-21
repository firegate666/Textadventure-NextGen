<?php
/** @var CActiveForm $form */
/** @var Adventure $parent */
/** @var integer $index */
/** @var AdventureStep $model */

$inputElementPrefix = '[' . $index . ']';
$panels = array();
?>
<div class="form">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model); ?>

	<?= $form->hiddenField($model, $inputElementPrefix . 'id') ?>
	<?= $form->hiddenField($model, $inputElementPrefix . 'adventure') ?>

	<div class="row">
		<?=$form->labelEx($model,'name'); ?>
		<?=$form->textField($model,$inputElementPrefix . 'name',array('size'=>60,'maxlength'=>256)); ?>
		<?=$form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'description'); ?>
		<?php
		$this->widget('KRichTextEditor', array(
			'model' => $model,
			'value' => $model->description,
			'htmlOptions' => array(
				'rows' => 10,
				'style' => 'width: 100%'
			),
			'attribute' => $inputElementPrefix . 'description',
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
		<?=$form->error($model,'description'); ?>
		<div class="small">
			<i>(use <a href="http://daringfireball.net/projects/markdown/syntax">Markdown</a>-Syntax)</i>
		</div>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'stepId'); ?>
		<?=$form->textField($model,$inputElementPrefix . 'stepId',array('size'=>32,'maxlength'=>32)); ?>
		<?=$form->error($model,'stepId'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'startingPoint'); ?>
		<?=$form->checkBox($model,$inputElementPrefix . 'startingPoint'); ?>
		<?=$form->error($model,'startingPoint'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model,'endingPoint'); ?>
		<?=$form->checkBox($model,$inputElementPrefix . 'endingPoint'); ?>
		<?=$form->error($model,'endingPoint'); ?>
	</div>

	<?php if (!empty($model->stepOptions)): ?>

		<?php
			foreach($model->stepOptions as $next_index => $option) {
				$option->parent = $model->id;
				$panels[$option->name] = $this->renderPartial('/adventureStepOption/_formrow', array(
					'model' => $option,
					'parent' => $model,
					'form' => $form,
					'index' => $index * 10000 + $next_index,
					'adventureStepList' => AdventureStep::items($parent)
				), true);
			}
		?>

		<h3>Adventure Step Options</h2>

		<?php $this->widget('zii.widgets.jui.CJuiAccordion', array(
			'panels'=>$panels,
			// additional javascript options for the accordion plugin
			'options'=>array(
				'animated'=>'bounceslide',
			),
		)) ?>

	<?php endif ?>

</div><!-- form -->
