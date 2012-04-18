<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="aG7-NEHDoXRFeIiDCHFIxhBmn6Uhp0IhEGvStsCLWzI" />
	<meta name="language" content="en" />

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
			<img src="http://drachendaemmerung.de/fileadmin/drachendaemmerung.de/images/dragon_small.gif" alt="<?php echo CHtml::encode(Yii::app()->name); ?>"/>
			<span style="float: left;">A fantastic and high-fantasy role-playing game world.</span>
			<div class="clear"></div>
		</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),

				array('label'=>'Start adventuring', 'url'=>array('/Adventure/index'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>'Login', 'url'=>array('/auth/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Register', 'url'=>array('/User/register'), 'visible'=>Yii::app()->user->isGuest),

				array('label'=>'Admin', 'url'=>array('/site/admin'), 'visible' => !Yii::app()->user->isGuest && (
					Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState("canCreateAdventure"))
				),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/auth/logout'), 'visible' => !Yii::app()->user->isGuest),
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
?>

</body>
</html>
