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

	<b><?= CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?= CHtml::encode($data->name); ?>
	<br />


</div>
