<li class="stepoption">&raquo; <?=CHtml::link(
		$model->name,
		array(
			'view',
			'id' => $id,
			'step' => $model->target,
		)
	)
?></li>
