<?php $this->pageTitle = Yii::app()->name; ?>

<h1>Welcome to administration of <i><?= CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Today is <?php $this->renderDynamic('nowDate');?></p>
