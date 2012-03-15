<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),

				array('label'=>'Start adventuring', 'url'=>array('/Adventure/index'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>'Login', 'url'=>array('/auth/login'), 'visible'=>Yii::app()->user->isGuest),

				array('label'=>'User', 'url'=>array('/User'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'UserGroup', 'url'=>array('/UserGroup'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Adventure', 'url'=>array('/Adventure'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'AdventureStep', 'url'=>array('/AdventureStep'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'AdventureStepOption', 'url'=>array('/AdventureStepOption'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/auth/logout'), 'visible'=>!Yii::app()->user->isGuest),
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
		Copyright &copy; 2010 - <?php echo date('Y'); ?> by <a href="http://web66.org">Web66</a><br/>
		All Rights Reserved. Report problems at <a href="http://dev.firegate.de/projects/text-adventure-nextgen" target="_blank">Redmine</a>.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
