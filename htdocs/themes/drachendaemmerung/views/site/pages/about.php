<?php
$this->pageTitle = Yii::app()->name . ' - Info';
$this->breadcrumbs = array(
	'Info',
);
?>
<h1>Info zu <?=Yii::app()->name?></h1>

<p>Drachend&aelig;mmerung befindet sich noch in der Entwicklung. Hier findest Du Informationen zu den bereits fertig gestellten Funktionen.</p>

<h2>Version 1.0</h2>

<ul>
	<li>Login, Registrieren <a href="<?=$this->createUrl('page', array('view'=>'login-register'))?>">&raquo;</a></li>
	<li>Abenteuer erstellen, verändern und spielen <a href="<?=$this->createUrl('page', array('view'=>'manage-adventure'))?>">&raquo;</a></li>
</ul>
