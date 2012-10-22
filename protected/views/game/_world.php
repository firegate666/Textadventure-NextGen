<li>
	<?=$model->name?>
	(<?=CHtml::link(
		'Play',
		array(
			'enterWorld',
			'world_id' => $model->id
		)
	)
	?>)
</li>
