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

    <link rel="alternate" type="application/rss+xml" href="<?php echo Yii::app()->createUrl('blog/post/feed'); ?>" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
        <table class="logo">
            <tr>
                <td>
                    <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
                </td>
                <td>
                    <div class="form search">
                    <?php $this->beginWidget('CActiveForm', array(
                        'id'=>'search-form',
                        'enableAjaxValidation'=>false,
                        'action'=>Yii::app()->createUrl('blog/default/search'),
                        'method'=>'get',
                    )); ?>
                    <input type="text" name="query_string" id="search-box">
                    <?php $this->endWidget(); ?>
                    </div>
                </td>
            </tr>
        </table>
	</div><!-- header -->

	<div id="mainmenu">
        <?php
        // Get current controller
        $cc = Yii::app()->getController();
        $cid = is_object($cc) ? $cc->getId() : null;

        $statusCond = 't.status='.PUBLIC_POST;
        if (!Yii::app()->user->isGuest) {
            $statusCond .= ' or (t.status='.PRIVATE_POST.' and t.create_user_id='.Yii::app()->user->id.')';
        }

        $menu = array();
        $menu[] = array('label'=>Yii::t('menu', 'Home'), 'url'=>array('/blog'));
        foreach (Page::model()->findAll(array('condition'=>'t.type='.PAGE_TYPE.' and ('.$statusCond.')')) as $page) {
            $menu[] = array(
                'label'=>$page->title,
                'url'=>array('/blog/page/view', 'id'=>$page->id),
            );
        }
        $menu[] = array('label'=>Yii::t('menu', 'Logs'), 'url'=>array('/blog/sitelog'), 'active'=>$cid=='sitelog');
        $menu[] = array('label'=>Yii::t('menu', 'Admin'), 'url'=>array('/admin'), 'visible'=>!Yii::app()->user->isGuest);
        $menu[] = array('label'=>Yii::t('menu', 'Login'), 'url'=>array('/admin/login'), 'visible'=>Yii::app()->user->isGuest);
        $menu[] = array('label'=>Yii::t('menu', 'Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/admin/login/logout'), 'visible'=>!Yii::app()->user->isGuest);
        $this->widget('zii.widgets.CMenu',array(
			'items'=>$menu,
        ));
        ?>
	</div><!-- mainmenu -->

	<?php echo $content; ?>

	<div id="footer">
        <?php eval(file_get_contents('protected/copyright.txt')); ?>
        <?php echo file_get_contents('protected/stat.txt'); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
