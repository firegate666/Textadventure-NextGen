<?php
	$langchooser_controller_action = $this->getRoute();
	$langchooser_action_params = $this->getActionParams();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="aG7-NEHDoXRFeIiDCHFIxhBmn6Uhp0IhEGvStsCLWzI" />
	<meta name="language" content="de" />

	<!-- special fonts -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/drachendaemmerung/css/fontfaces.css" />

	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/drachendaemmerung/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/drachendaemmerung/css/main.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?> | game.drachendaemmerung.de</title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
			<img src="/themes/drachendaemmerung/images/dragon_115x.png" alt="<?php echo CHtml::encode(Yii::app()->name); ?>"/>
			<span class="sticky"><strong>A fantastic and high-fantasy role-playing game world.</strong></span>
			<div class="langchooser" style="float: right">
				<a href="<?=$this->createUrl($langchooser_controller_action, array_merge($langchooser_action_params, array('lang' => 'de')))?>">DE</a> |
				<a href="<?=$this->createUrl($langchooser_controller_action, array_merge($langchooser_action_params, array('lang' => 'en')))?>">EN</a>
			</div>
			<div class="clear"></div>
		</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Start', 'url'=>array('/site/index')),
				array('label'=>'Info', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Kontakt', 'url'=>array('/site/contact')),

				array('label'=>'Starte das Abenteuer!', 'url'=>array('/Adventure/index'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>'Login', 'url'=>array('/auth/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Registrieren', 'url'=>array('/User/register'), 'visible'=>Yii::app()->user->isGuest),

				array('label'=>'Admin', 'url'=>array('/site/admin'), 'visible' => !Yii::app()->user->isGuest && (
					Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState("canCreateAdventure"))
				),
				array('label'=>'Ausloggen ('.Yii::app()->user->name.')', 'url'=>array('/auth/logout'), 'visible' => !Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright 2010 - <?php echo date('Y'); ?> by <a href="http://www.drachendaemmerung.de/">drachendaemmerung.de</a><br/>
		All Rights Reserved. Report problems at <a href="http://dev.firegate.de/projects/text-adventure-nextgen" target="_blank">Redmine</a>.<br/>
		Game engine version: <?php $this->renderDynamic('getVersionInfo');?> | <?php echo Yii::powered(); ?><br />

	</div><!-- footer -->

</div><!-- page -->

<?php
$this->renderPartial('//layouts/_piwik');
$this->renderPartial('//layouts/_ga');
?>

</body>
</html>
