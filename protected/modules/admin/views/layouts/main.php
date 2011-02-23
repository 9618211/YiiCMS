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
				array('label'=>Yii::t('menu', 'Back to Site'), 'url'=>array('/blog')),
				array('label'=>Yii::t('menu', 'Control Panel'), 'url'=>array('/admin')),
				array('label'=>Yii::t('menu', 'Users'), 'url'=>array('/admin/user')),
				array('label'=>Yii::t('menu', 'Posts'), 'url'=>array('/admin/post')),
				array('label'=>Yii::t('menu', 'Pages'), 'url'=>array('/admin/page')),
				array('label'=>Yii::t('menu', 'Comments'), 'url'=>array('/admin/comment')),
				array('label'=>Yii::t('menu', 'Tags'), 'url'=>array('/admin/tag')),
				array('label'=>Yii::t('menu', 'Gallery'), 'url'=>array('/admin/gallery')),
				array('label'=>Yii::t('menu', 'Logs'), 'url'=>array('/admin/sitelog'), 'visible'=>(Yii::app()->user->name == 'admin')),
				array('label'=>Yii::t('menu', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('menu', 'Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php echo $content; ?>

	<div id="footer">
        <?php eval(file_get_contents('protected/copyright.txt')); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
