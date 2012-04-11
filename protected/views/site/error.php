<?php
$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
	<?php echo CHtml::encode($message); ?>
	<p><a href="http://dev.firegate.de/projects/text-adventure-nextgen/issues">Click here</a>
		if you want to report this error.</p>
</div>
