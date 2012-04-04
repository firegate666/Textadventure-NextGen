<div class="view">

	<b><?=CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?=CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?=CHtml::encode($data->name); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('isAdmin')); ?>:</b>
	<?=CHtml::encode($data->isAdmin); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('canCreateAdventure')); ?>:</b>
	<?=CHtml::encode($data->canCreateAdventure); ?>
	<br />

	<b><?=CHtml::encode($data->getAttributeLabel('defaultRegisterGroup')); ?>:</b>
	<?=CHtml::encode($data->defaultRegisterGroup); ?>
	<br />

</div>
