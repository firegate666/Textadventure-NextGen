<div class="view">

	<b><?=CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?=CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
	<?=CHtml::encode($data->parent); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('target')); ?>:</b>
	<?=CHtml::encode($data->target); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?=CHtml::encode($data->name); ?>
	<br />


</div>
