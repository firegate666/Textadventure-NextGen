<?php
$this->breadcrumbs = array(
	'Adventures' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'Create Adventure', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('adventure-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");
?>

<h1>Manage Adventures</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">

<?php
$this->renderPartial('_search', array(
	'model' => $model,
));
?>

</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'adventure-grid',
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
		'name',
		'description',
		'adventureId',
		array(
			'name' => 'state',
			'value' => '$data->getStateName($data->state)',
		),
		'startDate',
		'stopDate',
		array(
			'header' => 'Startpoint set?',
			'type' => 'html',
			'value' => 'Utils::bool2icon($data->hasStartingPoint(), "Needed to play the adventure")',
		),
		array(
			'header' => 'Endpoint set?',
			'type' => 'html',
			'value' => 'Utils::bool2icon($data->hasEndingPoint(), "Needed to play the adventure")',
		),
		array(
			'header' => 'Steps',
			'value' => 'count($data->getRelated(\'adventureSteps\'))',
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{update} {delete} {graph}',
			'buttons' => array(
				'graph' => array(
					'label' => 'Graph',
					'url' => 'Yii::app()->controller->createUrl("graph",array("id"=>$data->primaryKey))',
					'imageUrl' => Yii::app()->request->baseUrl . '/public/images/icons/tree.gif',
				),
			),
		),
	),
));
