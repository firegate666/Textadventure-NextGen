<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isAdmin')); ?>:</b>
	<?php echo CHtml::encode($data->isAdmin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('defaultRegisterGroup')); ?>:</b>
	<?php echo CHtml::encode($data->defaultRegisterGroup); ?>
	<br />

</div>
