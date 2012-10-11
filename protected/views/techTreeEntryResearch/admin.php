<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Researches'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TechTreeEntryResearch', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntryResearch', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tech-tree-entry-research-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tech Tree Entry Researches</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tech-tree-entry-research-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'createdAt',
		'changedAt',
		array(            // display 'author.username' using an expression
			'name' => 'createdBy',
			'value' => '$data->getCreateUserName()',
		),
		'createdAt',
		array(            // display 'author.username' using an expression
			'name' => 'changedBy',
			'value' => '$data->getChangeUserName()',
		),
		'userId',
		'techId',
		'start',
		'end',
		'finished',
		array(
			'class'=>'CButtonColumn',
			'template' => '{update} {delete}',
		),
	),
)); ?>
