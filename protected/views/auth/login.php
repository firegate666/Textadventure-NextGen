<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?=$form->labelEx($model, 'username'); ?>
		<?=$form->textField($model, 'username'); ?>
		<?=$form->error($model, 'username'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'password'); ?>
		<?=$form->passwordField($model, 'password'); ?>
		<?=$form->error($model, 'password'); ?>
	</div>

	<div class="row rememberMe">
		<?=$form->checkBox($model, 'rememberMe'); ?>
		<?=$form->label($model, 'rememberMe'); ?>
		<?=$form->error($model, 'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?=CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
