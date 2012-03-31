<div class="view">

	<b><?=CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?=CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?=CHtml::encode($data->username); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?=CHtml::encode($data->email); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('groupId')); ?>:</b>
	<?=CHtml::encode($data->groupId); ?>
	<br />


</div>
