<div class="adventure view">

	<div class="description">
		<h2><?=CHtml::encode($data->name);?></h2>
		<blockquote>
			<?= $data->description ?>
		</blockquote>
	</div>

	<?php if ($data->hasStartingPoint() && $data->hasEndingPoint()): ?>
		<div class="button button-play">
			<?=CHtml::link($data->userInAdventure(Yii::app()->user->id)?'Fortsetzen':'Starten', array('view', 'id' => $data->id))?>
		</div>
	<?php else: ?>
		<div class="button button-noplay">
			<?=CHtml::link('Noch geschlossen', null)?>
		</div>
	<?php endif;?>

	<div class="clear"></div>

</div>
