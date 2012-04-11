<?php $this->pageTitle = Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<blockquote><strong>Today is <?php $this->renderDynamic('nowDate');?></strong></blockquote>

<p>Please take your time. Register yourself an account and try out the adventure builder
	or play one of the sample ministeps.</p>

<p>Feedback is appreciated!</p>

<p>If you want to check out the project homepage, you can visit us on our
	<a href="http://dev.firegate.de/projects/text-adventure-nextgen/wiki" target="_blank">Redmine</a></p>