<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adventure')); ?>:</b>
	<?php echo CHtml::encode($data->adventure); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stepId')); ?>:</b>
	<?php echo CHtml::encode($data->stepId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startingPoint')); ?>:</b>
	<?php echo CHtml::encode($data->startingPoint); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endingPoint')); ?>:</b>
	<?php echo CHtml::encode($data->endingPoint); ?>
	<br />

</div>
