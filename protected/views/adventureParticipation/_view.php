<div class="view">

	<b><?=CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?=CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('createdAt')); ?>:</b>
	<?=CHtml::encode($data->createdAt); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('changedAt')); ?>:</b>
	<?=CHtml::encode($data->changedAt); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('createdBy')); ?>:</b>
	<?=CHtml::encode($data->createdBy); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('changedBy')); ?>:</b>
	<?=CHtml::encode($data->changedBy); ?>
	<br />

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
