<?php
$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
	<?php echo CHtml::encode($message); ?>
	<p><a href="https://github.com/firegate666/Textadventure-NextGen/issues?state=open">Click here</a>
		if you want to report this error.</p>
</div>
