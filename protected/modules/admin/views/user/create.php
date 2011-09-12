<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Create User');

$this->menu=array(
	array('label'=>Yii::t('user', 'User List'), 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
