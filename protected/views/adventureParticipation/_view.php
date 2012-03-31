<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdAt')); ?>:</b>
	<?php echo CHtml::encode($data->createdAt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('changedAt')); ?>:</b>
	<?php echo CHtml::encode($data->changedAt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdBy')); ?>:</b>
	<?php echo CHtml::encode($data->createdBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('changedBy')); ?>:</b>
	<?php echo CHtml::encode($data->changedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adventureId')); ?>:</b>
	<?php echo CHtml::encode($data->adventureId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('started')); ?>:</b>
	<?php echo CHtml::encode($data->started); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ended')); ?>:</b>
	<?php echo CHtml::encode($data->ended); ?>
	<br />

</div>
