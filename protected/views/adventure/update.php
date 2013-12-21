<?php
$this->breadcrumbs = array(
	'Adventures' => array('index'),
	$model->name => array('view', 'id' => $model->id),
	'Update',
);

$this->menu = array(
	array('label' => 'List Adventure', 'url' => array('index')),
	array('label' => 'Create Adventure', 'url' => array('create')),
	array('label' => 'View Adventure', 'url' => array('view', 'id' => $model->id)),
	array('label' => 'Manage Adventure', 'url' => array('admin')),
);
?>

<h1>Update Adventure <?= $model->id; ?></h1>

<?php $this->renderPartial('_form', array(
	'model' => $model,
	'adventureSteps' => $adventureSteps
)); ?>
