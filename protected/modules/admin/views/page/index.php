<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('page', 'Create Page');

$this->menu=array(
	array('label'=>Yii::t('page', 'Create Page'), 'url'=>array('create')),
	array('label'=>Yii::t('page', 'Manage Pages'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
