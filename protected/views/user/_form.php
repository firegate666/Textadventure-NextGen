<div class="form">

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'user-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?=$form->errorSummary($model); ?>

	<div class="row">
		<?=$form->labelEx($model, 'username'); ?>
		<?=$form->textField($model, 'username',array('size' => 60, 'maxlength' => 128)); ?>
		<?=$form->error($model, 'username'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'newPassword'); ?>
		<?=$form->passwordField($model, 'newPassword',array('size' => 60, 'maxlength' => 128)); ?>
		<?=$form->error($model, 'newPassword'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'newPasswordConfirm'); ?>
		<?=$form->passwordField($model, 'newPasswordConfirm',array('size' => 60, 'maxlength' => 128)); ?>
		<?=$form->error($model, 'newPasswordConfirm'); ?>
	</div>

	<div class="row">
		<?=$form->labelEx($model, 'email'); ?>
		<?=$form->textField($model, 'email',array('size' => 60, 'maxlength' => 128)); ?>
		<?=$form->error($model, 'email'); ?>
	</div>

	<?php if (isset($register) && $register): ?>
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
	<?php else: ?>
		<div class="row">
			<?=$form->labelEx($model, 'groupId'); ?>
			<?=$form->dropDownList($model, 'groupId', $groupList); ?>
			<?=$form->error($model, 'groupId'); ?>
		</div>
	<?php endif; ?>

	<div class="row buttons">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
