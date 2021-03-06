<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});

	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('user-grid', {
			data: $(this).serialize()
		});
		return false;
	});

	window.setLimit = function(limit) {
		$('input[name=limit]').val(limit);
		$('.search-form form input[type=submit]').click();
	}
");

$pager_limits = array(5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100);
?>

<h1>Manage Users</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?= CHtml::link('Advanced Search','#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
	'limit' => $limit
)); ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->search($limit),
	'filter' => $model,
	'pager' => array(
		'footer' => CHtml::dropDownList('limit', $limit, $pager_limits, array('class' => 'limit', 'onchange' => 'setLimit($(this).val())'))
	),
	'columns' => array(
		'id',
		'lastLogin',
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
		'username',
		'email',
		array(
			'name' => 'groupId',
			'value' => '$data->getRelatedAttribute("group", "name", "")',
		),
		array(
			'class' => 'CButtonColumn',
		),
	),
));
