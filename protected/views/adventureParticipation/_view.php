<div class="view">

	<?php
		$this->renderPartial('application.views.generics._view_metainfo', array('data' => $data));
	?>

	<b><?=CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?=CHtml::encode($data->userId); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('adventureId')); ?>:</b>
	<?=CHtml::encode($data->adventureId); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('started')); ?>:</b>
	<?=CHtml::encode($data->started); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('ended')); ?>:</b>
	<?=CHtml::encode($data->ended); ?>
	<br />

</div>
