<?php
$this->pageTitle = Yii::app()->name . ' - Kontakt';
$this->breadcrumbs = array(
	'Kontakt',
);
?>

<h1>Kontakt</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?=Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>Nutze dieses Formular, um mit uns Kontakt aufzunehmen. Schreibe uns Deine Meinung und Ideen.
	Solltest Du Fehler gefunden haben, so nutze bitte das <a href="http://dev.firegate.de/projects/text-adventure-nextgen" target="_blank">Redmine</a>
	um diese zu melden.</p>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'contact-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
)); ?>

	<p class="note">Felder die mit einem <span class="required">*</span> markiert sind müssen ausgefüllt werden.</p>

	<?=$form->errorSummary($model, '<h4>Bitte behebe die folgenden Fehler:</h4>'); ?>

	<div class="row">
		<?=$form->labelEx($model, 'name'); ?>
		<?=$form->textField($model, 'name'); ?>
		<?=$form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'email'); ?>
		<?=$form->textField($model, 'email'); ?>
		<?=$form->error($model, 'email'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'subject'); ?>
		<?=$form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
		<?=$form->error($model, 'subject'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'body'); ?>
		<?=$form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
		<?=$form->error($model, 'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?=$form->labelEx($model, 'verifyCode'); ?>
		<div class="captcha-wrapper">
			<?=$form->textField($model, 'verifyCode'); ?>
			<?=$form->error($model, 'verifyCode'); ?>
			<?php $this->widget('CCaptcha'); ?>
			<div class="hint">
				Gebe die Buchstaben und Zahlen so ein, wie sie auf dem Bild dargestellt werden.<br />
				Es wird nicht zwischen Groß- und Kleinbuchstaben unterschieden.
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?=CHtml::submitButton('Absenden'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
