<?php
$this->breadcrumbs=array(
	'Adventures'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Adventure', 'url'=>array('index')),
	array('label'=>'Create Adventure', 'url'=>array('create')),
	array('label'=>'Update Adventure', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Adventure', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Adventure', 'url'=>array('admin')),
);
?>

<h1><?=$model->name?></h1>

<blockquote><?=$model->description?></blockquote>

<h2><?=$stepModel->name?></h2>

<p><?=$stepModel->description?></p>


<?php if ($stepModel->hasOptions()): ?>

	<p>What do you want to do now?</p>

	<ul>
		<?php foreach ($stepModel->getRelated('stepOptions') as $stepOption): ?>
			<?php $this->renderPartial('_stepoption', array('id' => $model->id, 'model' => $stepOption)); ?>
		<?php endforeach; ?>
	</ul>

<?php else: ?>

	<p>There are no options for you.</p>

<?php endif;?>
