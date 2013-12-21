<?php
$this->breadcrumbs = array(
	'Abenteuer' => array('index'),
	$model->name,
);
?>

<h1><?=$model->name?></h1>

<div class="adventure-description">
	<?= $model->description ?>
</div>

<h2><?=$stepModel->name?></h2>

<div class="adventure-step-description">
	<?= $stepModel->description ?>
</div>

<?php if ($stepModel->endingPoint): ?>
<div class="infoblock">
	<p>Du hast das Ende des Abenteuer erreicht, hier gibt es keine weiteren Optionen.</p>
	<p>Du kannst das Abenteuer noch einmal spielen? <?= CHtml::link('Ja, bitte neu starten.', array('reset', 'id' => $model->id)) ?></p>
</div>
<?php elseif ($stepModel->hasOptions()): ?>

	<p>Was möchtest Du jetzt machen?</p>

	<ul>
		<?php foreach ($stepModel->getRelated('stepOptions') as $stepOption): ?>
			<?php $this->renderPartial('_stepoption', array('id' => $model->id, 'model' => $stepOption)); ?>
		<?php endforeach; ?>
	</ul>

<?php else: ?>

	<p>Hier gibt es keine Optionen.</p>

<?php endif;?>
