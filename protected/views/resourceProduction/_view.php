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

	<b><?php echo CHtml::encode($data->getAttributeLabel('islandId')); ?>:</b>
	<?php echo CHtml::encode($data->islandId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resourceId')); ?>:</b>
	<?php echo CHtml::encode($data->resourceId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('growthFactor')); ?>:</b>
	<?php echo CHtml::encode($data->growthFactor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productionValue')); ?>:</b>
	<?php echo CHtml::encode($data->productionValue); ?>
	<br />

	*/ ?>

</div>