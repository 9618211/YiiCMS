<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Update Tag');

$this->menu=array(
	array('label'=>Yii::t('tag', 'Tag List'), 'url'=>array('index')),
	array('label'=>Yii::t('tag', 'Create Tag'), 'url'=>array('create')),
	array('label'=>Yii::t('tag', 'View Tag'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('tag', 'Manage Tags'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
