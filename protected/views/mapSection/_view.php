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

	<b><?php echo CHtml::encode($data->getAttributeLabel('leftSectionId')); ?>:</b>
	<?php echo CHtml::encode($data->leftSectionId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rightSectionId')); ?>:</b>
	<?php echo CHtml::encode($data->rightSectionId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('worldId')); ?>:</b>
	<?php echo CHtml::encode($data->worldId); ?>
	<br />

	*/ ?>

</div>