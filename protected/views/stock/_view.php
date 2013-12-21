<div class="view">

	<b><?= CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?= CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('createdAt')); ?>:</b>
	<?= CHtml::encode($data->createdAt); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('changedAt')); ?>:</b>
	<?= CHtml::encode($data->changedAt); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('createdBy')); ?>:</b>
	<?= CHtml::encode($data->createdBy); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('changedBy')); ?>:</b>
	<?= CHtml::encode($data->changedBy); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('storageId')); ?>:</b>
	<?= CHtml::encode($data->storageId); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('resourceId')); ?>:</b>
	<?= CHtml::encode($data->resourceId); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?= CHtml::encode($data->amount); ?>
	<br />


</div>
