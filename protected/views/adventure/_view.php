<?php if ($data->isRunning() || $data->userInAdventure(Yii::app()->user->id)): ?>
	<div class="adventure view">

		<div class="description">
			<h2><?=CHtml::encode($data->name);?></h2>
			<blockquote><?=CHtml::encode($data->description)?></blockquote>
		</div>

		<?php if ($data->hasSteps()): ?>
			<div class="button button-play">
				<?php if ($data->isRunning()): ?>
					<?=CHtml::link($data->userInAdventure(Yii::app()->user->id)?'CONTINUE':'PLAY', array('view', 'id' => $data->id))?>
				<?php else: ?>
					<?=CHtml::link('Closed for now, please return later', '#')?>
				<?php endif;?>
			</div>
		<?php else: ?>
			<div class="button button-noplay">
				<?=CHtml::link('Not open yet', '#')?>
			</div>
		<?php endif;?>

		<div style="clear: both;"></div>

	</div>
<?php endif; ?>
