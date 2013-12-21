<?php $this->pageTitle = Yii::app()->name; ?>

<h1>Welcome to <i><?= CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>Today is <?php $this->renderDynamic('nowDate');?></p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?= __FILE__; ?></code></li>
	<li>Layout file: <code><?= $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
