<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('storageId')); ?>:</b>
	<?php echo CHtml::encode($data->storageId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resourceId')); ?>:</b>
	<?php echo CHtml::encode($data->resourceId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />


</div>