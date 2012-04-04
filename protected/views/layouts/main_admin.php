<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu', array(
			'items' => array(
				array('label' => 'Home', 'url' => array('/site/index')),

				array('label' => 'Adventure', 'url' => array('/Adventure/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState('canCreateAdventure'))),
				array('label' => 'AdventureStep', 'url' => array('/AdventureStep/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState('canCreateAdventure'))),
				array('label' => 'AdventureStepOption', 'url' => array('/AdventureStepOption/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState('canCreateAdventure'))),
				array('label' => 'Adventure Log', 'url' => array('/AdventureLog/index'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'Adventure Participation', 'url' => array('/AdventureParticipation/index'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'User', 'url' => array('/User'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'UserGroup', 'url' => array('/UserGroup'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),

				array('label' => 'Logout ('.Yii::app()->user->name.')', 'url' => array('/auth/logout'), 'visible' => !Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links' => $this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; 2010 - <?php echo date('Y'); ?> by <a href="http://web66.org">Web66</a><br/>
		All Rights Reserved. Report problems at <a href="http://dev.firegate.de/projects/text-adventure-nextgen" target="_blank">Redmine</a>.<br/>
		<?php echo Yii::powered(); ?><br />
		Game engine version: <?php $this->renderDynamic('getVersionInfo');?>
	</div><!-- footer -->

</div><!-- page -->

<?php
$this->renderPartial('//layouts/_piwik');
?>

</body>
</html>
