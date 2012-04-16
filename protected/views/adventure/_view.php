<?php if ($data->isRunning() || $data->userInAdventure(Yii::app()->user->id)): ?>
	<div class="adventure view">

		<div class="description">
			<h2><?=CHtml::encode($data->name);?></h2>
			<blockquote>
				<?=$this->widget('CMarkdown')->transform($data->description)?>
			</blockquote>
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
				<?=CHtml::link('Not open yet', null)?>
			</div>
		<?php endif;?>

		<div class="clear"></div>

	</div>
<?php endif; ?>
