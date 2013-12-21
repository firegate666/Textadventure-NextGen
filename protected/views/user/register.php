<?php
$this->breadcrumbs = array(
	'Register',
);
?>

<h1>Register User</h1>

<?= $this->renderPartial('_form', array('model' => $model, 'register' => true)); ?>
