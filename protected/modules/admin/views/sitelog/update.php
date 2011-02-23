<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Update Sitelog');

$this->menu=array(
	array('label'=>Yii::t('sitelog', 'Sitelog List'), 'url'=>array('index')),
	array('label'=>Yii::t('sitelog', 'Create Sitelog'), 'url'=>array('create')),
	array('label'=>Yii::t('sitelog', 'View Sitelog'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('sitelog', 'Manage Sitelogs'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
