<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>
	
	<title>PelicanoS</title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Movies', 'url'=>array('/nzb/indexReseller'), 'visible'=>Yii::app()->user->checkAccess('Operator')),
				array('label'=>'Movie', 'url'=>array('/nzb/index'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),				
				array('label'=>'Serie', 'url'=>array('/nzb/indexTvReseller'), 'visible'=>Yii::app()->user->checkAccess('Operator')),
				array('label'=>'Serie', 'url'=>array('/nzb/indexTv'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),
				array('label'=>'Customer', 'url'=>array('/customer/index'), 'visible'=>Yii::app()->user->checkAccess('Operator')),
				array('label'=>'Customer', 'url'=>array('/customer/summary'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),
				array('label'=>'User', 'url'=>array('/user/index'), 'visible'=>Yii::app()->user->checkAccess('Operator')),
				array('label'=>'User', 'url'=>array('/user/summary'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),
				array('label'=>'Reseller', 'url'=>array('/reseller/index'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),
				array('label'=>'Devices Settings', 'url'=>array('/clientSettings/index'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),
				array('label'=>'Devices', 'url'=>array('/device/index'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),
				array('label'=>'AnyDVD', 'url'=>array('/anydvdhdVersion/index'), 'visible'=>Yii::app()->user->checkAccess('Administrator')),
				array('label'=>'Logout'.' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
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
		Copyright &copy; <?php echo date('Y'); ?> by SmartLiving.<br/>
		All Rights Reserved.<br/>
		Powered by WestIdeas
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
