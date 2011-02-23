<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Update User');

$this->menu=array(
	array('label'=>Yii::t('user', 'Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('user', 'View User'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('user', 'Manage Users'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
