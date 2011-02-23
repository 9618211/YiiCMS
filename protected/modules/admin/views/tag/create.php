<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Create Tag');

$this->menu=array(
	array('label'=>Yii::t('tag', 'Tag List'), 'url'=>array('index')),
	array('label'=>Yii::t('tag', 'Manage Tags'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
