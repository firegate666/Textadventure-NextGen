<?php if ($data->isRunning()): ?>
	<div class="adventure view">

		<div class="description">
			<h2><?=CHtml::encode($data->name);?></h2>
			<blockquote><?=CHtml::encode($data->description)?></blockquote>
		</div>

		<?php if ($data->hasSteps()): ?>
			<div class="button button-play">
				<?=CHtml::link($data->userInAdventure()?'CONTINUE':'PLAY', array('view', 'id' => $data->id))?>
			</div>
		<?php else: ?>
			<div class="button button-noplay">
				<?=CHtml::link('Not open yet', '#')?>
			</div>
		<?php endif;?>

		<div style="clear: both;"></div>

	</div>
<?php endif; ?>
