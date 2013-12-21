<?php
$this->pageTitle = Yii::app()->name . ' - Login/Registrieren';
$this->breadcrumbs = array(
	'Info' => array('page', 'view' => 'about'),
	'Login/Registrieren',
);
?>
<h1>Login / Registrieren bei <?=Yii::app()->name?></h1>

<h2>Registrieren</h2>

<p>Über den Link <a href="<?=$this->createUrl('/User/register')?>">&raquo;&nbsp;Registrieren</a> kannst Du Dir einen Benutzer erstellen.
	Diese Registrierung ist jetzt und in Zukunft kostenlos.</p>

<h2>Login</h2>

<p>Wenn Du einen Benutzer angelegt hast, kannst Dich über den Link <a href="<?=$this->createUrl('/Auth/login')?>">&raquo;&nbsp;Login</a> im Spiel anmelden.</p>
