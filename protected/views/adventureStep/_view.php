<div class="view">

	<b><?=CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?=CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('adventure')); ?>:</b>
	<?=CHtml::encode($data->adventure); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?=CHtml::encode($data->name); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?=CHtml::encode($data->description); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('stepId')); ?>:</b>
	<?=CHtml::encode($data->stepId); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('startingPoint')); ?>:</b>
	<?=CHtml::encode($data->startingPoint); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('endingPoint')); ?>:</b>
	<?=CHtml::encode($data->endingPoint); ?>
	<br />

</div>
