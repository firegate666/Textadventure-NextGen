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

	<b><?= CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?= CHtml::encode($data->userId); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('techId')); ?>:</b>
	<?= CHtml::encode($data->techId); ?>
	<br />

	<?php /*
	<b><?= CHtml::encode($data->getAttributeLabel('start')); ?>:</b>
	<?= CHtml::encode($data->start); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('end')); ?>:</b>
	<?= CHtml::encode($data->end); ?>
	<br />

	<b><?= CHtml::encode($data->getAttributeLabel('finished')); ?>:</b>
	<?= CHtml::encode($data->finished); ?>
	<br />

	*/ ?>

</div>
