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

	<b><?=CHtml::encode($data->getAttributeLabel('adventureStepId')); ?>:</b>
	<?=CHtml::encode($data->adventureStepId); ?>
	<br />


</div>
