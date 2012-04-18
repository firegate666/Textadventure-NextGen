<?php
$this->pageTitle = Yii::app()->name . ' - Abenteuer: Erstellen, verändern und spielen';
$this->breadcrumbs = array(
	'Info' => array('page', 'view' => 'about'),
	'Abenteuer: Erstellen, verändern und spielen',
);
?>
<h1>Alles über Abenteuer bei <?=Yii::app()->name?></h1>

<h2>Abenteuer spielen</h2>

<p>Nach dem <a href="<?=$this->createUrl('Auth/login')?>">Login</a> kommst Du über den Link
	<?php if (Yii::app()->user->isGuest): ?>
		<em>&raquo;&nbsp;Starte das Abenteuer!</em>
	<?php else: ?>
		<a href="<?=$this->createUrl('Adventure/index')?>">&raquo;&nbsp;Starte das Abenteuer!</a>
	<?php endif;?>
	auf die Übersicht der bereits veröffentlichen Abenteuer. Dort kannst Du Dir die Beschreibungstexte anschauen und Dich für ein
	Abenteuer entscheiden. Per Klick startest Du es einfach.</p>

<h2>Abenteuer verwalten</h2>

<p>Wenn Du <a href="<?=$this->createUrl('Auth/login')?>">angemeldet</a> bist und Dein Benutzer über die ausreichenden Rechte verfügt, und das sollte er, dann kannst Du über den Link
	<?php if (Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState("canCreateAdventure")): ?>
		<a href="<?=$this->createUrl('admin')?>">&raquo;&nbsp;Admin</a>
	<?php else: ?>
		<em>&raquo;&nbsp;Admin</em>
	<?php endif;?>
	auf die Administrationsoberfläche wechseln. Dort kannst Du Deine eigenen Abenteuer zusammenstellen und diese für andere Spieler freigeben.</p>
