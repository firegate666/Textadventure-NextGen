<?php
$this->pageTitle = Yii::app()->name . ' - Fehler';
$this->breadcrumbs = array(
	'Fehler',
);
?>

<h1>Fehler <?php echo $code; ?></h1>

<p>Es ist ein Fehler aufgetreten!</p>
<div class="error">
	<?php echo CHtml::encode($message); ?>
	<p><a href="https://github.com/firegate666/Textadventure-NextGen/issues?state=open">Klicke hier</a>,
		um diesen Fehler zu melden.</p>
</div>
