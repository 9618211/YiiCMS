<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('page', 'View Page');

$this->menu=array(
	array('label'=>Yii::t('page', 'Page List'), 'url'=>array('index')),
	array('label'=>Yii::t('page', 'Create Page'), 'url'=>array('create')),
	array('label'=>Yii::t('page', 'Update Page'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('page', 'Delete Page'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('page', 'Manage Pages'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'content',
		'create_user_id',
		'create_time',
		'update_user_id',
		'update_time',
	),
)); ?>
