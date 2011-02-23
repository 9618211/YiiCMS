<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Update Comment');

$this->menu=array(
	array('label'=>Yii::t('comment', 'Create Comment'), 'url'=>array('create')),
	array('label'=>Yii::t('comment', 'View Comment'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('comment', 'Manage Comments'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
