<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'User List');

$this->menu=array(
	array('label'=>Yii::t('user', 'Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('user', 'Manage Users'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
