<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/public/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/public/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/public/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/public/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/public/css/form.css" />

	<title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?= CHtml::encode(Yii::app()->name); ?></div>
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

	<?= $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; 2010 - <?= date('Y'); ?> by <a href="http://web66.org">Web66</a><br/>
		All Rights Reserved. Report problems at <a href="https://github.com/firegate666/Textadventure-NextGen/issues?state=open" target="_blank">github</a>.<br/>
		<?= Yii::powered(); ?><br />
		Game engine version: <?php $this->renderDynamic('getVersionInfo');?>
	</div><!-- footer -->

</div><!-- page -->

<?php
$this->renderPartial('//layouts/_ga');
?>

</body>
</html>
