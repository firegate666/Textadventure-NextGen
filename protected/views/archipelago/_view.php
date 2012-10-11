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

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('xPos')); ?>:</b>
	<?php echo CHtml::encode($data->xPos); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('yPos')); ?>:</b>
	<?php echo CHtml::encode($data->yPos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('magnitude')); ?>:</b>
	<?php echo CHtml::encode($data->magnitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mapSectionId')); ?>:</b>
	<?php echo CHtml::encode($data->mapSectionId); ?>
	<br />

	*/ ?>

</div>