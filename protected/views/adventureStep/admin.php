<?php
$this->breadcrumbs=array(
	'Adventure Steps'=>array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'List AdventureStep', 'url' => array('index')),
	array('label' => 'Create AdventureStep', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('adventure-step-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");
?>

<h1>Manage Adventure Steps</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?= CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">

<?php
$this->renderPartial('_search',array(
	'model'=>$model,
));
?>

</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'adventure-step-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(            // display 'author.username' using an expression
			'name' => 'createdBy',
			'value' => '$data->getCreateUserName()',
		),
		'createdAt',
		array(            // display 'author.username' using an expression
			'name' => 'changedBy',
			'value' => '$data->getChangeUserName()',
		),
		'changedAt',
		'adventure',
		'name',
		'description',
		'stepId',
		'startingPoint',
		'endingPoint',
		array(
			'class'=>'CButtonColumn',
			'template' => '{update} {delete}',
		),
	),
));
