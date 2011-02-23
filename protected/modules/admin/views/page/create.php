<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('page', 'Create Page');

$this->menu=array(
	array('label'=>Yii::t('page', 'Manage Pages'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
