<?php
$action_text = 'Enter world';
$action_name = 'enterWorld';

if ($model->playerIsOnWorld(Yii::app()->user->id)) {
	$action_text = 'Continue world';
	$action_name = 'continueWorld';
}
?>

<li>
	<?=$model->name?>
	(
		<?=CHtml::link(
			$action_text,
			array(
				$action_name,
				'world_id' => $model->id
			)
		)?>
	)
</li>
