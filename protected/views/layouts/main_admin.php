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
				array('label' => 'Adventure Steps', 'url' => array('/AdventureStep/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState('canCreateAdventure'))),
				array('label' => 'Adventure Step Connections', 'url' => array('/AdventureStepOption/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->getState("isAdmin") || Yii::app()->user->getState('canCreateAdventure'))),
				array('label' => 'Adventure Log', 'url' => array('/AdventureLog/index'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'Adventure Participation', 'url' => array('/AdventureParticipation/index'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'User', 'url' => array('/User'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'UserGroup', 'url' => array('/UserGroup'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),

				array('label' => 'World', 'url' => array('/World'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'MapSection', 'url' => array('/MapSection'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'Archipelago', 'url' => array('/Archipelago'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'Island', 'url' => array('/Island'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),

				array('label' => 'Resource', 'url' => array('/Resource'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				//array('label' => 'ResourceProduction', 'url' => array('/ResourceProduction'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				//array('label' => 'Stock', 'url' => array('/Stock'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				//array('label' => 'Storage', 'url' => array('/Storage'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'TechTreeCategory', 'url' => array('/TechTreeCategory'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'TechTreeType', 'url' => array('/TechTreeType'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'TechTreeEntry', 'url' => array('/TechTreeEntry'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				array('label' => 'TechTreeDependency', 'url' => array('/TechTreeDependency'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),
				//array('label' => 'TechTreeResearch', 'url' => array('/TechTreeResearch'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")),

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
		All Rights Reserved. Report problems at <a href="https://github.com/firegate666/Textadventure-NextGen/issues?state=open" target="_blank">github</a>.<br/>
		<?php echo Yii::powered(); ?><br />
		Game engine version: <?php $this->renderDynamic('getVersionInfo');?>
	</div><!-- footer -->

</div><!-- page -->

<?php
$this->renderPartial('//layouts/_piwik');
$this->renderPartial('//layouts/_ga');
?>

</body>
</html>
