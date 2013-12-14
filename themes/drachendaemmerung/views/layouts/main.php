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

	<link rel="shortcut icon" href="/themes/drachendaemmerung/images/favicon.ico">

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
		<div id="logostrip">
			<img class="logo" src="/themes/drachendaemmerung/images/dragon_75x.png" alt="<?php echo CHtml::encode(Yii::app()->name); ?>"/>
			<span class="sticky"><strong>A fantastic and high-fantasy role-playing game world.</strong></span>
			<div class="langchooser" style="float: right">
				<a href="<?=$this->createUrl($langchooser_controller_action, array_merge($langchooser_action_params, array('lang' => 'de')))?>"><img src="/themes/drachendaemmerung/images/de-flag.jpg" alt="DE" /></a>
				<a href="<?=$this->createUrl($langchooser_controller_action, array_merge($langchooser_action_params, array('lang' => 'en')))?>"><img src="/themes/drachendaemmerung/images/en-flag.jpg" alt="EN" /></a>
			</div>
			<div class="clear"></div>
		</div>
	</div><!-- header -->

	<div id="mainwrap">
		<div id="mainmenu">
			<?php $this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('style' => 'float: left'),
				'items'=>array(
					array('label'=>'Start', 'url'=>array('/site/index')),
					array('label'=>'Info', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Kontakt', 'url'=>array('/site/contact')),

					array('label'=>'Starte das Abenteuer!', 'url'=>array('/Adventure/index'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Sea Wars', 'url'=>array('/Game/index'), 'visible'=>!Yii::app()->user->isGuest,
						'active' => strtolower($this->id) == 'game',
						'submenuOptions' => array('class' => 'submenu'),
						'items' => array(
							array('label' => 'Inselreiche', 'url' => array('/Game/worldmap')),
							array('label' => 'Meine Inseln', 'url' => array('/Game/ownIslands')),
							array('label' => 'Forschung', 'url' => array('/Game/research')),
							array('label' => 'Highscore', 'url' => array('/Game/highscore')),
						)
					),

				),
			)); ?>

			<?php $this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array('style' => 'float: right'),
				'items'=>array(
					array('label'=>'Login', 'url'=>array('/auth/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Registrieren', 'url'=>array('/User/register'), 'visible'=>Yii::app()->user->isGuest),

					array('label'=>'Admin', 'url'=>array('/site/admin'), 'visible' => !Yii::app()->user->isGuest && (
						Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState("canCreateAdventure"))
					),
					array('label'=>'Ausloggen ('.Yii::app()->user->name.')', 'url'=>array('/auth/logout'), 'visible' => !Yii::app()->user->isGuest),
				),
			)); ?>

			<div style="clear: both"></div>
		</div><!-- mainmenu -->

		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>

		<?php echo $content; ?>

		<div class="clear"></div>
	</div>
	<div id="footer">
		Copyright 2010 - <?php echo date('Y'); ?> by <a href="http://www.drachendaemmerung.de/">drachendaemmerung.de</a><br/>
		All Rights Reserved. Report problems at <a href="https://github.com/firegate666/Textadventure-NextGen/issues?state=open" target="_blank">github</a>.<br/>
		Game engine version: <?php $this->renderDynamic('getVersionInfo');?> | <?php echo Yii::powered(); ?><br />

	</div><!-- footer -->

</div><!-- page -->

<?php
$this->renderPartial('//layouts/_piwik');
$this->renderPartial('//layouts/_ga');
?>

</body>
</html>
