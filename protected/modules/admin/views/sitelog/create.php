<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Create Sitelog');

$this->menu=array(
	array('label'=>Yii::t('sitelog', 'Sitelog List'), 'url'=>array('index')),
	array('label'=>Yii::t('sitelog', 'Manage Sitelogs'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
