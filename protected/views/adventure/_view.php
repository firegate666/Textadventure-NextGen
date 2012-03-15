<div class="adventure view">

	<div class="description">
		<h2><?=CHtml::encode($data->name);?></h2>
		<blockquote><?=CHtml::encode($data->description)?></blockquote>
	</div>

	<div class="button-play">
		<?=CHtml::link('PLAY', array('start', 'id'=>$data->id))?>
	</div>

	<div style="clear: both;"></div>

</div>
