<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register',
);
?>

<h1>Register User</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'register' => true)); ?>
