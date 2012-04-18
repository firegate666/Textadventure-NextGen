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
	<p><a href="http://dev.firegate.de/projects/text-adventure-nextgen/issues">Klicke hier</a>,
		um diesen Fehler zu melden.</p>
</div>
