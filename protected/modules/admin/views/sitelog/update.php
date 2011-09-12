<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Update Sitelog');

$this->menu=array(
	array('label'=>Yii::t('sitelog', 'Manage Sitelogs'), 'url'=>array('admin')),
	array('label'=>Yii::t('sitelog', 'Create Sitelog'), 'url'=>array('create')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
