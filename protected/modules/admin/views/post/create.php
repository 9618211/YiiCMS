<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Create Post');

$this->menu=array(
	array('label'=>Yii::t('post', 'Manage Posts'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
