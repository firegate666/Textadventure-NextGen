<?php
$this->breadcrumbs=array(
	'Map Sections'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MapSection', 'url'=>array('index')),
	array('label'=>'Create MapSection', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('map-section-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Map Sections</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?= CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'map-section-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'createdAt',
		array(            // display 'author.username' using an expression
			'name' => 'createdBy',
			'value' => '$data->getCreateUserName()',
		),
		'changedAt',
		array(            // display 'author.username' using an expression
			'name' => 'changedBy',
			'value' => '$data->getChangeUserName()',
		),
		'leftSectionId',
		'rightSectionId',
		'worldId',
		array(
			'class'=>'CButtonColumn',
			'template' => '{update} {delete}',
		),
	),
)); ?>
